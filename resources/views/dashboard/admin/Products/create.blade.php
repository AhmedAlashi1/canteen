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
                        <form class="form" action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <!-- Name AR -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="name_ar">{{ __('general.name_ar') }}</label>
                                        <input type="text" id="name_ar" name="name_ar" class="form-control form-control-sm @error('name_ar') is-invalid @enderror"
                                               value="{{ old('name_ar') }}" required>
                                        @error('name_ar')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <!-- Name EN -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="name_en">{{ __('general.name_en') }}</label>
                                        <input type="text" id="name_en" name="name_en" class="form-control form-control-sm @error('name_en') is-invalid @enderror"
                                               value="{{ old('name_en') }}" required>
                                        @error('name_en')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <!-- Description AR -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="description_ar">{{ __('general.description_ar') }}</label>
                                        <textarea name="description_ar" id="description_ar" rows="3" class="form-control form-control-sm @error('description_ar') is-invalid @enderror">{{ old('description_ar') }}</textarea>
                                        @error('description_ar')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <!-- Description EN -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="description_en">{{ __('general.description_en') }}</label>
                                        <textarea name="description_en" id="description_en" rows="3" class="form-control form-control-sm @error('description_en') is-invalid @enderror">{{ old('description_en') }}</textarea>
                                        @error('description_en')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <!-- Category -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="cat_id">{{ __('general.category') }}</label>
                                        <select name="cat_id" id="cat_id" class="form-control form-control-sm @error('cat_id') is-invalid @enderror">
                                            <option value="">{{ __('general.Choose') }}</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('cat_id') == $category->id ? 'selected' : '' }}>{{ $category->name_ar }}</option>
                                            @endforeach
                                        </select>
                                        @error('cat_id')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <!-- Status -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="status">{{ __('general.status') }}</label>
                                        <select name="status" id="status" class="form-control form-control-sm @error('status') is-invalid @enderror">
                                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>{{ __('general.active') }}</option>
                                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>{{ __('general.inactive') }}</option>
                                        </select>
                                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>


                                <!-- School ID -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="schools">{{ __('general.schools') }}</label>
                                        <select name="schools" id="schools" class="form-control select2-ajax" ></select>
                                        @error('schools')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <!-- Supplier -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="suppliers">{{ __('general.suppliers') }}</label>
                                        <select name="suppliers" id="suppliers" class="form-control select2-ajax" ></select>
                                        @error('suppliers')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <!-- Type -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="type">{{ __('general.type') }}</label>
                                        <select name="type" id="type" class="form-control form-control-sm @error('type') is-invalid @enderror">
                                            <option value="school" {{ old('type') == 'school' ? 'selected' : '' }}>{{ __('general.school') }}</option>
                                            <option value="store" {{ old('type') == 'store' ? 'selected' : '' }}>{{ __('general.store') }}</option>
                                        </select>
                                        @error('type')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="image">{{ __('general.image') }}</label>
                                        <input type="file" id="image" name="image" class="form-control form-control-sm @error('image') is-invalid @enderror">
                                        @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <div id="store-fields" style="display: none;">
                                    <!-- Price -->
                                    <div class="row">
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
                                </div>
                                </div>
                                <!-- Image -->


                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="images">{{ __('general.images') }}</label>
                                        <input type="file" id="images" name="images[]" class="form-control form-control-sm @error('images') is-invalid @enderror" multiple>
                                        @error('images')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <!-- Sizes Section -->
                                <div class="col-12">
                                    <div class="col-12">
                                    <button type="button" class="btn btn-sm btn-primary mt-1" id="add-size">{{ __('general.add_size') }}</button>
                                    </div>
                                    <label>{{ __('general.sizes') }}</label>

                                    <div id="sizes-wrapper">
                                        <!-- أول صف -->
                                        <div class="row size-row mb-1">
                                            <div class="col-md-3">
                                                <input type="text" name="sizes[0][name]" class="form-control form-control-sm" placeholder="{{ __('general.size') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="number" step="0.01" name="sizes[0][price]" class="form-control form-control-sm" placeholder="{{ __('general.price') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="number" name="sizes[0][quantity]" class="form-control form-control-sm" placeholder="{{ __('general.quantity') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-sm btn-danger remove-size">{{ __('general.remove') }}</button>
                                            </div>
                                        </div>
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
                                        text: item.name
                                    };
                                })
                            };
                        },
                        cache: true
                    }
                });
            }

            initSelect2('#schools', '{{ route('admin.schools.select') }}');
            initSelect2('#suppliers', '{{ route('admin.suppliers.select') }}');
        });
    </script>

    <script>
        $(document).ready(function () {
            let sizeIndex = 1;

            $('#add-size').click(function () {
                $('#sizes-wrapper').append(`
                <div class="row size-row mb-1">
                    <div class="col-md-3">
                        <input type="text" name="sizes[${sizeIndex}][name]" class="form-control form-control-sm" placeholder="{{ __('general.size') }}">
                    </div>
                    <div class="col-md-3">
                        <input type="number" step="0.01" name="sizes[${sizeIndex}][price]" class="form-control form-control-sm" placeholder="{{ __('general.price') }}">
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="sizes[${sizeIndex}][quantity]" class="form-control form-control-sm" placeholder="{{ __('general.quantity') }}">
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-sm btn-danger remove-size">{{ __('general.remove') }}</button>
                    </div>
                </div>
            `);
                sizeIndex++;
            });

            $(document).on('click', '.remove-size', function () {
                $(this).closest('.size-row').remove();
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            function toggleStoreFields() {
                if ($('#type').val() === 'store') {
                    $('#store-fields').show();
                } else {
                    $('#store-fields').hide();
                }
            }

            // Initial check
            toggleStoreFields();

            // On change
            $('#type').change(function () {
                toggleStoreFields();
            });
        });
    </script>


@endsection

