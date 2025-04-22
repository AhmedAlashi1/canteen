
@extends('dashboard.layouts.master')
@section('title', __('general.Update Blog') )
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
                        <h4 class="card-title">{{__('general.Update Blog')}}</h4>
                    </div>
                    <div class="card-body">
                        <form class="form" action="{{ route('blog.update',$blog->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label class="col-form-label-sm" for="title">{{__('general.Title in english')}}</label>
                                            <textarea
                                                name="title"
                                                type="text"
                                                id="title"
                                                class="form-control char-textarea @error('title') is-invalid @else {{ old('title') ? 'is-valid' : '' }} @enderror"
                                                placeholder="Title"
                                                required
                                            >{{ $blog->title_en }}</textarea>
                                            @error('title')
                                            <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label class="col-form-label-sm" for="title_ar">{{__('general.Title in arabic')}}</label>
                                            <textarea
                                                name="title_ar"
                                                type="text"
                                                id="title_ar"
                                                class="form-control char-textarea @error('title_ar') is-invalid @else {{ old('title_ar') ? 'is-valid' : '' }} @enderror"
                                                placeholder="العنوان "
                                                required
                                            >{{ $blog->title_ar }}</textarea>
                                            @error('title_ar')
                                            <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label class="col-form-label-sm" for="desc">
                                                {{__('general.Description in english')}}
                                                <span class="text-muted">{{__('general.(optional)')}}</span>
                                            </label>
                                            <textarea
                                                name="desc"
                                                type="text"
                                                id="desc"
                                                class="form-control char-textarea @error('desc') is-invalid @else {{ old('desc') ? 'is-valid' : '' }} @enderror"
                                                placeholder="Description.."
                                            >{{ $blog->desc_en }}</textarea>
                                            @error('desc')
                                            <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label class="col-form-label-sm" for="desc_ar">
                                                {{__('general.Description in arabic')}}
                                                <span class="text-muted">{{__('general.(optional)')}}</span>
                                            </label>
                                            <textarea
                                                name="desc_ar"
                                                type="text"
                                                id="desc_ar"
                                                class="form-control char-textarea @error('desc_ar') is-invalid @else {{ old('desc_ar') ? 'is-valid' : '' }} @enderror"
                                                placeholder="{{__('general.Description in arabic')}}.."
                                            >{{ $blog->desc_ar }}</textarea>
                                            @error('desc_ar')
                                            <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{--                                    html--}}
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label class="col-form-label-sm" for="title">key url</label>
                                            <input
                                                value="{{ $blog->key_url }}"
                                                name="key_url"
                                                type="text"
                                                id="key_url"
                                                class="form-control form-control-sm @error('key_url') is-invalid @else {{ old('key_url') ? 'is-valid' : '' }} @enderror"
                                                placeholder="key_url"

                                                required
                                            />
                                            @error('key_url')
                                            <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label class="col-form-label-sm" for="title">{{__('general.Title in english')}} Tag</label>
                                            <input
                                                name="title_html_en"
                                                type="text"
                                                id="title"
                                                class="form-control char-textarea @error('title_html_en') is-invalid @else {{ old('title_html_en') ? 'is-valid' : '' }} @enderror"
                                                placeholder="Title"
                                                value="{{ $blog->title_html_en }}"
                                            >
                                            @error('title_html_en')
                                            <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label class="col-form-label-sm" for="title_html_ar">{{__('general.Title in arabic')}} Tag</label>
                                            <input
                                                name="title_html_ar"
                                                type="text"
                                                id="title_ar"
                                                class="form-control char-textarea @error('title_html_ar') is-invalid @else {{ old('title_html_ar') ? 'is-valid' : '' }} @enderror"
                                                placeholder="العنوان "
                                                value="{{ $blog->title_html_ar }}"

                                            >
                                            @error('title_html_ar')
                                            <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label class="col-form-label-sm" for="desc">
                                                {{__('general.Description in english')}} google
                                                <span class="text-muted">{{__('general.(optional)')}}</span>
                                            </label>
                                            <textarea
                                                name="desc_html_en"
                                                type="text"
                                                id="desc"
                                                class="form-control char-textarea @error('desc_html_en') is-invalid @else {{ old('desc_html_en') ? 'is-valid' : '' }} @enderror"
                                                placeholder="Description.."
                                            >       {{ $blog->desc_html_en }}</textarea>
                                            @error('desc_html_en')
                                            <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label class="col-form-label-sm" for="desc_ar">
                                                {{__('general.Description in arabic')}} google
                                                <span class="text-muted">{{__('general.(optional)')}}</span>
                                            </label>
                                            <textarea
                                                name="desc_html_ar"
                                                type="text"
                                                id="desc_ar"
                                                class="form-control char-textarea @error('desc_html_ar') is-invalid @else {{ old('desc_html_ar') ? 'is-valid' : '' }} @enderror"
                                                placeholder="{{__('general.Description in arabic')}}.."
                                            >{{ $blog->desc_html_en }}</textarea>
                                            @error('desc_html_ar')
                                            <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{--                                    html--}}


                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label class="col-form-label-sm" for="by">{{__('general.By')}}</label>
                                            <input
                                                value="{{ $blog->by }}"
                                                name="by"
                                                type="text"
                                                id="by"
                                                class="form-control form-control-sm @error('by') is-invalid @else {{ old('by') ? 'is-valid' : '' }} @enderror"
                                                placeholder="Gwen Stacy"
                                                required
                                            />
                                            @error('by')
                                            <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label class="col-form-label-sm" for="fp-human-friendly">{{__('general.date')}}</label>
                                            <input
                                                value="{{$blog->date }}"
                                                name="date"
                                                type="text"
                                                id="fp-human-friendly"
                                                class="form-control flatpickr-human-friendly form-control-sm @error('date') is-invalid @else {{ old('date') ? 'is-valid' : '' }} @enderror"
                                                placeholder="October 14, 2020"
                                                required
                                            />
                                            @error('date')
                                            <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="customFile">
                                                {{__('general.Image')}}
                                                <span class="text-muted">{{__('general.(optional)')}}</span>
                                            </label>
                                            <div class="custom-file">
                                                <input
                                                    name="photo"
                                                    type="file"
                                                    multiple
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
                                            <label for="blog_type_id" class="col-form-label-sm">{{__('general.Blog Type')}}</label>
                                            <select
                                                name="blog_type_id"
                                                required
                                                class="form-control mb-1 @error('blog_type_id') is-invalid @else {{ old('blog_type_id') ? 'is-valid' : '' }} @enderror"
                                                id="blog_type_id">
                                                <option >{{__('general.Select a blog type')}}</option>
                                                @foreach($blogTypes as $blogType)
                                                    <option value="{{ $blogType->id }}" {{ old('blog_type_id',$blog->blog_type_id) == $blogType->id ? 'selected' : '' }}>
                                                        {{ $blogType->name_en }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('blog_type_id')
                                            <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="way_to_add_blog" class="col-form-label-sm">
                                                {{__('general.Way to Add the Blog')}}
                                                <span class="text-muted">{{__('general.(optional)')}}</span>
                                            </label>
                                            <select
                                                name="way_to_add_blog"
                                                required
                                                class="form-control mb-1"
                                                id="way_to_add_blog"
                                                onchange="toggleShortLinkInput(this)">
                                                <option value="manual" {{ (old('way_to_add_blog') === 'manual' || ($blog->content !== null && $blog->short_link === null)) ? 'selected' : '' }}>Manual</option>
                                                <option value="short_link" {{ (old('way_to_add_blog') === 'short_link' || ($blog->short_link !== null && $blog->content === null)) ? 'selected' : '' }}>Short Link</option>
                                            </select>
                                            <small class="text-muted d-block mt-2" style="opacity: 1;">
                                                {{__('general.Note: if you update without change the')}} <span class="text-black">( {{__('general.Way to Add the Blog')}} ) </span> {{__('general.the blog will keep save the old way .')}}
                                            </small>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-12" id="short-link-input" style="display: {{ old('way_to_add_blog') === 'short_link' ? 'block' : 'none' }};">
                                        <div class="form-group">
                                            <label for="short_link" class="col-form-label-sm">{{__('general.Short Link')}}</label>
                                            <input
                                                type="text"
                                                name="short_link"
                                                id="short_link"
                                                class="form-control"
                                                placeholder="Enter short link"
                                                value="{{$blog->short_link}}">
                                        </div>
                                    </div>

                                    <div class="col-12" id="content-area1" style="display: {{ old('way_to_add_blog')  === 'short_link' || ($blog->content_en == null) ? 'none' : 'block' }};">
                                        <div class="form-group">
                                            <label for="content">{{__('general.Content')}}</label>
                                            <textarea name="content" id="editor1" class="form-control">{{$blog->content_en}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12" id="content-area2" style="display: {{ old('way_to_add_blog')  === 'short_link' || ($blog->content_en == null) ? 'none' : 'block' }};">
                                        <div class="form-group">
                                            <label for="content">{{__('general.Content in arabic')}}</label>
                                            <textarea name="content_ar" id="editor2" class="editor form-control">{{$blog->content_ar}}</textarea>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <div class="form-group col-md-12">
                                            <button type="submit" class="btn btn-primary mr-1">{{__('general.Update')}}</button>
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
        document.addEventListener('DOMContentLoaded', function () {
            const wayToAddBlogSelect = document.getElementById('way_to_add_blog');
            toggleShortLinkInput(wayToAddBlogSelect); // Call the function on load
        });

        function toggleShortLinkInput(selectElement) {
            const shortLinkInput = document.getElementById('short-link-input');
            const contentArea1 = document.getElementById('content-area1');
            const contentArea2 = document.getElementById('content-area2');

            if (selectElement.value === 'short_link') {
                shortLinkInput.style.display = 'block';
                contentArea1.style.display = 'none';
                contentArea2.style.display = 'none';
            } else {
                shortLinkInput.style.display = 'none';
                contentArea1.style.display = 'block';
                contentArea2.style.display = 'block';
            }
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
