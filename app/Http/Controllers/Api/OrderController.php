<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrdersSchoolsResource;
use App\Http\Resources\OrdersStoreResource;
use App\Models\Basket;
use App\Models\Child;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDay;
use App\Models\OrderProduct;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\SchoolProduct;
use App\Models\Setting;
use App\Services\FirebaseService;
use App\Services\MyFatoorahService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

    public function storeSchool(Request $request)
    {
        // [1] التحقق من صحة البيانات لإنشاء الطلب
        $orderValidator = Validator::make($request->all(), [
            'child_id' => 'required|exists:children,id',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'payment_id' => 'required|exists:payment_methods,id',
            'days' => 'required|array|min:1',
            'days.*' => 'required|date_format:Y-m-d',
            'coupon' => 'nullable|string',
        ], [
            'items.*.product_id.required' => 'الرجاء تحديد المنتج.',
            'items.*.product_id.exists' => 'أحد المنتجات المحددة غير موجود.',
            'items.*.quantity.required' => 'الرجاء تحديد الكمية.',
            'items.*.quantity.integer' => 'الكمية يجب أن تكون رقمًا صحيحًا.',
        ]);

        if ($orderValidator->fails()) {
            return sendError($orderValidator->errors()->first());
        }

        $childId = $request->child_id;
        $days = $request->days;
        $couponCode = $request->coupon;

        // [2] التحقق من صلاحية الأيام (لا يسمح باليوم الحالي أو الأيام السابقة)
        $today = now()->startOfDay();
        foreach ($days as $day) {
            $dayDate = Carbon::createFromFormat('Y-m-d', $day)->startOfDay();
            if ($dayDate->lte($today)) return sendError("يجب اختيار تاريخ مستقبلي (بعد اليوم الحالي): $day");
            if ($dayDate->dayOfWeek > 4) return sendError("يُسمح فقط بأيام الأحد إلى الخميس: $day");
            $usedBefore = OrderDay::where('date', $day)
                ->whereHas('order', fn($q) => $q->where('child_id', $childId)->where('status', 'completed'))
                ->exists();
            if ($usedBefore) return sendError("تم استخدام التاريخ مسبقًا في طلب مكتمل: $day");
        }

        // [3] جلب الطفل والمستخدم
        $child = Child::with('user')->find($childId);
        $user = $child->user;
        // [4] إنشاء الطلب الجديد مباشرة

        $order = Order::create([
            'child_id' => $child->id,
            'user_id' => $user->id,
            'type' => 'school',
            'status' => 'pending',
            'payment_status' => 'pending',
            'payment_id' => $request->payment_id,
            'total' => 0,
        ]);


        $total = 0;
        $orderProducts = [];

        $daysCount = count($days);

        foreach ($request->items as $item) {
            $schoolProduct = SchoolProduct::where('product_id', $item['product_id'])
                ->where('school_id', $child->school_id)
                ->with('product')
                ->first();

            if (!$schoolProduct) {
                $order->delete();
                return sendError('المنتج غير متاح في مدرسة الطفل.');
            }

            if ($item['quantity'] > $schoolProduct->quantity) {
                $order->delete();
                return sendError('الكمية المطلوبة غير متوفرة للمنتج: ' . $schoolProduct->product->name_ar);
            }

            //  السعر × الكمية × عدد الأيام
            $lineTotal = $schoolProduct->price * $item['quantity'] * $daysCount;
            $total += $lineTotal;

            $orderProducts[] = [
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'school_product_id' => $schoolProduct->id,
                'quantity' => $item['quantity'],
                'price' => $schoolProduct->price,
                'type' => 'school',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        OrderProduct::insert($orderProducts);

        // إضافة الأيام مباشرة (سيتم التراجع عنها تلقائياً إذا فشلت العملية)
        foreach ($request->days as $day) {
            $dayDate = Carbon::createFromFormat('Y-m-d', $day)->startOfDay();
            OrderDay::create([
                'order_id' => $order->id,
                'date' => $dayDate->toDateString(),
                'day' => $dayDate->englishDayOfWeek,
            ]);
        }

        // [5] احتساب السعر والخصم
        $coupon = null;
        $discount = 0;
        if ($couponCode) {
            $coupon = Coupon::where('code', $couponCode)
                ->where('status', true)
                ->whereDate('end_at', '>=', now())
                ->first();

            if (!$coupon) {
                $order->delete();
                return sendError('الكوبون غير صالح أو منتهي.');
            }

            $usedCount = Order::where('coupon_id', $coupon->id)
                ->where('child_id', $childId)
                ->count();

            if ($coupon->code_limit !== null && $usedCount >= $coupon->code_limit) {
                $order->delete();
                return sendError('تم استخدام الكوبون بالحد الأقصى.');
            }

            $discount = $coupon->type === 'percentage'
                ? $total * ($coupon->value / 100)
                : $coupon->value;
            $discount = min($discount, $total);
        }

        $finalTotal = $total - $discount;

        // [6] تحديث الطلب بالمعلومات النهائية
        $order->update([
            'coupon_id' => $coupon?->id,
            'discount' => round($discount, 3),
            'total' => round($finalTotal, 3),
        ]);

        // [7] التحقق إذا كان المبلغ النهائي صفر أو أقل
        if ($finalTotal <= 0) {
            // تنفيذ عملية الدفع الناجحة مباشرة بدون واجهة دفع
            $this->completeOrderWithoutPayment($order, $request->days);

            // clear the basket
            Basket::where('child_id', $child->id)->where('type', 'school')->delete();

            return sendResponse([
                'success' => true,
                'message' => 'تم إنشاء الطلب بنجاح.',
                'payment_url' => null,
                'order_id' => $order->id,
                'total' => round($total, 3),
                'discount' => round($discount, 3),
                'final_total' => round($finalTotal, 3),
                'free_order' => true,
            ]);
        }

        // [8] إنشاء الفاتورة (للمبالغ أكبر من صفر)
        $phone = preg_replace('/[^0-9]/', '', $user->phone);
        $phone = substr($phone, -11);
        $paymentMethod = PaymentMethod::find($request->payment_id);
        $paymentMethodId = PaymentMethod::ALL_METHODS[$paymentMethod->slug] ?? 1;

        $invoiceData = [
            'InvoiceValue' => round($finalTotal, 3),
            'PaymentMethodId' => $paymentMethodId,
            'CustomerName' => $user->name,
            'CustomerEmail' => $user->email,
            'CustomerMobile' => $phone,
            'CallBackUrl' => route('ordersSuccess', ['order_id' => $order->id]),
            'ErrorUrl' => route('ordersError', ['order_id' => $order->id]),
            'CustomerReference' => $order->id,
            'Language' => app()->getLocale(),
            'DisplayCurrencyIso' => 'KWD',
        ];

        try {
            $paymentUrl = app(MyFatoorahService::class)->executePayment($invoiceData, $order->id);
        } catch (\Throwable $e) {
            $order->delete();
            Log::error('MyFatoorah payment error', [
                'message' => $e->getMessage(),
                'order_id' => $order->id,
                'invoiceData' => $invoiceData,
            ]);
            return sendError('فشل إنشاء الفاتورة. الرجاء المحاولة لاحقًا.');
        }

        // تحديث حالة الدفع
        $order->update([
            'payment_status' => 'pending',
            'transaction_id' => null,
        ]);

        // clear the basket
        Basket::where('child_id', $child->id)->where('type', 'school')->delete();

        return sendResponse([
            'success' => true,
            'message' => 'تم إنشاء الطلب ورابط الدفع بنجاح.',
            'payment_url' => $paymentUrl,
            'order_id' => $order->id,
            'total' => round($total, 3),
            'discount' => round($discount, 3),
            'final_total' => round($finalTotal, 3),
            'free_order' => false,
        ]);
    }

    public function storeStore(Request $request)
    {
        // [1] التحقق من البيانات
        $validator = Validator::make($request->all(),Order::$rulesApiStore);

        if ($validator->fails()) {
            return sendError($validator->errors()->first());
        }

        $user = auth()->user();

        // [3] التحقق من كل منتج وحجم وتجهيز البيانات
        $total = 0;
        $orderProducts = [];

        foreach ($request->items as $item) {
            $product = Product::where('id', $item['product_id'])
                ->with('sizes')
                ->first();
            $product_size_id = $item['product_size_id'] ?? null;
            $productSize = ProductSize::where('id', $product_size_id)
                ->where('product_id', $item['product_id'])
                ->first();

            if ($productSize){
                if ($item['quantity'] > $productSize->quantity) {
                    return sendError('الكمية المطلوبة غير متوفرة للحجم: ' . $productSize->size);
                }


            }else{
               if ($item['quantity'] > $product->quantity) {
                    return sendError('الكمية المطلوبة غير متوفرة للمنتج: ' . $product->name_ar);
                }

            }
            $lineTotal = $product->price * $item['quantity'];
            $total += $lineTotal;

            $orderProducts[] = [
                'product_id' => $item['product_id'],
                'product_size_id' => $item['product_size_id'] ?? null,
                'quantity' => $item['quantity'],
                'price' => $product->price,
                'type' => 'store',
                'created_at' => now(),
                'updated_at' => now(),
            ];

        }

        // [4] استرجاع قيمة الشحن من الإعدادات
        $shippingFee = (float) Setting::where('key_id', 'delivery_fees')->value('value') ?? 0;

        // [5] حساب الخصم إن وجد
        $coupon = null;
        $discount = 0;
        $couponCode = $request->coupon;

        if ($couponCode) {
            $coupon = Coupon::where('code', $couponCode)
                ->where('status', true)
                ->whereDate('end_at', '>=', now())
                ->first();

            if (!$coupon) {
                return sendError('الكوبون غير صالح أو منتهي.');
            }

            $usedCount = Order::where('coupon_id', $coupon->id)
                ->where('user_id', $user->id)
                ->count();

            if ($coupon->code_limit !== null && $usedCount >= $coupon->code_limit) {
                return sendError('تم استخدام الكوبون بالحد الأقصى.');
            }

            $discount = $coupon->type === 'percentage'
                ? $total * ($coupon->value / 100)
                : $coupon->value;

            $discount = min($discount, $total);
        }

        // [6] حساب الإجمالي النهائي
        $finalTotal = round($total - $discount + $shippingFee, 3);

        // [7] إنشاء الطلب
        $order = Order::create([
            'child_id' => null,
            'user_id' => $user->id,
            'address_id' => $request->address_id ?? null,
            'type' => 'store',
            'status' => 'pending',
            'payment_status' => 'pending',
            'total' => $finalTotal,
            'discount' => round($discount, 3),
            'coupon_id' => $coupon?->id,
            'payment_id' => $request->payment_id,
            'shipping_fees' => $shippingFee,
        ]);

        // [8] إضافة المنتجات
        foreach ($orderProducts as &$op) {
            $op['order_id'] = $order->id;
        }

        OrderProduct::insert($orderProducts);

        if ($finalTotal <= 0) {
            // إكمال الطلب مباشرة
            DB::transaction(function () use ($order) {
                $order->update([
                    'status' => 'pending', // جاري الانتظار
                    'payment_status' => 'paid',
                ]);

                // خصم الكميات من الأحجام
                foreach ($order->orderProducts as $op) {
                    if ($size = $op->size) {
                        $size->decrement('quantity', $op->quantity);
                    }
                }
            });



            return sendResponse([
                'success' => true,
                'message' => 'تم إنشاء الطلب بنجاح (طلب مجاني).',
                'payment_url' => null,
                'order_id' => $order->id,
                'total' => round($total, 3),
                'discount' => round($discount, 3),
                'final_total' => round($finalTotal, 3),
                'free_order' => true,
            ]);
        }

        // [إنشاء رابط الدفع]
        $phone = preg_replace('/[^0-9]/', '', $user->phone);
        $phone = substr($phone, -11);

        $paymentMethod = PaymentMethod::find($request->payment_id);
        $paymentMethodId = PaymentMethod::ALL_METHODS[$paymentMethod->slug] ?? 1;

        $invoiceData = [
            'InvoiceValue' => round($finalTotal, 3),
            'PaymentMethodId' => $paymentMethodId,
            'CustomerName' => $user->name,
            'CustomerEmail' => $user->email,
            'CustomerMobile' => $phone,
            'CallBackUrl' => route('ordersSuccess', ['order_id' => $order->id]),
            'ErrorUrl' => route('ordersError', ['order_id' => $order->id]),
            'CustomerReference' => $order->id,
            'Language' => app()->getLocale(),
            'DisplayCurrencyIso' => 'KWD',
        ];

        try {
            $paymentUrl = app(MyFatoorahService::class)->executePayment($invoiceData, $order->id);
        } catch (\Throwable $e) {
            $order->delete();
            Log::error('MyFatoorah Error', [
                'message' => $e->getMessage(),
                'order_id' => $order->id,
                'invoiceData' => $invoiceData,
            ]);
            return sendError('فشل إنشاء رابط الدفع. الرجاء المحاولة لاحقاً.');
        }

        return sendResponse([
            'success' => true,
            'message' => 'تم إنشاء الطلب ورابط الدفع بنجاح.',
            'payment_url' => $paymentUrl,
            'order_id' => $order->id,
            'total' => round($total, 3),
            'discount' => round($discount, 3),
            'final_total' => round($finalTotal, 3),
            'free_order' => false,
        ]);

    }

    protected function completeOrderWithoutPayment(Order $order, array $days)
    {
        DB::transaction(function () use ($order, $days) {
            // تحديث حالة الطلب
            $order->update([
                'status' => 'completed',
                'payment_status' => 'paid',
            ]);

            // خصم الكمية
            foreach ($order->orderProducts as $orderProduct) {
                if ($schoolProduct = $orderProduct->schoolProduct) {
                    $schoolProduct->decrement('quantity', $orderProduct->quantity);
                }
            }
        });
    }



    public function paymentSuccess(Request $request)
    {
        $order = Order::with(['orderProducts.schoolProduct'])->find($request->order_id);
        if (!$order) return 'الطلب غير موجود.';


        DB::transaction(function () use ($order) {
            // تحديث حالة الطلب
            $order->update([
                'status' => $order->type === 'store' ? 'pending' : 'completed',
                'payment_status' => 'paid',
                'transaction_id' => $request->paymentId ?? null,
            ]);

            // خصم الكمية حسب نوع الطلب
            foreach ($order->orderProducts as $orderProduct) {
                if ($order->type === 'school' && $schoolProduct = $orderProduct->schoolProduct) {
                    $schoolProduct->decrement('quantity', $orderProduct->quantity);
                }

                if ($order->type === 'store') {
                    $product = Product::find($orderProduct->product_id);
                    $product->decrement('quantity', $orderProduct->quantity);

                    //delete basket where user_id
                    Basket::where('user_id', $order->user_id)->delete();

                }
            }
        });
        //sendNotificationToToken
        $user = $order->user;
        $title = 'Purchased Succesfully';
        $body = 'Your Order no. #' . str_pad($order->id, 6, '0', STR_PAD_LEFT) . ' Purchased Successfully';
        $data = [
            'order_id' => $order->id,
        ];
        $token = $user->device_token;
        if ($token) {
            $firebase = new FirebaseService();
            $sent = $firebase->sendNotificationToToken($token, $title, $body, $data);
            if ($sent) {
                $user->notifications()->create([
                    'order_id' => $order->id,
                    'title' => $title,
                    'body' => $body,
                    'type' => 'order',
                    'data' => json_encode($data),
                ]);
            }
        }

        echo 'success';
    }

    public function paymentError(Request $request)
    {
        $order = Order::find($request->order_id);
        if (!$order) return 'الطلب غير موجود.';

        $order->update([
//            'status' => 'canceled',
            'payment_status' => 'canceled',
            'transaction_id' => $request->paymentId ?? null,
        ]);

        info("فشل عملية الدفع للطلب: $request->order_id", $request->all());

        echo 'error';
    }


    public function getSchoolOrdersOld(Request $request)
{
    try {
        $user = $request->user();
        if (!$user) {
            return sendError('المستخدم غير مسجل دخول.');
        }

        $lang = $request->header('lang', 'ar');
        $nameField = $lang == 'ar' ? 'name_ar' : 'name_en';

        // التحقق من معلمات التقسيم
        $page = max(1, (int)$request->input('page', 1));
        $size = min(100, max(1, (int)$request->input('size', 10)));

        $query = Order::with([
            'child.school',
            'orderDays',
            'child' => fn($q) => $q->where('user_id', $user->id)
        ])
            ->where('type', 'school')
            ->where('status', 'completed')
            ->where('payment_status', 'paid')
            ->orderBy('created_at', 'desc');

        // الحصول على النتائج مع التقسيم
        $paginator = $query->paginate(
            $size,
            ['*'],
            'page',
            $page
        );

        $orders = collect($paginator->items())->map(function ($order) use ($nameField) {
            if (!$order->child) return null;

            return [
                'process_number' => '#' . str_pad($order->id, 7, '0', STR_PAD_LEFT),
                'child' => [
                    'name' => $order->child->name,
                    'level' => $order->child->level,
                    'student_number' => $order->child->student_number,
                    'image' => asset($order->child->image),
                    'school_name' => $order->child->school->{$nameField},
                ],
                'details' => [
                    'days_count' => $order->orderDays->count(),
                    'total_cost' => number_format($order->total, 3) . ' KWD',
                    'time_ago' => $order->created_at->diffForHumans()
                ],
            ];
        })->filter();

        // إعداد بيانات التقسيم
        $paginationData = [
            'current_page' => $paginator->currentPage(),
            'per_page' => $paginator->perPage(),
            'total' => $paginator->total(),
            'last_page' => $paginator->lastPage(),
            'from' => $paginator->firstItem(),
            'to' => $paginator->lastItem()
        ];

        return sendResponse([
            'data' => $orders,
            'pagination' => $paginationData
        ], 'تم جلب الطلبات بنجاح.');

    } catch (\Exception $e) {
        Log::error('Orders API Error: '.$e->getMessage());
        return sendError('حدث خطأ غير متوقع.', [], 500);
    }
}
    //getSchoolOrders
    public function getSchoolOrders(Request$request){

        $user = auth()->user();

        $orders = Order::where('user_id',$user->id)->where('type','school')
            ->where('payment_status','paid')
            ->orderBy('created_at','desc')
            ->with(['child.user', 'child.school', 'orderProducts.product',
                'orderProducts.size', 'orderDays', 'payment', 'address'])
            ->paginate(10);
        $data = OrdersSchoolsResource::collection($orders);

        $data = [
            'data' => $data,
            'pagination' => [
                'current_page' => $orders->currentPage(),
                'last_page' => $orders->lastPage(),
                'per_page' => $orders->perPage(),
                'total' => $orders->total(),
                'next_page_url' => $orders->nextPageUrl(),
                'prev_page_url' => $orders->previousPageUrl(),
            ]
        ];
        return sendResponse($data);

    }

    // جلب الطلبات من نوع "store" الخاصة بالمستخدم الحالي (مع التصفية حسب الحالة: current أو completed)
    //getStoreOrders
    public function getStoreOrders(Request $request)
    {
        $request->stetus = $request->status ?? 'current';
        $user =auth()->user();

        $orders = Order::where('user_id',$user->id)->where('type','store')
            ->where('payment_status','paid')
            ->where('status',$request->status)
            ->orderBy('created_at','desc')
            ->with([ 'orderProducts.product',
                'orderProducts.size', 'payment', 'address'])

            ->paginate(10);
        $data = OrdersStoreResource::collection($orders);

        $data = [
            'data' => $data,
            'pagination' => [
                'current_page' => $orders->currentPage(),
                'last_page' => $orders->lastPage(),
                'per_page' => $orders->perPage(),
                'total' => $orders->total(),
                'next_page_url' => $orders->nextPageUrl(),
                'prev_page_url' => $orders->previousPageUrl(),
            ]
        ];
        return sendResponse($data);



    }


    // جلب تفاصيل طلب واحد سواء من نوع school أو store
    public function showDetails(Request $request, $id)
    {
        $lang = strtolower($request->header('lang', 'en'));

        // تحميل الطلب مع العلاقات اللازمة
        $order = Order::with([
            'child.user',
            'child.school',
            'orderProducts.product',
            'orderProducts.size',
            'orderDays',
            'payment',
            'address'
        ])->find($id);

        if (!$order) return sendError('الطلب غير موجود.');
        if ($order->type == 'school'){
            $data = new OrdersSchoolsResource($order);
        }else{
            $data = new OrdersStoreResource($order);
        }


        return sendResponse($data);

        $child = $order->child;
        $user = $child->user;
        $school = $child->school;
        $isSchool = $order->type === 'school';

        // تجهيز المنتجات
        $products = $order->orderProducts->map(function ($item) use ($lang, $isSchool) {
            $product = $item->product;
            $size = $item->size?->size;

            // تحديد السعر حسب النوع
            $price = $isSchool
                ? round($product->price, 3)
                : round($item->size?->price ?? 0, 3);

            return [
                'name'     => $lang === 'ar' ? $product->name_ar : $product->name_en,
                'size'     => $isSchool ? null : $size,
                'price'    => $price,
                'image'    => url($product->image),
                'quantity' => $item->quantity,
            ];
        });

        $paymentMethod = $order->payment;

        // هيكل الرد الأساسي
        $base = [
            'order_id' => $order->id,
            'process_number' => '#' . str_pad($order->id, 6, '0', STR_PAD_LEFT),
            'created_at' => $order->created_at->diffForHumans(),
            'status' => $order->status,
            'products' => $products,
            'payment_method' => [
                'name' => $paymentMethod?->{"name_{$lang}"},
                'image' => $paymentMethod ? url($paymentMethod->image) : null
            ],
            'price_summary' => [
                'product_total' => round($order->total + $order->discount, 3),
                'shipping_fees' => $order->shipping_fees ?? 0,
                'discount' => round($order->discount, 3),
                'final_total' => round($order->total, 3),
            ]
        ];

        // إضافة بيانات المدرسة إذا الطلب نوعه school
        if ($isSchool) {
            $base['child'] = [
                'name'   => $child->name,
                'grade'  => $child->level,
                'school' => $school?->{"name_{$lang}"},
                'image'  => url($child->image),
            ];
            $base['applied_days'] = $order->orderDays->map(fn($day) =>
            \Carbon\Carbon::parse($day->date)->translatedFormat('l - d/m/Y')
            );
        } else {
            // إذا الطلب من المتجر → إظهار العنوان
            $base['address'] = $order->address ? $order->address->location : null;
        }

        return sendResponse($base, 'تم جلب تفاصيل الطلب بنجاح.');
    }



}
