@extends('dashboard.layouts.master')
@section('title', __('general.order show') )
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('dashboard/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('dashboard/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('dashboard/app-assets/css/components.css') }}">

    <style>

        .card + .card {
            margin-top: 2rem;
        }

        .text-muted {
            font-style: italic;
        }

        .card {
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: all 0.3s ease-in-out;
        }
        .card:hover {
            transform: scale(1.01);
        }
        .table th {
            background-color: #f7f9fc;
            font-weight: bold;
        }
        .table td, .table th {
            vertical-align: middle;
        }
        .hover-card {
            transition: transform 0.2s ease-in-out, box-shadow 0.3s;
        }
        .hover-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        /* تدرج من #7367f0 إلى لون أفتح منه */
        .bg-gradient-purple {
            background: linear-gradient(90deg, #7367f0 0%, #a99eff 100%);
            color: white;
        }

        /* تدرج مختلف للبطاقة الأخرى إذا أردت */
        .bg-gradient-blue {
            background: linear-gradient(90deg, #00c6ff 0%, #88e0ff 100%);
            color: white;
        }

        /* تظليل ناعم */
        .shadow-custom {
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        }

        /* زوايا مستديرة ناعمة */
        .rounded-custom {
            border-radius: 1rem;
        }

        .rounded-top-custom {
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
        }

    </style>
@endsection

@section('content')
    @php
        $name = app()->getLocale() === 'ar' ? 'name_ar' : 'name_en';
        $colors = ['info', 'warning', 'success', 'danger', 'primary', 'secondary'];
    @endphp
    <section id="multiple-column-form">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{__('general.Show order')}} </h4>
                    </div>
                    <div class="card-body">
                        <div class="container py-4">
                            <div class="row g-4">
                                <!-- بيانات العميل -->
                                <div class="col-md-6">
                                    <div class="card shadow border-0 rounded-custom">
                                        <div class="card-header text-white bg-gradient-blue rounded-top-custom">
                                            {{ __('general.Customer Info') }}
                                        </div>
                                        <div class="card-body text-secondary">
                                            <p><strong>{{ __('general.Name') }}:</strong> {{ $order->user?->name ?? '-' }}</p>
                                            <p><strong>{{ __('general.Phone') }}:</strong> {{ $order->user?->phone ?? '-' }}</p>
                                            <p><strong>{{ __('general.Address') }}:</strong>
                                                {{ $order->address?->city->$name ?? '-' }}-{{ $order->address?->region->$name ?? '-' }}
                                            </p>
                                            <p><strong>{{ __('general.Created At') }}:</strong> {{ $order->created_at ? $order->created_at->diffForHumans() : '-' }}</p>

                                        </div>
                                    </div>
                                </div>
                                <!-- بيانات الطلب والدفع -->
                                <div class="col-md-6">
                                    <div class="card shadow border-0 rounded-custom">
                                        <div class="card-header text-white bg-gradient-blue rounded-top-custom">
                                            <h5 class="mb-0">{{ __('general.Order Summary') }}</h5>
                                        </div>
                                        <div class="card-body">
                                            <p><strong>{{ __('general.Order ID') }}:</strong> #{{ $order->id }}</p>
                                            <p><strong>{{ __('general.Type') }}:</strong>
                                                <span class="badge bg-info">{{ ucfirst($order->type) }}</span>
                                            </p>
                                            <p><strong>{{ __('general.Status') }}:</strong>
                                                <span class="badge {{ $order->status === 'completed' ? 'bg-success' : 'bg-warning' }}">
                                                    {{ ucfirst($order->status) }}
                                        </span>
                                            </p>
                                            <p><strong>{{ __('general.Total') }}:</strong> {{ number_format($order->total, 2) }} KD</p>
                                            <p><strong>{{ __('general.Discount') }}:</strong> {{ number_format($order->discount, 2) }} KD</p>
                                            <p><strong>{{ __('general.Shipping Fees') }}:</strong> {{ number_format($order->shipping_fees, 2) }} KD</p>
                                            <p><strong>{{ __('general.Payment Status') }}:</strong>
                                                <span class="badge {{ $order->payment_status === 'paid' ? 'bg-success' : 'bg-danger' }}">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                            </p>
                                            <p><strong>{{ __('general.Products Count') }}:</strong> {{ $order->orderProducts->count()  }}</p>
                                            <p><strong>{{ __('general.Payment ID') }}:</strong> {{ $order->payment->$name ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if($order->orderDays && $order->orderDays->count() > 0 && $order->type === 'school')
                                @foreach($order->orderDays->sortBy('date') as $dayIndex => $day)
                                    <div class="card mt-3 shadow-sm">
                                        {{--                                        <div class="card-header bg-light d-flex justify-content-between align-items-center">--}}

                                        <div class="card-body">
                                            <div class="card-header  text-white" style="background-color: #7367f0 ;">
                                                <h5 class="mb-0" style="color: #fff">{{ __('general.Day') }} {{ $dayIndex + 1 }} - {{ $day->date }}</h5>
                                            </div>
                                            @if($order->orderProducts && $order->orderProducts->count())
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>{{ __('general.image') }}</th>
                                                        <th>{{ __('general.Product') }}</th>
                                                        <th>{{ __('general.Quantity') }}</th>
                                                        <th>{{ __('general.Price') }}</th>
                                                        <th>{{ __('general.Total') }}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($order->orderProducts as $index => $product)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>
                                                                <img src="{{ asset($product->product->image ?? 'logo.png')  }}" alt="Product Image" width="60">
                                                            </td>
                                                            <td>{{ $product->product->name_en }}</td>
                                                            <td>{{ $product->quantity }}</td>
                                                            <td>{{ number_format($product->schoolProduct->price, 2) }} KD</td>
                                                            <td>{{ number_format($product->schoolProduct->price * $product->quantity, 2) }} KD</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            @else
                                                <p class="text-muted">{{ __('general.No products available') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                            @if($order->orderProducts && $order->orderProducts->count() > 0 && $order->type !== 'school')
                                <div class="card mt-3 shadow-sm">

                                    <div class="card-body">
                                        <div class="card-header text-white" style="background-color: #7367f0 ;">
                                            <h5 class="mb-0" style="color: #fff">{{ __('general.Order Products') }}</h5>
                                        </div>
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ __('general.image') }}</th>
                                                <th>{{ __('general.Product') }}</th>
                                                <th>{{ __('general.size') }}</th>
                                                <th>{{ __('general.Quantity') }}</th>
                                                <th>{{ __('general.Price') }}</th>
                                                <th>{{ __('general.Total') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($order->orderProducts as $index => $product)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>
                                                        <img src="{{ asset($product->product->image ?? 'logo.png') }}" alt="Product Image" width="60">
                                                    </td>
                                                    <td>{{ $product->product->name_en }}</td>
                                                    <td>{{ $product->size ? $product->size->size : '-' }}</td>
                                                    <td>{{ $product->quantity }}</td>
                                                    <td>{{ number_format($product->price, 2) }} KD</td>
                                                    <td>{{ number_format($product->price * $product->quantity, 2) }} KD</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

