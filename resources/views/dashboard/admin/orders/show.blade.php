@extends('dashboard.layouts.master')
@section('title', __('general.order show') )
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('dashboard/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('dashboard/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('dashboard/app-assets/css/components.css') }}">


@endsection
@section('content')


    <section id="multiple-column-form">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{__('general.Update Child')}} </h4>
                    </div>
                    <div class="card-body">
                        <div class="container py-4">
                            <div class="row">
                                <!-- Order Summary Card -->
                                <div class="col-lg-6">
                                    <div class="card shadow-sm border-0">
                                        <div class="card-header bg-primary text-white">
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
                                            <p><strong>{{ __('general.Payment Status') }}:</strong>
                                                <span class="badge {{ $order->payment_status === 'paid' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($order->payment_status) }}
                        </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- User & Address Info -->
                                <div class="col-lg-6">
                                    <div class="card shadow-sm border-0">
                                        <div class="card-header bg-secondary text-white">
                                            <h5 class="mb-0">{{ __('general.Customer Info') }}</h5>
                                        </div>
                                        <div class="card-body">
                                            <p><strong>{{ __('general.Name') }}:</strong> {{ $order->user?->name ?? '-' }}</p>
                                            <p><strong>{{ __('general.Phone') }}:</strong> {{ $order->user?->phone ?? '-' }}</p>
                                            <p><strong>{{ __('general.Address') }}:</strong> {{ $order->address?->full ?? '-' }}</p>
                                            <p><strong>{{ __('general.Payment ID') }}:</strong> {{ $order->payment_id ?? '-' }}</p>
                                            <p><strong>{{ __('general.Transaction ID') }}:</strong> {{ $order->transaction_id ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- If order contains products/items -->
                                @if($order->items && $order->items->count())
                                    <div class="col-12 mt-4">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-header bg-light">
                                                <h5 class="mb-0">{{ __('general.Items') }}</h5>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-bordered table-hover">
                                                    <thead class="table-light">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>{{ __('general.Item') }}</th>
                                                        <th>{{ __('general.Quantity') }}</th>
                                                        <th>{{ __('general.Price') }}</th>
                                                        <th>{{ __('general.Total') }}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($order->items as $index => $item)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ $item->name }}</td>
                                                            <td>{{ $item->quantity }}</td>
                                                            <td>{{ number_format($item->price, 2) }} KD</td>
                                                            <td>{{ number_format($item->price * $item->quantity, 2) }} KD</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

