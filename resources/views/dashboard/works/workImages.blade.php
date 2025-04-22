
@extends('dashboard.layouts.master')
@section('title', __('general.Work Images') )
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('dashboard/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('dashboard/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('dashboard/app-assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <style>
        .image-wrapper {
            position: relative;
            overflow: hidden;
            border-radius: 3.5rem;
            transition: transform 0.3s ease; /* Smooth scaling */
        }

        .image-wrapper:hover {
            transform: scale(1.02); /* Slight zoom on hover */
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 16px;
            bottom: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: background-color 0.3s ease, opacity 0.3s ease; /* Smooth background and visibility */
            background-color: rgba(0, 0, 0, 0); /* Initially transparent */
            border-radius: 3.5rem;
        }

        [dir="ltr"] .overlay {
            left: 13px;
        }

        .image-wrapper:hover .overlay {
            background-color: rgba(0, 0, 0, 0.5); /* Dark overlay on hover */
            opacity: 1; /* Fade-in effect */
        }

        .delete-icon {
            background: none;
            border: none;
            outline: none;
            padding: 0;
            cursor: pointer;
            transition: transform 0.3s ease; /* Smooth scaling */
        }

        .delete-icon:hover {
            transform: scale(1.2); /* Slightly enlarge icon on hover */
        }

        .delete-icon i {
            font-size: 2rem; /* Adjust size as needed */
            color: #ff0000;
            transition: color 0.3s ease; /* Smooth color transition */
        }
    </style>

@endsection
@section('content')

    <section>
        <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{__('general.Add new images')}}</h4>
                </div>
                <div class="card-body">
                    <form class="form" action="{{ route('work.new-image',$work->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="customFile">{{__('general.Images')}}</label>
                                        <div class="custom-file">
                                            <input
                                                name="photos[]"
                                                type="file"
                                                multiple
                                                class="custom-file-input"
                                                id="customFile"
                                                required
                                            />
                                            <label class="custom-file-label" for="customFile">{{__('general.Choose files')}}</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="modal-footer">
                                    <div class="form-group col-md-12">
                                        <button type="submit" class="btn btn-primary mr-1">{{__('general.Add')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    @foreach($work->images as $image)
                        <div style="height: 400px;" class="mb-1 col-12 col-xl-4 col-md-6 position-relative image-wrapper">
                            <img height="100%" width="100%" alt="work image" class="col-12" style=" border-radius: 3.5rem; padding: 0rem 0; box-shadow: 1px 4px #c3c2c7;" src="{{ asset($image->image) }}">

                            <div class="overlay" style="height: 100%; width : 92%;">
                                <button class="delete-icon delete-btn" type="button" data-url="{{ route('work.image.delete', $image) }}">
                                    <i style="color: #ff0000;" class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

@endsection
@section('js')
    <script src="{{ asset('dashboard/app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
    <script>
        $(document).on('click', '.delete-btn', function () {
            let url = $(this).data('url');
            let imageWrapper = $(this).closest('.image-wrapper'); // Reference to the image wrapper

            Swal.fire({
                title: "{{__('dataTable.Delete Operation')}}",
                text: "{{__('dataTable.will not able to revert')}}",
                type: "{{__('dataTable.warning')}}",
                showCancelButton: true,
                confirmButtonColor: "#ff0000",
                cancelButtonColor: "#898a8c",
                confirmButtonText: "{{__('dataTable.Delete')}}",
                confirmButtonClass: 'btn btn-danger',
                cancelButtonClass: 'btn bg-secondary bg-lighten-2 text-white ml-1',
                buttonsStyling: false,
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success(response) {
                            console.log(response);
                            Swal.fire({
                                title: "{{__('dataTable.success')}}",
                                text: "{{__('dataTable.deleted successfully')}}",
                                type: "success",
                                confirmButtonClass: 'btn btn-success',
                            });
                            // Smoothly slide up and fade out the image wrapper
                            imageWrapper.animate({
                                opacity: 0,
                                height: 'toggle'
                            }, 600, function() {
                                $(this).remove();
                            });
                        },
                        error(error) {
                            console.log(error);
                            Swal.fire({
                                type: "error",
                                title: "{{__('dataTable.oops')}}",
                                text: "{{__('dataTable.something wrong')}}"
                            });
                        }
                    });
                }
            });
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

    <script>
        function deleteImage(imageId) {
            // You can add the logic to delete the image here
            console.log("Delete image with ID:", imageId);
        }
    </script>


@stop
