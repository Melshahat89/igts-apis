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
            <div class="form_row">
                    <p>{{trans('website.Please enter the email')}}</p>
            </div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="tab-content" id="pills-tabContent">
                        <form class="login-form form-vertical" role="form" method="POST" action="{{ route('password.email') }}">
                            {{ csrf_field() }}

                            <div class="form_row">
                        <div class="input_with_icon">
                            <i class="far fa-envelope"></i>
                            <input id="email" type="email" class="form-control input-item email-login-ico" name="email" value="{{ old('email') }}" class = 'form-control input-item user-login-ico' label = 'Username' placeholder = '{{trans('account.email')}}' required autofocus>
                            
                        </div>
                    </div>
                    @if ($errors->has('email'))
                                <div class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </div>
                            @endif
                        
                            <div class="text-center m-4">
                                <button type="submit" class="add-to-cart sign-in">
                                    {{trans('website.Send Password Reset Link')}}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        
</div>
</div>
@endsection
