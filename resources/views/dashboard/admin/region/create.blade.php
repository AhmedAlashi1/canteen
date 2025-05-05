@extends('dashboard.layouts.master')
@section('title', __('Add regions') )
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
                        <h4 class="card-title">{{__('general.Add regions')}}</h4>
                    </div>
                    <div class="card-body">
                        <form class="form" action="{{ route('admin.regions.store',$id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <!-- Name Arabic -->
                                <input type="hidden" name="id" value="{{$id}}">

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="name_ar">{{__('general.Name in Arabic')}}</label>
                                        <input
                                            value="{{ old('name_ar') }}"
                                            name="name_ar"
                                            type="text"
                                            id="name_ar"
                                            class="form-control form-control-sm @error('name_ar') is-invalid @else {{ old('name_ar') ? 'is-valid' : '' }} @enderror"
                                            placeholder="Name in Arabic"
                                            required
                                        />
                                        @error('name_ar')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Name English -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="name_en">{{__('general.Name in English')}}</label>
                                        <input
                                            value="{{ old('name_en') }}"
                                            name="name_en"
                                            type="text"
                                            id="name_en"
                                            class="form-control form-control-sm @error('name_en') is-invalid @else {{ old('name_en') ? 'is-valid' : '' }} @enderror"
                                            placeholder="Name in English"
                                            required
                                        />
                                        @error('name_en')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="status">{{__('general.Status')}}</label>
                                        <select
                                            name="status"
                                            id="status"
                                            class="form-control form-control-sm @error('status') is-invalid @else {{ old('status') ? 'is-valid' : '' }} @enderror"
                                            required
                                        >
                                            <option value="1" >{{ __('general.Active') }}</option>
                                            <option value="0" >{{ __('general.Inactive') }}</option>
                                        </select>
                                        @error('status')
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
