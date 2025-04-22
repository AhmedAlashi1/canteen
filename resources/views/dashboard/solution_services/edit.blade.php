
@extends('dashboard.layouts.master')
@section('title', __('general.Update service') )
@section('css')
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('dashboard/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('dashboard/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('dashboard/app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('dashboard/app-assets/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('dashboard/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('dashboard/app-assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('dashboard/app-assets/css/plugins/forms/pickers/form-pickadate.css') }}">
    <style>
        .ck-editor__editable_inline{
            height: 450px;
        }
    </style>
@endsection
@section('content')


    <section id="multiple-column-form">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{__('general.Update service')}}</h4>
                    </div>
                    <div class="card-body">
                        <form class="form" action="{{ route('SolutionServices.update',$solution_service->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <input type="hidden" name="service_id" value="{{$solution_service->service_id}}">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="name_ar">{{__('general.title_en')}}</label>
                                        <input
                                            name="title_en"
                                            type="text"
                                            id="title_en"
                                            class="form-control form-control-sm @error('title_en') is-invalid @else {{ old('title_en') ? 'is-valid' : '' }} @enderror"
                                            placeholder="john"
                                            value="{{$solution_service->title_en}}"
                                            required
                                        />
                                        @error('title_en')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="name">{{__('general.title_ar')}}</label>
                                        <input
                                            name="title_ar"
                                            type="text"
                                            id="name"
                                            class="form-control form-control-sm @error('title_ar') is-invalid @else {{ old('title_ar') ? 'is-valid' : '' }} @enderror"
                                            placeholder="john"
                                            value="{{$solution_service->title_ar}}"
                                            required
                                        />
                                        @error('title_ar')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="desc">{{__('general.Description in english')}}</label>
                                        <div class="form-label-group mb-0">
                                            <textarea
                                                name="desc_en"
                                                data-length="1000"
                                                class="form-control char-textarea @error('desc_en') is-invalid @else {{ old('desc_en') ? 'is-valid' : '' }} @enderror"
                                                id="textarea-counter"
                                                rows="3"

                                                placeholder="We design intuitive, engaging mobile apps...">
                                                {{$solution_service->desc_en}}
                                            </textarea>
                                        </div>
                                        @error('desc_en')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="desc_ar">{{__('general.Description in arabic')}}</label>
                                        <div class="form-label-group mb-0">
                                            <textarea
                                                name="desc_ar"
                                                data-length="1000"
                                                class="form-control char-textarea @error('desc_ar') is-invalid @else {{ old('desc_ar') ? 'is-valid' : '' }} @enderror"
                                                id="textarea-counter"
                                                rows="3"
                                                placeholder="We design intuitive, engaging mobile apps...">
                                                {{$solution_service->desc_ar}}
                                            </textarea>
                                        </div>
                                        @error('desc_ar')
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const wayToAddBlogSelect = document.getElementById('way_to_add_blog');
            toggleShortLinkInput(wayToAddBlogSelect); // Call the function on load
        });

        function toggleShortLinkInput(selectElement) {
            const contentArea1 = document.getElementById('content-area1');
            const contentArea2 = document.getElementById('content-area2');

            contentArea1.style.display = 'block';
            contentArea2.style.display = 'block';

        }
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor1'), {
                ckfinder: {
                    uploadUrl: "{{ route('blog.ckeditor.upload', ['_token' => csrf_token()]) }}"
                }
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor2'), {
                ckfinder: {
                    uploadUrl: "{{ route('blog.ckeditor.upload', ['_token' => csrf_token()]) }}"
                }
            })
            .catch(error => {
                console.error(error);
            });
    </script>
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
    <script src="{{asset('dashboard/app-assets/vendors/js/pickers/pickadate/picker.js')}}"></script>
    <script src="{{asset('dashboard/app-assets/vendors/js/pickers/pickadate/picker.date.js')}}"></script>
    <script src="{{asset('dashboard/app-assets/vendors/js/pickers/pickadate/picker.time.js')}}"></script>
    <script src="{{asset('dashboard/app-assets/vendors/js/pickers/pickadate/legacy.js')}}"></script>
    <script src="{{asset('dashboard/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('dashboard/app-assets/js/scripts/forms/pickers/form-pickers.js')}}"></script>

@stop
