@extends(layoutExtend('website'))
@section('title')
    {{  trans('home.HomeTitle') }}
@endsection
@section('description')
    {{ trans('website.Footer IGTS') }}
@endsection
@section('keywords')
    
@endsection
@section('content')

<div class="bread-crumb">
    <div class="wrapper">
        <a href="/">{{ trans('website.home') }}</a> >
        <span> {{ trans('website.Reset Password') }}</span>
    </div>
</div>

@include('website.theme.bootstrap.layout.igts.shared.innerPagesHead', ['title' => trans('website.Reset Password')]) 

<div class="modal-dialog" role="document" style="max-width: 50%;">
    <div class="modal-content">
        <div class="modal-header flexRight">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body p-0 sign-tabs">
            <ul class="nav nav-pills flexCenter" id="pills-tab" role="tablist">
                
              
            </ul>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="tab-content" id="pills-tabContent">
                      

                            <form class="login-form form-vertical" role="form" method="POST" action="{{ route('password.request') }}">
                                {{ csrf_field() }}

                                <input type="hidden" name="token" value="{{ $token }}">

                        <div class="input-group {{ $errors->has('email') ? ' has-error' : '' }} mt-4">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control input-item email-login-ico" name="email" value="{{ $email or old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="input-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control input-item password-login-ico" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="input-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control input-item password-login-ico" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                        
                            <div class="text-center m-4">
                                <button type="submit" class="add-to-cart sign-in">
                                    {{ trans('website.Reset Password') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        
</div>
</div>

@endsection
