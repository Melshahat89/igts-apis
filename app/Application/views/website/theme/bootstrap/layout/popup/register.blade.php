@php
use App\Application\Model\Categories;

$userObject = Session::get('socialUserRegister');
@endphp

<button type="button" class="close_modal" data-dismiss="modal" aria-label="Close"></button>

<div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-body">

            <ul class="modal_nav_tabs">
                <li><a style="color:black;" href="/login" data-dismiss="modal" data-remote="/login" data-toggle="modal" data-target="#loginModal">{{trans('home.signin')}}</a></li>
                <li class="active"><span style="color:black;">{{trans('home.signup')}}</span></li>
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
                
                <form class="" style="display: block;margin-right: auto; margin-left: auto;" id="register_form" role="form" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                
                <div class="d-flex">
                <!-- Name -->
                <div class="form_row w-50">
                        <div class="input_with_icon">
                            <i class="far fa-user"></i>
                            <input id="name" type="text" class="form-control input-item user-login-ico" name="name" value="{{ isset($userObject->name) ? $userObject->name : old('name') }}" class = 'form-control input-item user-login-ico' label = 'Username' placeholder = '{{trans('account.Full Name')}}' required >
                            
                        </div>
                    </div>
                    @if ($errors->has('name'))
                                <div class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </div>
                            @endif

                        <!-- Phone -->
                    <div class="form_row w-50">
                    <div class="input_with_icon">
                        <i class="fa fa-mobile"></i>
                            <input id="mobile" type="number" class="form-control input-item mobile-login-ico" name="mobile" value="{{ old('mobile') }}" class = 'form-control input-item user-login-ico' label = 'Username' placeholder = '{{trans('account.mobile')}}' required >
                            
                        </div>
                    </div>
                    @if ($errors->has('mobile'))
                                <div class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </div>
                            @endif
                </div>
                    <!-- Email -->
                    <div class="form_row">
                        <div class="input_with_icon">
                            <i class="far fa-envelope"></i>
                            <input id="email-register" type="email" class="form-control input-item email-login-ico" {{ isset($userObject->email) ? 'readonly' : '' }} name="email" value="{{ isset($userObject->email) ? $userObject->email : old('email') }}" class = 'form-control input-item user-login-ico' label = 'Username' placeholder = '{{trans('account.email')}}' required >
                            
                        </div>
                    </div>
                    @if ($errors->has('email'))
                                <div class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </div>
                            @endif

                            
                    <div class="input-group">
                        <select class="form-control input-item user-login-ico" id="categories" name="categories" required="required">
                            <option value="">{{trans('account.Select specialization')}}</option>
                            @foreach(categoriesList() as $key => $category)
                            <option value="{{$key}}" {{ (isset($item->categories) && $item->categories == $key) ? 'selected' : '' }}> {{$category}} </option>
                        @endforeach
                        </select>

                        @if ($errors->has('categories'))
                            <div class="help-block">
                                    <strong>{{ $errors->first('categories') }}</strong>
                            </div>
                        @endif
                    </div>



                    <div class="d-flex">
                    <!-- Password -->
                    <div class="form_row w-50">
                        <div class="input_with_icon">
                            <i class="fas fa-lock"></i>
                            <input id="password-register" autocomplete="" type="password" class="form-control input-item password-login-ico" name="password" value="{{ old('password') }}" class = 'form-control input-item user-login-ico' label = 'Username' placeholder = '{{trans('account.password')}}' required >
                            
                        </div>
                    </div>
                    @if ($errors->has('password'))
                                <div class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </div>
                            @endif


                    <!-- Repeat Password -->
                    <div class="form_row w-50">
                        <div class="input_with_icon">
                           <i class="fas fa-lock"></i>
                            <input id="password_confirmation" autocomplete="" type="password" class="form-control input-item password-login-ico" name="password_confirmation" value="{{ old('password_confirmation') }}" class = 'form-control input-item user-login-ico' label = 'Username' placeholder = '{{trans('account.password_confirmation')}}' required >
                            
                        </div>
                    </div>
                    @if ($errors->has('password_confirmation'))
                                <div class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </div>
                            @endif
                </div>

                    <p class="pb-4 pt-4 text-center">{{trans('account.By completing your registeration, you agree to IGTS')}} <a href="{{url('/page/termsOfUse')}}">{{trans('account.Terms and Conditions')}}</a> {{trans('account.and')}} <a href="{{url('/page/privacyPolicy')}}">{{trans('account.Privacy Policy')}}</a></p>

                    <input type="hidden" name="facebook_identifier" id="facebook_identifier" value="{{ isset($userObject->facebook_identifier) ? $userObject->facebook_identifier : '' }}">
                    <input type="hidden" name="provider" id="provider" value="{{ isset($userObject->provider) ? $userObject->provider : '' }}">
                    <input type="hidden" name="token" id="token" value="{{ isset($userObject->token) ? $userObject->token : '' }}">
                    <input type="hidden" name="image" id="image" value="{{ isset($userObject->image) ? $userObject->image : '' }}">

                    @if(config('services.recaptcha.key'))
                        <div class="g-recaptcha"
                            data-sitekey="{{config('services.recaptcha.key')}}"
                            data-callback='submitRegisterForm'
                            data-bind="signup_btn_submit"
                            >
                        </div>
                    @endif
                    @if ($errors->has('g-recaptcha-response'))
                        <div class="alert alert-danger">
                            <span class='help-block'>
                                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                            </span>
                        </div>
                    @endif

                    <div class="form_row form_submit">
                        <button type="submit" class="signup_btn button button_block button_primary" id="signup_btn_submit"><span>إنشاء حساب</span></button>
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