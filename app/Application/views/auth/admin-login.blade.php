@extends(layoutExtend('website'))
@section('title')
{{ trans('home.MeduoHomeTitle') }} 
@endsection
@section('description')
    {{ trans('home.MeduoHomeDescription') }}
@endsection
@section('keywords')
    {{ trans('home.MeduoHomeKeywords') }}
@endsection
@section('content')
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header flexRight">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0 sign-tabs">
                <ul class="nav nav-pills flexCenter" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#"> Admin</a>
                    </li>
                    
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="popup-signin" role="tabpanel">
                           
                        <div class="content-container">
                            <p class="seprt"><i>{{trans('website.Or')}}</i></p>

                            <form class="login-form form-vertical col-md-10" style="display: block;margin-right: auto; margin-left: auto;" role="form" method="POST" action="{{ concatenateLangToUrl('lazyadmin/login') }}">
                                {{ csrf_field() }}

                                <div class="input-group">

                                    <input id="email" type="email" class="form-control input-item email-login-ico" name="email" value="{{ old('email') }}" class = 'form-control input-item user-login-ico' label = 'Username' placeholder = '{{trans('account.email')}}' required autofocus>
                                    
                                </div>
                                @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                <div class="input-group">
                                    <input id="password" type="password" class="form-control input-item password-login-ico"  name="password" placeholder = '{{trans('account.password')}}' aria-label = "Password" value="" required autofocus>
                                    
                                </div>
                                @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif

                                <div class="text-center">
                                    <button type="submit" class="add-to-cart sign-in">
                                        {{trans('website.Sign in')}}
                                    </button>
                                </div>
                            </form>


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
