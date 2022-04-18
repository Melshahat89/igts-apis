<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h4 class="footer-title"><a style="color: white" href="{{url('business')}}">{!! trans('website.Footer Meduo Business')!!}</a></h4>
               
                <p>
                        {{trans('website.Footer Meduo')}}
                </p>
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
                        <a href="{{url('events/category')}}">{{trans('events.events')}}</a>
                    </li>
                    <li>
                        <a href="{{url('partnership')}}">{{trans('partnership.partnership')}}</a>
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
        <div class="container">
            <p>Copyright © 2020 <span>Meduo</span>. All rights reserved.</p>
        </div>
    </div>
</footer>
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
    @include('website.theme.bootstrap.layout.popup.login');
</div>

<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModal" aria-hidden="true">
    @include('website.theme.bootstrap.layout.popup.register');
</div>


<div class="modal fade" id="searchmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header flexRight">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="m-search-modal">
                    
                    <form class="search-form-popup" id="global_search" action="{{ concatenateLangToUrl('courses/category') }}" method="get" enctype="multipart/form-data">
                    <div class="search-form-popup-wrapper">
                        <input type="text" placeholder="{{ trans('website.Search for the skills you want to learn') }}" name="key" class="apus-search form-control" autocomplete="off">
                        <button type="submit" class="btn-search-icon"><i class="flaticon-magnifying-glass"></i></button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>