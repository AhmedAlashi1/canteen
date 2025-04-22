
@extends('dashboard.layouts.master')
@section('title', __('general.Add service') )
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
                        <h4 class="card-title">{{__('general.Add service')}}</h4>
                    </div>
                    <div class="card-body">
                        <form class="form" action="{{ route('services.store') }}" method="post" enctype="multipart/form-data">
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

                                <div class="col-md-6 col-6">
                                    <div class="form-group">
                                        <label for="is_home">{{__('general.Is Home')}}</label>
                                        <select name="is_home" class="form-control" id="is_home">
                                            <option value="0">{{__('general.No')}}</option>
                                            <option value="1" >1</option>
                                            <option value="2" >2</option>
                                            <option value="3" >3</option>
                                            <option value="4" >4</option>
                                            <option value="5" >5</option>
                                            <option value="6" >6</option>
                                        </select>
                                        @error('is_home')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-6">
                                    <div class="form-group">
                                        <label for="is_home_work">{{__('general.Is Home Work')}}</label>
                                        <select name="is_home_work" class="form-control" id="is_home_work">
                                            <option value="0" >{{__('general.No')}}</option>
                                            <option value="1" >1</option>
                                            <option value="2" >2</option>
                                            <option value="3" >3</option>
                                            <option value="4" >4</option>
                                            <option value="5" >5</option>
                                            <option value="6" >6</option>
                                        </select>
                                        @error('is_home_work')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label for="customFile">{{__('general.Icon')}}</label>
                                        <div class="custom-file">
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

                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="customFile">{{__('general.Image')}}</label>
                                            <div class="custom-file">
                                                <input
                                                    name="photo2"
                                                    type="file"
                                                    class="custom-file-input @error('photo2') is-invalid @else {{ old('photo2') ? 'is-valid' : '' }} @enderror"
                                                    id="customFile"
                                                />
                                                <label class="custom-file-label" for="customFile">{{__('general.Choose file')}}</label>
                                            </div>
                                            @error('photo2')
                                            <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="desc">{{__('general.Description in english')}}</label>
                                        <div class="form-label-group mb-0">
                                            <textarea
                                                name="desc"
                                                data-length="1000"
                                                class="form-control char-textarea @error('desc') is-invalid @else {{ old('desc') ? 'is-valid' : '' }} @enderror"
                                                id="textarea-counter"
                                                rows="3"
                                                placeholder="We design intuitive, engaging mobile apps...">{{ old('desc') }}</textarea>
                                        </div>
                                        @error('desc')
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
                                                placeholder="We design intuitive, engaging mobile apps...">{{ old('desc_ar') }}</textarea>
                                        </div>
                                        @error('desc_ar')
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
                                                required
                                            />
                                            @error('title_ar')
                                            <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label class="col-form-label-sm" for="name_ar">{{__('general.title_en')}}</label>
                                            <input
                                                name="title_en"
                                                type="text"
                                                id="title_en"
                                                class="form-control form-control-sm @error('title_en') is-invalid @else {{ old('title_en') ? 'is-valid' : '' }} @enderror"
                                                placeholder="john"
                                                required
                                            />
                                            @error('title_en')
                                            <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12" id="content-area1" style="display: block ;">
                                        <div class="form-group">
                                            <label for="content">{{__('general.Content')}}</label>
                                            <textarea name="content_en" id="editor1" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-12" id="content-area2" style="display: block ">
                                        <div class="form-group">
                                            <label for="content">{{__('general.Content in arabic')}}</label>
                                            <textarea name="content_ar" id="editor2" class="editor form-control"></textarea>
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
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@3.2.7/css/froala_editor.pkgd.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/froala-editor@3.2.7/js/froala_editor.pkgd.min.js"></script>
    <script>
        new FroalaEditor('#editor2', {
            language: 'ar',  // تعيين اللغة إلى العربية
            direction: 'rtl', // تعيين الاتجاه من اليمين لليسار
            // pluginsEnabled: ['image', 'link', 'video', 'table', 'lists', 'align', 'emoticons', 'wordpaste'],
            // toolbarButtons: ['bold', 'italic', 'underline', '|', 'formatOL', 'formatUL', '|', 'link', 'image', 'video'],
            imageUploadURL: "{{ route('blog.ckeditor.upload', ['_token' => csrf_token()]) }}",  // رابط رفع الصور
            imageUploadParams: {
                id: 'editor2',  // معرف المحرر
                _token: '{{ csrf_token() }}'
            },
            imageUploadMethod: 'POST', // تحديد طريقة رفع الصور
            imageUploadRemoteUrls: true, // السماح برفع الصور عبر روابط الإنترنت
            height: 200, // تحديد الارتفاع
            attribution: false,  // تعطيل الشريط
            // heightMin: 300, // تحديد الارتفاع الأدنى
        });

    </script>
    <script>
        new FroalaEditor('#editor1', {

            imageUploadURL: "{{ route('blog.ckeditor.upload', ['_token' => csrf_token()]) }}",  // رابط رفع الصور
            imageUploadParams: {
                id: 'editor1',  // معرف المحرر
                _token: '{{ csrf_token() }}'
            },
            imageUploadMethod: 'POST', // تحديد طريقة رفع الصور
            imageUploadRemoteUrls: true, // السماح برفع الصور عبر روابط الإنترنت
            height: 200, // تحديد الارتفاع
            attribution: false,  // تعطيل الشريط
            // heightMin: 300, // تحديد الارتفاع الأدنى
        });

    </script>
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
