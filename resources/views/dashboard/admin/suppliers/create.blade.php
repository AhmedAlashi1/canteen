@extends('dashboard.layouts.master')
@section('title', __('general.Add Supplier') )
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
                        <h4 class="card-title">{{__('general.Add Supplier')}}</h4>
                    </div>
                    <div class="card-body">
                        <form class="form" action="{{ route('admin.suppliers.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <!-- Name Arabic -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="name">{{__('general.Name')}}</label>
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
                                <!-- Email -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="email">{{__('general.email')}}</label>
                                        <input
                                            value="{{ old('email') }}"
                                            name="email"
                                            type="email"
                                            id="email"
                                            class="form-control form-control-sm @error('email') is-invalid @else {{ old('email') ? 'is-valid' : '' }} @enderror"
                                            placeholder="email"
                                            required
                                        />
                                        @error('email')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="phone">{{__('general.phone')}}</label>
                                        <input
                                            value="{{ old('phone') }}"
                                            name="phone"
                                            type="text"
                                            id="phone"
                                            class="form-control form-control-sm @error('phone') is-invalid @else {{ old('phone') ? 'is-valid' : '' }} @enderror"
                                            placeholder="phone"
                                            required
                                        />
                                        @error('phone')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="company_name">{{__('general.company_name')}}</label>
                                        <input
                                            value="{{ old('company_name') }}"
                                            name="company_name"
                                            type="text"
                                            id="company_name"
                                            class="form-control form-control-sm @error('company_name') is-invalid @else {{ old('company_name') ? 'is-valid' : '' }} @enderror"
                                            placeholder="company_name"
                                            required
                                        />
                                        @error('company_name')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="whatsapp">{{__('general.whatsapp')}}</label>
                                        <input
                                            value="{{ old('whatsapp') }}"
                                            name="whatsapp"
                                            type="text"
                                            id="whatsapp"
                                            class="form-control form-control-sm @error('whatsapp') is-invalid @else {{ old('whatsapp') ? 'is-valid' : '' }} @enderror"
                                            placeholder="whatsapp"
                                            required
                                        />
                                        @error('whatsapp')
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
                                            <option value="active" >{{ __('general.Active') }}</option>
                                            <option value="inactive" >{{ __('general.Inactive') }}</option>
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
@endsection
