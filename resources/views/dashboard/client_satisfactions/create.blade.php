
@extends('dashboard.layouts.master')
@section('title', __('general.Add client satisfaction') )
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('dashboard/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('dashboard/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('dashboard/app-assets/css/components.css') }}">

<style>
    .input-group .touchspin {
        height: calc(1.8125rem + 2px); /* Adjust to match the height of other form controls */
        padding: 0.375rem 0.75rem; /* Ensure padding matches the other input fields */
    }

    .touchspin .input-group-prepend,
    .touchspin .input-group-append {
        height: calc(1.8125rem + 2px); /* Adjust button height */
    }

    .touchspin input {
        width: 100%; /* Make the input width consistent with other form elements */
    }

</style>
@endsection
@section('content')


    <section id="multiple-column-form">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{__('general.Add Client Satisfactions')}}</h4>
                    </div>
                    <div class="card-body">
                        <form class="form" action="{{ route('client_satisfactions.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="name">{{__('general.Name in english')}}</label>
                                        <input
                                            value="{{ old('name') }}"
                                            name="name"
                                            type="text"
                                            id="name"
                                            class="form-control form-control-sm @error('name') is-invalid @else {{ old('name') ? 'is-valid' : '' }} @enderror"
                                            placeholder="john"
                                            required
                                        />
                                        @error('name')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label class="col-form-label-sm" for="name_ar">{{__('general.Name in arabic')}}</label>
                                            <input
                                                value="{{ old('name_ar') }}"
                                                name="name_ar"
                                                type="text"
                                                id="name_ar"
                                                class="form-control form-control-sm @error('name_ar') is-invalid @else {{ old('name_ar') ? 'is-valid' : '' }} @enderror"
                                                placeholder="john"
                                                required
                                            />
                                            @error('name_ar')
                                            <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="nick_name">{{__('general.Nick name in english')}}</label>
                                        <input
                                            value="{{ old('nick_name') }}"
                                            type="text"
                                            id="nick_name"
                                            class="form-control form-control-sm @error('nick_name') is-invalid @else {{ old('nick_name') ? 'is-valid' : '' }} @enderror"
                                            name="nick_name"
                                            placeholder="johny"
                                        />
                                        @error('nick_name')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label class="col-form-label-sm" for="nick_name_ar">{{__('general.Nick name in arabic')}}</label>
                                            <input
                                                value="{{ old('nick_name_ar') }}"
                                                type="text"
                                                id="nick_name_ar"
                                                class="form-control form-control-sm @error('nick_name_ar') is-invalid @else {{ old('nick_name_ar') ? 'is-valid' : '' }} @enderror"
                                                name="nick_name_ar"
                                                placeholder="johny"
                                            />
                                            @error('nick_name_ar')
                                            <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label for="customFile">{{__('general.Image')}}</label>
                                        <div class="custom-file form-control-sm">
                                            <input
                                                value="{{ old('photo') }}"
                                                name="photo"
                                                type="file"
                                                class="custom-file-input @error('photo') is-invalid @else {{ old('photo') ? 'is-valid' : '' }} @enderror"
                                                id="customFile"
                                            />
                                            <label class="custom-file-label" for="customFile">{{__('general.Choose file')}}</label>
                                        </div>
                                        @error('photo')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="ranked">{{__('general.Rank')}}</label>
                                        <div class="input-group" style="width: 100%">
                                            <input
                                                type="number"
                                                class="form-control form-control-sm touchspin @error('ranked') is-invalid @else {{ old('ranked') ? 'is-valid' : '' }} @enderror"
                                                id="ranked"
                                                name="ranked"
                                                value="{{ old('ranked', 5) }}"
                                                min="0"
                                                max="5"
                                                required
                                                style="height: 42px"
                                            />
                                        </div>
                                        @error('ranked')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="content">{{__('general.Content in english')}}</label>
                                        <div class="form-label-group mb-0">
                                            <textarea
                                                name="content"
                                                data-length="1000"
                                                class="form-control char-textarea @error('content') is-invalid @else {{ old('content') ? 'is-valid' : '' }} @enderror"
                                                id="textarea-counter"
                                                rows="3"
                                                placeholder="Experience the high level of satisfaction our clients...">{{ old('content') }}</textarea>
                                        </div>
                                        @error('content')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label class="col-form-label-sm" for="content_ar">{{__('general.Content in arabic')}}</label>
                                            <div class="form-label-group mb-0">
                                            <textarea
                                                name="content_ar"
                                                data-length="1000"
                                                class="form-control char-textarea @error('content_ar') is-invalid @else {{ old('content_ar') ? 'is-valid' : '' }} @enderror"
                                                id="textarea-counter"
                                                rows="3"
                                                placeholder="{{__('general.Experience the high level of satisfaction our clients...')}}">{{ old('content_ar') }}</textarea>
                                            </div>
                                            @error('content_ar')
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
            // Get the selected file name
            var fileName = e.target.files[0] ? e.target.files[0].name : '{{__('general.Choose file')}} ';
            // Update the label text
            e.target.nextElementSibling.textContent = fileName;
        });
    </script>
    <script src="{{asset('dashboard/app-assets/vendors/js/vendors.min.js')}}"></script>
    <script src="{{asset('dashboard/app-assets/js/scripts/forms/form-number-input.js')}}"></script>
@stop
