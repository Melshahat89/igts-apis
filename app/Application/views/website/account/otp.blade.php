@extends(layoutExtend('website'))
@section('title')
{{ trans('account.otp') }}
@endsection
@section('description')
    {{ trans('home.MeduoHomeDescription') }}
@endsection
@section('keywords')
    {{ trans('home.MeduoHomeKeywords') }}
@endsection
@section('content')
@section('content')


    <div class="page-title general-gred">
        <div class="container">
            <h1>{{ trans('account.otp') }}</h1>

            <p class="mt-15">
                Please, check your email to be able to continue surfing the website.
                <br>
            </p>
        </div>
    </div>

    <section class="interest">
        <div class="container">

            <form id="users-form" class="validate_form mtlg"
                action="{{ concatenateLangToUrl('account/otp') }}"
                method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="col-md-12 mb-4">
                    <input id="otp" type="text" value=""
                        class="form-control input-item user-login-ico" name="otp"
                        placeholder='* {{ trans('account.otp') }}' aria-label="Username" value="{{ old('otp') }}"
                        required autofocus>
                </div>
                 <p class="mt-15">
                    <a href="{{url('account/sendOtp')}}">Send Otp</a>
                <br>
                 </p>
                
                </div>
            </form>
        </div>
    </section>

@endsection
