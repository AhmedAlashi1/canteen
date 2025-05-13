@extends('dashboard.layouts.master')
@section('title', __('general.Edit Product'))

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
                        <h4 class="card-title">{{ __('general.Edit Product') }}</h4>
                    </div>
                    <div class="card-body">
                        <form class="form" action="{{ route('admin.products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <!-- Name AR -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="name_ar">{{ __('general.name_ar') }}</label>
                                        <input type="text" id="name_ar" name="name_ar" class="form-control form-control-sm @error('name_ar') is-invalid @enderror"
                                               value="{{ old('name_ar', $product->name_ar) }}" required>
                                        @error('name_ar')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <!-- Name EN -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="name_en">{{ __('general.name_en') }}</label>
                                        <input type="text" id="name_en" name="name_en" class="form-control form-control-sm @error('name_en') is-invalid @enderror"
                                               value="{{ old('name_en', $product->name_en) }}" required>
                                        @error('name_en')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <!-- Description AR -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="description_ar">{{ __('general.description_ar') }}</label>
                                        <textarea name="description_ar" id="description_ar" rows="3" class="form-control form-control-sm @error('description_ar') is-invalid @enderror">{{ old('description_ar', $product->description_ar) }}</textarea>
                                        @error('description_ar')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <!-- Description EN -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="description_en">{{ __('general.description_en') }}</label>
                                        <textarea name="description_en" id="description_en" rows="3" class="form-control form-control-sm @error('description_en') is-invalid @enderror">{{ old('description_en', $product->description_en) }}</textarea>
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
                                                <option value="{{ $category->id }}" {{ old('cat_id', $product->cat_id) == $category->id ? 'selected' : '' }}>{{ $category->name_ar }}</option>
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
                                            <option value="active" {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>{{ __('general.active') }}</option>
                                            <option value="inactive" {{ old('status', $product->status) != 'active' ? 'selected' : '' }}>{{ __('general.inactive') }}</option>
                                        </select>
                                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <!-- Schools -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="schools">{{ __('general.schools') }}</label>
                                        <select name="school_id" id="school_id" class="form-control select2-ajax" data-selected="{{ $product->school_id }}"></select>
                                        @error('schools')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <!-- Suppliers -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="suppliers">{{ __('general.suppliers') }}</label>
                                        <select name="supplier_id" id="supplier_id" class="form-control select2-ajax" data-selected="{{ $product->supplier_id }}"></select>
                                        @error('suppliers')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <!-- Type -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="type">{{ __('general.type') }}</label>
                                        <select name="type" id="type" class="form-control form-control-sm @error('type') is-invalid @enderror">
                                            <option value="school" {{ old('type', $product->type) == 'school' ? 'selected' : '' }}>{{ __('general.school') }}</option>
                                            <option value="store" {{ old('type', $product->type) == 'store' ? 'selected' : '' }}>{{ __('general.store') }}</option>
                                        </select>
                                        @error('type')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <!-- Image -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="image">{{ __('general.image') }}</label>
                                        <input type="file" id="image" name="image" class="form-control form-control-sm @error('image') is-invalid @enderror">
                                        @if($product->image)
                                            <img src="{{ asset( $product->image) }}" height="70" class="mt-1">
                                        @endif
                                        @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <!-- Price & Quantity if type == store -->
                                <div id="store-fields" style="{{ $product->type == 'store' ? '' : 'display:none;' }}">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="price">{{ __('general.price') }}</label>
                                                <input type="number" step="0.01" name="price" id="price" class="form-control form-control-sm" value="{{ old('price', $product->price) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="quantity">{{ __('general.quantity') }}</label>
                                                <input type="number" name="quantity" id="quantity" class="form-control form-control-sm" value="{{ old('quantity', $product->quantity) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Multi Images -->
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="images">{{ __('general.images') }}</label>
                                        <input type="file" id="images" name="images[]" class="form-control form-control-sm" multiple>
                                        @if($product->images)
                                            @foreach($product->images as $img)
                                                <img src="{{ asset($img->image) }}" height="60" class="m-1">
                                            @endforeach
                                        @endif
                                    </div>
                                </div>

                                <!-- Sizes -->
                                <div class="col-12">
                                    <button type="button" class="btn btn-sm btn-primary mt-1" id="add-size">{{ __('general.add_size') }}</button>
                                    <br><br>
                                    <div id="sizes-wrapper">
                                        @foreach($product->sizes as $i => $size)
                                            <div class="row size-row mb-1">
                                                <div class="col-md-3">
                                                    <input type="text" name="sizes[{{ $i }}][name]" class="form-control form-control-sm" value="{{ $size->size }}">
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="number" step="0.01" name="sizes[{{ $i }}][price]" class="form-control form-control-sm" value="{{ $size->price }}">
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="number" name="sizes[{{ $i }}][quantity]" class="form-control form-control-sm" value="{{ $size->quantity }}">
                                                </div>
                                                <div class="col-md-3">
                                                    <button type="button" class="btn btn-sm btn-danger remove-size">{{ __('general.remove') }}</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Submit -->
                                <div class="col-12 mt-2">
                                    <button type="submit" class="btn btn-primary me-1">{{ __('general.Save') }}</button>
                                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">{{ __('general.cancel') }}</a>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            // Show/hide store fields
            $('#type').on('change', function () {
                if ($(this).val() === 'store') {
                    $('#store-fields').show();
                } else {
                    $('#store-fields').hide();
                }
            });

            // Add new size row
            let sizeIndex = {{ $product->sizes->count() }};
            $('#add-size').click(function () {
                const html = `
                    <div class="row size-row mb-1">
                        <div class="col-md-3">
                            <input type="text" name="sizes[${sizeIndex}][size]" class="form-control form-control-sm" placeholder="{{ __('general.name') }}">
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
                    </div>`;
                $('#sizes-wrapper').append(html);
                sizeIndex++;
            });

            // Remove size row
            $(document).on('click', '.remove-size', function () {
                $(this).closest('.size-row').remove();
            });

            // Select2 for schools
            $('#school_id').select2({
                ajax: {
                    url: "{{ route('admin.schools.select') }}",
                    dataType: 'json',
                    processResults: function (data) {
                        return {
                            results: data.map(function(item) {
                                return {
                                    id: item.id,
                                    text: item.name // تحويل name إلى text
                                };
                            })
                        };

                    }
                }
            });

            // Select2 for suppliers
            $('#supplier_id').select2({
                ajax: {
                    url: "{{ route('admin.suppliers.select') }}",
                    dataType: 'json',
                    processResults: function (data) {
                        return {
                            results: data.map(function(item) {
                                return {
                                    id: item.id,
                                    text: item.name // تحويل name إلى text
                                };
                            })
                        };
                    }
                }
            });

            // Set pre-selected values for select2
            const selectedSchool = $('#school_id').data('selected');
            const selectedSupplier = $('#supplier_id').data('selected');

            if (selectedSchool) {
                $.ajax({
                    url: "{{ route('admin.schools.select') }}",
                    data: { id: selectedSchool }
                }).then(function (data) {
                    let option = new Option(data.name, data.id, true, true);
                    $('#school_id').append(option).trigger('change');
                });
            }

            if (selectedSupplier) {
                $.ajax({
                    url: "{{ route('admin.suppliers.select') }}",
                    data: { id: selectedSupplier }
                }).then(function (data) {
                    let option = new Option(data.name, data.id, true, true);
                    $('#supplier_id').append(option).trigger('change');
                });
            }
        });
    </script>
@endsection

