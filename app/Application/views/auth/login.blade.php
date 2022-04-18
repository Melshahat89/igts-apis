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
<div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-body">

            <ul class="modal_nav_tabs">
                <li class="active"><span style="color:black;">{{trans('home.signin')}}</span></li>
                <li><a style="color:black;" href="/register" data-dismiss="modal" data-toggle="ajaxModal">{{trans('home.signup')}}</a></li>
            </ul>


            <div class="ptmd pbxs plmd prmd bg_white rounded_6">
               <div class="text_center ptmd pbmd bb">
                    <h5>{{trans('home.signin with')}}</h5>
                    <div class="socials">
                        <div class="socials">
                            <a href="{{url('social/redirect/facebook')}}" class="social_link social_facebook"><i class="fab fa-facebook-f"></i></a>
                            <div>
                                <a href="{{url('social/redirect/twitter')}}" class="social_link social_twitter"><i class="fab fa-twitter"></i></a>
                            </div>
                            <a href="{{url('social/redirect/google')}}" class="social_link social_google"><i class="fab fa-google-plus-g"></i></a>
<!--                            <a href="/site/oauth/provider/LinkedIn" class="social_link social_linkedin"><i class="fab fa-linkedin-in"></i></a>-->
                        </div>
                    </div>
                </div>
                
                <form class="" style="display: block;margin-right: auto; margin-left: auto;" role="form" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}


                    <!-- Email -->
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

                    <!-- Password -->
                    <div class="form_row">
                        <div class="input_with_icon">
                            <i class="fas fa-lock"></i>
                            <input id="password" type="password" autocomplete="" class="form-control input-item password-login-ico" name="password" value="{{ old('password') }}" class = 'form-control input-item user-login-ico' label = 'Username' placeholder = '{{trans('account.password')}}' required autofocus>
                            
                        </div>
                    </div>
                    @if ($errors->has('password'))
                                <div class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </div>
                            @endif

                            <div class="text-center">

                            <div class="form_row form_submit">
                                <button type="submit" class="signin_btn button button_block button_primary"><span>تسجيل الدخول</span></button>
                            </div>
                            <p class="pt-20">{{trans('website.Forgot your')}} <a href="{{url('/password/reset')}}" class="forget-pass">{{trans('website.password?')}}</a></p>
                            </div>          
                </form>
                

                

                    

                <a onclick="return gtag_report_whatsapp_conversion('https://igtsservice.com/contactus/index.php');" href="https://igtsservice.com/contactus/index.php" class="social_link contact_whatsapp" style="background-color: #4AC959;">
                    <div class="text_center ptmd pbmd bb contact_whatsapp" >
                    <h6 class="contact_whatsapp">{{trans('home.contact us on whatsapp')}}</h6>
                        <div class="socials contact_whatsapp" style="display: flex;">
                            <i style="font-size: 25px;" class="fab fa-whatsapp contact_whatsapp"></i>
                        </div>
                    </div>
                </a>


            </div>

        </div>
    </div>
</div>
@endsection
