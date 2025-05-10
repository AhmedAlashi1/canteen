@extends('dashboard.layouts.master')

@section('title', __('general.Edit Category'))
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
                        <h4 class="card-title">{{ __('general.Edit Category') }}</h4>
                    </div>
                    <div class="card-body">
                        <form class="form" action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">

                                <!-- name_ar -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="name_ar">{{ __('general.name_ar') }}</label>
                                        <input type="text" id="name_ar" name="name_ar" class="form-control form-control-sm @error('name_ar') is-invalid @enderror" value="{{ old('name_ar', $category->name_ar) }}" required />
                                        @error('name_ar')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- name_en -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="name_en">{{ __('general.name_en') }}</label>
                                        <input type="text" id="name_en" name="name_en" class="form-control form-control-sm @error('name_en') is-invalid @enderror" value="{{ old('name_en', $category->name_en) }}" required />
                                        @error('name_en')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- description_ar -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="description_ar">{{ __('general.description_ar') }}</label>
                                        <textarea id="description_ar" name="description_ar" class="form-control form-control-sm @error('description_ar') is-invalid @enderror">{{ old('description_ar', $category->description_ar) }}</textarea>
                                        @error('description_ar')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- description_en -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="description_en">{{ __('general.description_en') }}</label>
                                        <textarea id="description_en" name="description_en" class="form-control form-control-sm @error('description_en') is-invalid @enderror">{{ old('description_en', $category->description_en) }}</textarea>
                                        @error('description_en')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- type -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="type">{{ __('general.type') }}</label>
                                        <select name="type" id="type" class="form-control form-control-sm @error('type') is-invalid @enderror" required>
                                            <option value="school" {{ old('type', $category->type) == 'school' ? 'selected' : '' }}>{{ __('general.school') }}</option>
                                            <option value="store" {{ old('type', $category->type) == 'store' ? 'selected' : '' }}>{{ __('general.store') }}</option>
                                        </select>
                                        @error('type')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- status -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="status">{{ __('general.status') }}</label>
                                        <select name="status" id="status" class="form-control form-control-sm @error('status') is-invalid @enderror" required>
                                            <option value="active" {{ old('status', $category->status) == 'active' ? 'selected' : '' }}>{{ __('general.active') }}</option>
                                            <option value="inactive" {{ old('status', $category->status) == 'inactive' ? 'selected' : '' }}>{{ __('general.inactive') }}</option>
                                        </select>
                                        @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- image -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="image">{{ __('general.image') }}</label>
                                        <input type="file" id="image" name="image" class="form-control form-control-sm @error('image') is-invalid @enderror" />
                                        @if($category->image)
                                            <img src="{{ asset('uploads/categories/' . $category->image) }}" alt="Category Image" style="max-height: 80px; margin-top: 10px;">
                                        @endif
                                        @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
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
