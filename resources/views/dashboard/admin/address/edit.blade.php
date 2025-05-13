@extends('dashboard.layouts.master')
@section('title', __('Update regions') )
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
                        <h4 class="card-title">{{__('general.update regions')}} </h4>
                    </div>
                    <div class="card-body">
                        <form class="form" action="{{ route('admin.regions.update', $id) }}" method="post" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <!-- Name Arabic -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="name_ar">{{__('general.Name in Arabic')}}</label>
                                        <input
                                            value="{{ old('name_ar', $region->name_ar) }}"
                                            name="name_ar"
                                            type="text"
                                            id="name_ar"
                                            class="form-control form-control-sm @error('name_ar') is-invalid @else {{ old('name_ar', $region->name_ar) ? 'is-valid' : '' }} @enderror"
                                            placeholder="اسم المدرسة"
                                            required
                                        />
                                        @error('name_ar') <span class="col-form-label-sm text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <!-- Name English -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="name_en">{{__('general.Name in English')}}</label>
                                        <input
                                            value="{{ old('name_en', $region->name_en) }}"
                                            name="name_en"
                                            type="text"
                                            id="name_en"
                                            class="form-control form-control-sm @error('name_en') is-invalid @else {{ old('name_en', $region->name_en) ? 'is-valid' : '' }} @enderror"
                                            placeholder="School Name"
                                            required
                                        />
                                        @error('name_en') <span class="col-form-label-sm text-danger">{{ $message }}</span> @enderror
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
                                            <option value="1" {{ old('status', $region->status ?? '') == 1 ? 'selected' : '' }}>{{ __('general.Active') }}</option>
                                            <option value="0" {{ old('status', $region->status ?? '') != 1 ? 'selected' : '' }}>{{ __('general.Inactive') }}</option>
                                        </select>
                                        @error('status')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <!-- Submit -->
                                <div class="col-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">{{ __('general.Update') }}</button>
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

@stop
@section('js')
    <script>
        function loadRegions(cityId, selectedRegionId = null) {
            if (!cityId) return;

            $.ajax({
                url: "{{ route('admin.get.regions') }}",
                type: "GET",
                data: { city_id: cityId },
                beforeSend: function () {
                    $('#region_id').html('<option>جاري التحميل...</option>');
                },
                success: function (res) {
                    $('#region_id').empty();
                    if (res.length > 0) {
                        $.each(res, function (key, value) {
                            let selected = selectedRegionId == value.id ? 'selected' : '';
                            $('#region_id').append(`<option value="${value.id}" ${selected}>${value.name_ar}</option>`);
                        });
                    } else {
                        $('#region_id').append('<option value="">لا توجد مناطق</option>');
                    }
                },
                error: function () {
                    $('#region_id').html('<option value="">فشل في تحميل المناطق</option>');
                }
            });
        }

        $(document).ready(function () {
            let $city = $('#city_id');
            let $region = $('#region_id');

            if ($city.length && $region.length) {
                let initialCityId = $city.val();
                if (initialCityId) {
                    loadRegions(initialCityId, '{{ old('region_id') ?? $model->region_id ?? null }}');
                }

                $city.on('change', function () {
                    let cityId = $(this).val();
                    loadRegions(cityId);
                });
            }
        });
    </script>
@endsection

