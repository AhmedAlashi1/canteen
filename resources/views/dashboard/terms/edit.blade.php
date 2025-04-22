
@extends('dashboard.layouts.master')
@section('title', __('general.Update Term & Condition') )
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
                        <h4 class="card-title">{{__('general.Update Term & Condition')}}</h4>
                    </div>
                    <div class="card-body">
                        <form class="form" action="{{ route('term.update',$term->id) }}" method="post">
                            @csrf
                            @method('PUT')
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
                                                placeholder="Description...">{{$term->desc_en}}</textarea>
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
                                                placeholder="Description...">{{ $term->desc_ar }}</textarea>
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
                                            class="form-control mb-1 @error('service_name') is-invalid @else {{ old('service_name') ? 'is-valid' : '' }} @enderror"
                                            id="service_name">
                                            <option  selected>{{__('general.Select a service')}}</option>
                                        @foreach($services as $service)
                                                <option value="{{ $service->service_name_en }}" {{ old('service_name',$term->service_name_en) == $service->service_name_en ? 'selected' : '' }}>
                                                    {{ App::getLocale() === 'ar' ? $service->service_name_ar : $service->service_name_en  }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('service_name')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>




                                <div class="modal-footer">
                                    <div class="form-group col-md-12">
                                        <button type="submit" class="btn btn-primary mr-1">{{__('general.Update')}}</button>
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

@stop
