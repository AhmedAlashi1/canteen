@extends('dashboard.layouts.master')
@section('title', __('general.Add Category'))
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
                        <h4 class="card-title">{{ __('general.Add Category') }}</h4>
                    </div>
                    <div class="card-body">
                        <form class="form" action="{{ route('admin.categories.store') }}" method="post" enctype="multipart/form-data">
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

                                <!-- Status -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="status">{{ __('general.status') }}</label>
                                        <select name="status" id="status" class="form-control form-control-sm @error('status') is-invalid @enderror" required>
                                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>{{ __('general.active') }}</option>
                                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>{{ __('general.inactive') }}</option>
                                        </select>
                                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
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

                                <!-- Image -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="image">{{ __('general.image') }}</label>
                                        <input type="file" id="image" name="image" class="form-control form-control-sm @error('image') is-invalid @enderror">
                                        @error('image')<span class="text-danger">{{ $message }}</span>@enderror
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
