@extends(layoutExtend('website'))
@section('title')
{{ trans('partnership.Partnership Registration') }} | {{ trans('partnership.partnership') }}
@endsection
@section('description')
    {{ trans('home.MeduoHomeDescription') }}
@endsection
@section('keywords')
    {{ trans('home.MeduoHomeKeywords') }}
@endsection
@push('css')
    <style>
        .tab-content>.active {
            display: inline;
        }

        .settings-container .input-item {
            padding-left: 35px;
        }

        .nav-link {
            color: #244092;
        }

    </style>
@endpush
@section('content')
    <div class="bread-crumb">
        <div class="container">
            <a href="#">{{ trans('website.home') }}</a> > <span>{{ trans('partnership.Partnership Registration') }}</span>
        </div>
    </div>

    <div class="page-title general-gred">
        <div class="container">
            <h1 class="mt-20 mb-20">{{ trans('partnership.Partnership Registration') }}</h1>
        </div>
    </div>

    <section class="settings-container">
        <div class="contianer">
            <div class="cntrls_btns">
                <a class="active cntrl-btn"
                    href="{{ url('partnership/register-individual') }}">{{ trans('partnership.Individual') }}</a>
                <a class="cntrl-btn"
                    href="{{ url('partnership/register-institution') }}">{{ trans('partnership.Institution') }}</a>
            </div>
            <div class="partnership_form">
                <form class="login-form form-vertical" role="form" method="POST"
                    action="{{ concatenateLangToUrl('partnership/register-individual') }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-20">
                                {{--  {!! extractFiled(isset($item) ? $item : null, 'first_name', old('first_name'), 'text',
                                'user', 'form-control input-item') !!}  --}}
                                <input type="text" name="first_name" required class="form-control input-item" placeholder="{{ trans('user.first_name') }}">

                            </div>
                            @if ($errors->has('first_name.en'))
                                    <div class="alert alert-danger">
                                        <span class='help-block'>
                                            <strong>{{ $errors->first('first_name.en') }}</strong>
                                        </span>
                                    </div>
                                @endif
                                @if ($errors->has('first_name.ar'))
                                    <div class="alert alert-danger">
                                        <span class='help-block'>
                                            <strong>{{ $errors->first('first_name.ar') }}</strong>
                                        </span>
                                    </div>
                                @endif
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-20">
                                {{--  {!! extractFiled(isset($item) ? $item : null, 'last_name', old('last_name'), 'text', 'user',
                                'form-control input-item') !!}  --}}
                               
                                <input type="text" name="last_name" required class="form-control input-item" placeholder="{{ trans('user.last_name') }}">


                            </div>
                            @if ($errors->has('last_name.en'))
                            <div class="alert alert-danger">
                                <span class='help-block'>
                                    <strong>{{ $errors->first('last_name.en') }}</strong>
                                </span>
                            </div>
                        @endif
                        @if ($errors->has('last_name.ar'))
                            <div class="alert alert-danger">
                                <span class='help-block'>
                                    <strong>{{ $errors->first('last_name.ar') }}</strong>
                                </span>
                            </div>
                        @endif
                        </div>

                        <div class="col-md-12">
                            <div class="input-group mb-20">
                                <input type="email" name="email" required class="form-control input-item" placeholder="{{ trans('account.email') }}">
                                
                            </div>
                            @if ($errors->has('email'))
                                    <div class="alert alert-danger">
                                        <span class='help-block'>
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    </div>
                                @endif
                        </div>

                        <div class="col-md-12">
                            <div class="input-group mb-20">
                                <input type="text" name="mobile" required class="form-control input-item" placeholder="{{ trans('user.mobile') }}">
                                
                            </div>
                            @if ($errors->has('mobile'))
                                    <div class="alert alert-danger">
                                        <span class='help-block'>
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                                    </div>
                                @endif
                        </div>

                        <div class="col-md-6">
                            <div class="input-group mb-20">
                                <input type="password" required name="password" class="form-control input-item"
                                    placeholder="{{ trans('account.password') }}">
                                
                            </div>
                            @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="col-md-6">
                            <div class="input-group mb-20">
                                <input id="password-confirm" type="password" class="form-control input-item"
                                    name="password_confirmation" placeholder='{{ trans('account.password_confirmation') }}'
                                    required>
                                
                            </div>
                            @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="col-md-12">
                            <div class="input-group mb-20">
                                <textarea class="form-control input-item" name="about" required rows="6"
                                    placeholder="About You"></textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="text-center">

                                <button class="submit_crtl">
                                    {{ trans('website.Submit') }}
                                </button>

                            </div>
                        </div>


                    </div>
                </form>

            </div>
        </div>
    </section>

@endsection
