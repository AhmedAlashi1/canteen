@extends('dashboard.layouts.master')
@section('title', __('general.search student'))
@section('content')
    <div class="container mt-5">

        {{-- نموذج البحث --}}
        <div class="d-flex justify-content-center align-items-center mb-5">
            <form action="{{ route('school.search') }}" method="GET" class="w-50">
                <div class="form-group">
                    <input type="text" name="student_number" class="form-control form-control-lg" placeholder="{{__('general.student_number')}}" required value="{{ request('student_number') }}">
                </div>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-search"></i> {{__('general.search')}}
                    </button>
                </div>
            </form>
        </div>

        {{-- النتائج --}}
        @if(request('student_number'))
            @if($child)
                <div class="card">
                    <div class="card-body">
                        <h4>{{__('general.student_name')}}: {{ $child->name }}</h4>
                        <p><strong>{{__('general.student_number')}}:</strong> {{ $child->student_number }}</p>
                        <p><strong>{{__('general.student_level')}}:</strong> {{ $child->level_name }}</p>

                        <hr>
                        <h5>{{__('general.orders_today')}} {{ \Carbon\Carbon::now()->format('Y-m-d') }}</h5>

                        {{-- تحقق من وجود طلبات --}}

                        @php $hasOrdersToday = false; @endphp

                        @foreach($child->orders as $order)
                            @if($order->orderDays->isNotEmpty())
                                @php $hasOrdersToday = true; @endphp
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <strong>{{__('general.Order_number')}}:</strong> {{ $order->id }}<br>
                                        <strong>{{__('general.Order_date')}}:</strong> {{ $order->created_at->format('Y-m-d') }}<br>
                                        <strong>{{__('general.Order_status')}}:</strong> {{ $order->status }}<br>
                                        <strong>{{__('general.Order_total')}}:</strong> {{ $order->total }} د.ك<br>


{{--                                        <strong>عدد الأيام:</strong> {{ $order->orderDays->count() }}--}}

                                        {{-- المنتجات --}}
                                        @if($order->orderProducts->isNotEmpty())
                                            <hr>
                                            <strong>{{__('general.Products')}}:</strong>
                                            <div class="table-responsive">
                                                <table class="table table-bordered mt-3">
                                                    <thead class="thead-light">
                                                    <tr>
                                                        <th>{{__('general.image')}}</th>
                                                        <th>{{__('general.name')}}</th>
                                                        <th>{{__('general.quantity')}}</th>
                                                        <th>{{__('general.price')}}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($order->orderProducts as $product)
                                                        <tr>
                                                            <td style="width: 80px;">
                                                                @if($product->product && $product->product->image)
                                                                    <img src="{{ asset($product->product->image) }}" alt="الصورة" class="img-fluid" style="max-width: 60px; max-height: 60px;">
                                                                @else
                                                                    <span class="text-muted">لا توجد صورة</span>
                                                                @endif
                                                            </td>
                                                            <td>{{ $product->product->name_en ?? 'اسم غير متوفر' }}</td>
                                                            <td>{{ $product->quantity ?? '-' }}</td>
                                                            <td>{{ $product->price ?? '-' }} د.ك</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @else
                                            <p>لا توجد منتجات لهذا الطلب.</p>
                                        @endif

                                    </div>
                                </div>
                            @endif
                        @endforeach


                    @unless($hasOrdersToday)
                            <div class="alert alert-warning mt-3">لا توجد طلبات مسجلة لهذا اليوم.</div>
                        @endunless
                    </div>
                </div>
            @else
                <div class="alert alert-danger text-center">
                    لم يتم العثور على طالب بهذا الرقم.
                </div>
            @endif
        @endif

    </div>
@endsection
