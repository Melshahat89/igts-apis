<div class="main-footer">
<footer>
    <div class="wrapper">
        <div class="row">
            <div class="col-md-4">
                <h4 class="footer-title"><a style="color: white" href="{{url('business')}}">{!! trans('website.Mobile App')!!}</a></h4>
               
                <p>
                        {{trans('website.Our mobile application is coming soon')}}
                </p>
                <img src="{{ asset('public/website') }}/images/front/play-store.svg">
                <img src="{{ asset('public/website') }}/images/front/app-store.svg">
            </div>
            <div class="col-md-4">
                <h4 class="footer-title">{!! trans('website.Quick Links')!!}</h4>
                <ul>
                    <li>
                        <a href="{{url('page/about')}}">{{trans('website.About Us')}}</a>
                    </li>
                    <li>
                        <a href="{{url('page/termsOfUse')}}">{{trans('website.Terms and Conditions')}}</a>
                    </li>
                    <li>
                        <a href="{{url('page/privacyPolicy')}}">{{trans('website.Privacy Policy')}}</a>
                    </li>
                    <li>
                        <a href="{{url('contact')}}">{{trans('website.Contact')}}</a>
                    </li>
                    <li>
                        <a href="{{url('careers')}}">{{trans('careers.careers')}}</a>
                    </li>
                    <li>
                        <a href="{{url('verifycertificate')}}">{{trans('page.Certificate Verification')}}</a>
                    </li>
                    <li>
                        <a href="{{url('page/accreditations')}}">{{trans('page.Accreditations')}}</a>
                    </li>
                    <li>
                        <a href="{{url('business')}}">{{trans('home.IGTS For Business')}}</a>
                    </li>
                </ul>
            </div>

            <div class="col-md-4">
                <h4 class="footer-title">{!! trans('website.Keep Connected')!!}</h4>

                <span>{!! trans('website.Follow Us')!!}</span>
                <div class="social flexCenter">
                    <a href="{{ getSetting('facebook') }}" target="_blank"><i class="facebook"  ></i></a>
                    <a href="{{ getSetting('twitter') }}" target="_blank"><i class="twitter"  ></i></a>
                    <a href="{{ getSetting('linkedin') }}" target="_blank"><i class="linkedin"  ></i></a>
                    <a href="{{ getSetting('instagram') }}" target="_blank"><i class="instagram"  ></i></a>
                    <a href="{{ getSetting('youtube') }}" target="_blank"><i class="youtube"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="copywrite">
        <div class="wrapper" style="text-align: -webkit-center;">
            <div class="paymentmethods">
                <img src="{{ asset('public/website') }}/images/front/visalogo.svg">
                <img src="{{ asset('public/website') }}/images/front/mastercardlogo.svg">
                <img src="{{ asset('public/website') }}/images/front/paypallogo.svg">
                <img src="{{ asset('public/website') }}/images/front/voda-cash.png">
            </div>
            <p>{{trans('business.Copyright')}} © {{currentYear()}} <span>IGTS</span>. {{trans('business.All rights reserved.')}}</p>
        </div>
    </div>
</footer>
</div>

@if(!Auth::check())
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
    @include('website.theme.bootstrap.layout.popup.login');
</div>

<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModal" aria-hidden="true">
    @include('website.theme.bootstrap.layout.popup.register');
</div>
@endif