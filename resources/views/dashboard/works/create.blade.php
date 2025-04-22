
@extends('dashboard.layouts.master')
@section('title', __('general.Add Work') )
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
                        <h4 class="card-title">{{__('general.Add Work')}}</h4>
                    </div>
                    <div class="card-body">
                        <form class="form" action="{{ route('work.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label class="col-form-label-sm" for="title">{{__('general.Title in english')}}</label>
                                            <input
                                                value="{{ old('title') }}"
                                                name="title"
                                                type="text"
                                                id="title"
                                                class="form-control form-control-sm @error('title') is-invalid @else {{ old('title') ? 'is-valid' : '' }} @enderror"
                                                placeholder="Title in english"
                                                required
                                            />
                                            @error('title')
                                            <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label class="col-form-label-sm" for="title_ar">{{__('general.Title in arabic')}}</label>
                                            <input
                                                value="{{ old('title_ar') }}"
                                                name="title_ar"
                                                type="text"
                                                id="title_ar"
                                                class="form-control form-control-sm @error('title_ar') is-invalid @else {{ old('title_ar') ? 'is-valid' : '' }} @enderror"
                                                placeholder="Title"
                                                required
                                            />
                                            @error('title_ar')
                                            <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="service_id" class="col-form-label-sm">{{__('general.Service')}}</label>
                                            <select
                                                name="service_id"
                                                required
                                                class="form-control mb-1 @error('service_id') is-invalid @else {{ old('service_id') ? 'is-valid' : '' }} @enderror"
                                                id="service_id">
                                                <option value="" selected>{{__('general.Select a service')}}</option>
                                                @foreach($services as $service)
                                                    <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                                        {{ App::getLocale() == 'ar' ? $service->name_ar : $service->name_en }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('service_id')
                                            <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="status" class="col-form-label-sm">{{__('general.Display')}}</label>
                                            <select
                                                name="status"
                                                required
                                                class="form-control mb-1 @error('status') is-invalid @else {{ old('status') !== null ? 'is-valid' : '' }} @enderror"
                                                id="status">
                                                <option selected>{{__('general.Select status')}}</option>
                                                <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>{{__('general.Hide')}}</option>
                                                <option value="1" {{ old('status') === '1' ? 'selected' : '' }}>{{__('general.Show')}}</option>
                                            </select>
                                            @error('status')
                                            <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="is_contact_us" class="col-form-label-sm">{{__('general.Display on Contact Us Page')}}</label>
                                            <select
                                                name="is_contact_us"
                                                required
                                                class="form-control mb-1 @error('is_contact_us') is-invalid @else {{ old('is_contact_us') !== null ? 'is-valid' : '' }} @enderror"
                                                id="is_contact_us">
                                                <option selected>{{__('general.Select option')}}</option>
                                                <option value="0" {{ old('is_contact_us') === '0' ? 'selected' : '' }}>{{__('general.No')}}</option>
                                                <option value="1" {{ old('is_contact_us') === '1' ? 'selected' : '' }}>{{__('general.Yes')}}</option>
                                            </select>
                                            @error('is_contact_us')
                                            <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="customFile">{{__('general.Images')}}</label>
                                            <div class="custom-file">
                                                <input
                                                    name="photos[]"
                                                    type="file"
                                                    multiple
                                                    class="custom-file-input @error('photos') is-invalid @else {{ old('photos') ? 'is-valid' : '' }} @enderror"
                                                    id="customFile"
                                                    required
                                                />
                                                <label class="custom-file-label" for="customFile">{{__('general.Choose files')}}</label>
                                            </div>
                                            @error('photos')
                                            <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="modal-footer">
                                        <div class="form-group col-md-12">
                                            <button type="submit" class="btn btn-primary mr-1">{{__('general.Submit')}}</button>
                                            <button type="reset" class="btn btn-outline-secondary">{{__('general.Reset')}}</button>
                                        </div>
                                    </div>
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
    <script>
        document.getElementById('customFile').addEventListener('change', function (e) {
            // Get the selected files
            var files = e.target.files;
            var fileNames = [];

            // Iterate through the files and add their names to the array
            for (var i = 0; i < files.length; i++) {
                fileNames.push(files[i].name);
            }

            // Join the file names into a single string, separated by commas
            var displayNames = fileNames.join(', ') || '{{__('general.Choose file')}} ';

            // Update the label text with the joined file names
            e.target.nextElementSibling.textContent = displayNames;
        });
    </script>


@stop
