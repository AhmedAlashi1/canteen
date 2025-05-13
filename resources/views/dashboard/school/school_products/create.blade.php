@extends('dashboard.layouts.master')
@section('title', __('general.Add Product'))

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('dashboard/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('dashboard/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('dashboard/app-assets/css/components.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection

@section('content')
    <section id="multiple-column-form">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('general.Add Product') }}</h4>
                    </div>
                    <div class="card-body">
                        <form class="form" action="{{ route('school.school-products.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <!-- product ID -->
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="products">{{ __('general.Product') }}</label>
                                        <select name="product_id" id="products" class="form-control select2-ajax" ></select>
                                        @error('products')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                    <!-- Price -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="price">{{ __('general.price') }}</label>
                                            <input type="number" step="0.01" name="price" id="price" class="form-control form-control-sm @error('price') is-invalid @enderror" value="{{ old('price') }}">
                                            @error('price')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>

                                    <!-- Quantity -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="quantity">{{ __('general.quantity') }}</label>
                                            <input type="number" name="quantity" id="quantity" class="form-control form-control-sm @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}">
                                            @error('quantity')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>


                                <!-- Submit -->
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">{{ __('general.Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            function formatProduct(product) {
                if (!product.id) {
                    return product.text;
                }
                const imageUrl = product.image ? '{{ asset('') }}' + product.image : '{{asset("images/default.png") }}';

                return $(
                    `<div class="d-flex align-items-center">
                    <img src="${imageUrl}" class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: cover;">
                    <span>${product.text}</span>
                </div>`
                );
            }
            function initSelect2(selector, url) {
                $(selector).select2({
                    placeholder: "{{ __('general.Choose') }}",
                    minimumInputLength: 1,
                    ajax: {
                        url: url,
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                q: params.term
                            };
                        },
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        id: item.id,
                                        text: item.name,
                                        image : item.image
                                    };
                                })
                            };
                        },
                        cache: true
                    },
                    templateResult: formatProduct,
                    templateSelection: formatProduct,
                    escapeMarkup: function (markup) {
                        return markup;
                    }
                });
            }

            initSelect2('#products', '{{ route('school.products.select') }}');
        });
    </script>






@endsection

