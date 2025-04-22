
@extends('dashboard.layouts.master')
@section('title', __('general.Add Term & Condition') )
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
                        <h4 class="card-title">{{__('general.Add Term & Condition')}}</h4>
                    </div>
                    <div class="card-body">
                        <form class="form" action="{{ route('term.store') }}" method="post">
                            @csrf
                            <div class="row">
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
                                                required
                                                placeholder="Description...">{{ old('desc') }}</textarea>
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
                                                required
                                                placeholder="Description...">{{ old('desc_ar') }}</textarea>
                                        </div>
                                        @error('desc_ar')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="service_id" class="col-form-label-sm">{{__('general.Service')}}</label>
                                        <select
                                            name="service_name"
                                            required
                                            class="form-control mb-1 @error('service_name') is-invalid @else {{ old('service_name') ? 'is-valid' : '' }} @enderror"
                                            id="service_id"
                                            onchange="toggleNewServiceInput(this)">
                                            <option  selected>{{__('general.Select a service')}}</option>
                                            @foreach($services as $service)
                                                <option value="{{ $service->service_name_en }}" {{ old('service_name') == $service->service_name_en ? 'selected' : '' }}>
                                                    {{ App::getLocale() === 'ar' ? $service->service_name_ar : $service->service_name_en  }}
                                                </option>
                                            @endforeach
                                            <option value="new" {{ old('service_name') == 'new' ? 'selected' : '' }}>{{__('general.Add new service')}}</option>
                                        </select>

                                        @error('service_name')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-12 col-12" id="new-service-input" style="display: none;">
                                    <div class="form-group">
                                        <label for="new_service_name" class="col-form-label-sm">{{__('general.New Service Name in english')}}</label>
                                        <input
                                            type="text"
                                            name="new_service_name"
                                            id="new_service_name"
                                            class="form-control @error('new_service_name') is-invalid @else {{ old('new_service_name') ? 'is-valid' : '' }} @enderror"
                                            placeholder="Enter new service name in english"
                                            value="{{ old('new_service_name') }}">

                                        @error('new_service_name')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 col-12" id="new-service-input-ar" style="display: none;">
                                    <div class="form-group">
                                        <label for="new_service_name_ar" class="col-form-label-sm">{{__('general.New Service Name in arabic')}}</label>
                                        <input
                                            type="text"
                                            name="new_service_name_ar"
                                            id="new_service_name_ar"
                                            class="form-control @error('new_service_name_ar') is-invalid @else {{ old('new_service_name_ar') ? 'is-valid' : '' }} @enderror"
                                            placeholder="Enter new service name in arabic"
                                            value="{{ old('new_service_name_ar') }}">

                                        @error('new_service_name_ar')
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
        document.addEventListener('DOMContentLoaded', function () {
            const serviceSelect = document.getElementById('service_id');
            toggleNewServiceInput(serviceSelect); // Call the function on load
        });

        function toggleNewServiceInput(selectElement) {
            const newServiceInput = document.getElementById('new-service-input');
            const newServiceInputAr = document.getElementById('new-service-input-ar');

            if (selectElement.value === 'new') {
                newServiceInput.style.display = 'block';
                newServiceInputAr.style.display = 'block';
            } else {
                newServiceInput.style.display = 'none';
                newServiceInputAr.style.display = 'none';
                document.getElementById('new_service_name').value = ''; // Clear the input
                document.getElementById('new_service_name_ar').value = ''; // Clear the input
            }
        }
    </script>

@stop
