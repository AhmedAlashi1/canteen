
@extends('dashboard.layouts.master')
@section('title', __('general.Add Question') )
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
                        <h4 class="card-title">{{__('general.Add Question')}}</h4>
                    </div>
                    <div class="card-body">
                        <form class="form" action="{{ route('question.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="question">{{__('general.Question in english')}}</label>
                                        <div class="form-label-group mb-0">
                                            <textarea
                                                name="question"
                                                data-length="1000"
                                                class="form-control char-textarea @error('question') is-invalid @else {{ old('question') ? 'is-valid' : '' }} @enderror"
                                                id="textarea-counter"
                                                rows="3"
                                                required
                                                placeholder="Do you offer website maintenance services?">{{ old('question') }}</textarea>
                                        </div>
                                        @error('question')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="question_ar">{{__('general.Question in arabic')}}</label>
                                        <div class="form-label-group mb-0">
                                            <textarea
                                                name="question_ar"
                                                data-length="1000"
                                                class="form-control char-textarea @error('question_ar') is-invalid @else {{ old('question_ar') ? 'is-valid' : '' }} @enderror"
                                                id="textarea-counter"
                                                rows="3"
                                                required
                                                placeholder="{{__('general.Do you offer website maintenance services?')}}">{{ old('question_ar') }}</textarea>
                                        </div>
                                        @error('question_ar')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="answer">{{__('general.Answer in english')}}</label>
                                        <div class="form-label-group mb-0">
                                            <textarea
                                                name="answer"
                                                data-length="1000"
                                                class="form-control char-textarea form-control-sm @error('answer') is-invalid @else {{ old('answer') ? 'is-valid' : '' }} @enderror"
                                                id="textarea-counter"
                                                rows="3"
                                                required
                                                placeholder="absolutely! I have experience workin...">{{ old('answer') }}</textarea>
                                        </div>
                                        @error('answer')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="answer_ar">{{__('general.Answer in arabic')}}</label>
                                        <div class="form-label-group mb-0">
                                            <textarea
                                                name="answer_ar"
                                                data-length="1000"
                                                class="form-control char-textarea form-control-sm @error('answer_ar') is-invalid @else {{ old('answer_ar') ? 'is-valid' : '' }} @enderror"
                                                id="textarea-counter"
                                                rows="3"
                                                required
                                                placeholder="absolutely! I have experience workin...">{{ old('answer_ar') }}</textarea>
                                        </div>
                                        @error('answer')
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


@stop
