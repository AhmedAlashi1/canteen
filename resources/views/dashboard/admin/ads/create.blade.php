@extends('dashboard.layouts.master')
@section('title', __('general.Add Ads') )
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
                        <h4 class="card-title">{{__('general.Add Ads')}}</h4>
                    </div>
                    <div class="card-body">
                        <form class="form" action="{{ route('admin.ads.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <!-- Name English -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="name_en">{{__('general.Name')}}</label>
                                        <input
                                            value="{{ old('name') }}"
                                            name="name"
                                            type="text"
                                            id="name"
                                            class="form-control form-control-sm @error('name') is-invalid @else {{ old('name') ? 'is-valid' : '' }} @enderror"
                                            placeholder="Name"
                                            required
                                        />
                                        @error('name')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="link">{{__('general.link')}}</label>
                                        <input
                                            value="{{ old('link') }}"
                                            name="link"
                                            type="url"
                                            id="link"
                                            class="form-control form-control-sm @error('link') is-invalid @else {{ old('link') ? 'is-valid' : '' }} @enderror"
                                            placeholder="link"
                                            required
                                        />
                                        @error('link')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Image -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="image">{{__('general.Image')}}</label>
                                        <div class="custom-file">
                                        <input
                                            value="{{ old('image') }}"
                                            name="image"
                                            type="file"
                                            class="custom-file-input @error('image') is-invalid @else {{ old('image') ? 'is-valid' : '' }} @enderror"
                                            id="customFile"
                                        />
                                            <label class="custom-file-label" for="customFile">{{__('general.Choose file')}}</label>
                                        </div>
                                        @error('image')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <!-- Submit Button -->
                                <div class="col-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">{{ __('general.Save') }}</button>
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
        function loadRegions(cityId, selectedRegionId = null) {
            $.ajax({
                url: "{{ route('admin.get.regions') }}",
                type: "GET",
                data: { city_id: cityId },
                success: function (res) {
                    $('#region_id').empty();
                    $.each(res, function (key, value) {
                        let selected = selectedRegionId == value.id ? 'selected' : '';
                        $('#region_id').append(`<option value="${value.id}" ${selected}>${value.name_ar}</option>`);
                    });
                }
            });
        }

        $(document).ready(function () {
            // أول تحميل
            let initialCityId = $('#city_id').val();
            if (initialCityId) {
                loadRegions(initialCityId);
            }

            // عند تغيير المدينة
            $('#city_id').on('change', function () {
                let cityId = $(this).val();
                loadRegions(cityId);
            });
        });
    </script>
@endsection
