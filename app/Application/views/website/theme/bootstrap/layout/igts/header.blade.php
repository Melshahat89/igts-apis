<header class="p-3">
    <div class="wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-light p-0">
            <a class="navbar-brand m-0" href="/"><img src="{{ asset('public/website') }}/images/logonew.png" loading="lazy" alt="" style="height: 50px;"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse pr-2 pl-2" id="navbarSupportedContent">
                <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="/">{{trans('home.home')}} <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{trans('home.specialities')}}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach(menuCategories() as $cat)
                            <a class="dropdown-item" href="/courses/category/{{$cat->slug}}">{{$cat->name_lang}}</a>
                        @endforeach
                    </div>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="https://igtsservice.com/blog">{{trans('home.blog')}} <span class="sr-only"></span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/events/category">{{trans('home.webinar')}} <span class="sr-only"></span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/page/accreditations">{{trans('home.accreditations')}} <span class="sr-only"></span></a>
                </li>
                </ul>
                <form class="pr-2 pl-2 search-bar" action="/allcourses/category" method="GET">
                    <div class="search-input">
                        <a href="" target="_blank" hidden></a>
                        <label for="key" class="search-bar-label mr-3 ml-3"><i class="fas fa-search"></i></label>
                        <input class="pr-5 pl-5 pt-4 pb-4" type="text" placeholder="" name='key' value="{{ isset($_GET['key']) ? $_GET['key'] : '' }}">
                        <div class="autocom-box" style="position: absolute;width: 100%;background: #fff;border-radius: 5px;box-shadow: 0px 1px 5px rgba(0,0,0,0.1);margin-top: 8px; font-size: 15px; z-index: 3;"></div>
                    </div>
                </form>
            </div>
            @if(Auth::check())
            <div class="pt-2">
                <div class="d-inline-block desktop-account-info-padding"><a href="{{LaravelLocalization::getLocalizedURL((config('app.locale') == 'en') ? 'ar':'en') }}" style="color: #244092;font-weight: bold;"><i class="fas fa-globe"></i> {{trans('website.other lang')}} </a></div>
                <a href="/cart"><div class="head_cart d-inline-block"><span class="floated_count">{{ count(getShoppingCart()) }}</span><a href="/cart" class="head_cart_icon"></a></div></a>
                <div class="d-inline-block desktop-account-info-padding">
                    <a class="nav-link dropdown-toggle" href="#" id="userMenuDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle" src="{{ large1(Auth::user()->image) }}" width="38">
                        <span class="avatar_name">{{ charlimit(Auth::user()->name, 10) }}</span>
                    </a>
                    <div class="nav-item dropdown d-block">
                        <div class="dropdown-menu" aria-labelledby="userMenuDropdown">
                            @if(Auth::user()->group_id == 1 || Auth::user()->group_id == 9 || Auth::user()->group_id == 10 || Auth::user()->group_id == 11 || Auth::user()->group_id == 12 || Auth::user()->group_id == 13 || Auth::user()->group_id == 14 || Auth::user()->group_id == 15 || Auth::user()->group_id == 16)
                                <a href="/lazyadmin" class="dropdown-item"><i class="fas fa-graduation-cap"></i> {{trans('home.UserType1')}}</a>
                            @endif

                            @if(Auth::user()->is_affiliate OR Auth::user()->group_id == 3)
                                <a href="/account/analysis" class="dropdown-item"><i class="fas fa-graduation-cap"></i> {{trans('home.analysis')}}</a>
                            @endif
                            <a href="/account/myCourses" class="dropdown-item"><i class="fas fa-graduation-cap"></i> {{trans('home.my courses')}}</a>
                            <a href="/account/myFavourites" class="dropdown-item"><i class="fas fa-heart"></i> {{trans('home.my favorites')}}</a>
                            <a href="/account/myCertificates" class="dropdown-item"><i class="fas fa-certificate"></i> {{trans('home.my certificates')}}</a>
                            <div class="divider"></div>
                            <a href="/account/edit" class="dropdown-item"><i class="fas fa-cog"></i> {{trans('home.account info')}}</a>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> {{trans('home.logout')}}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="pt-2 d-flex justify-content-between">
                <div class="button text_capitalize m-1"><a href="{{LaravelLocalization::getLocalizedURL((config('app.locale') == 'en') ? 'ar':'en') }}" style="color: #244092;font-weight: bold;"><i class="fas fa-globe"></i> {{trans('website.other lang')}} </a></div>
                <button type="button"  data-dismiss="modal" data-remote="/login" data-toggle="modal" data-target="#loginModal" class="button button_primary_reverse text_capitalize m-1">{{trans('home.signin')}}</button>
                <button type="button"  data-dismiss="modal" data-remote="/register" data-toggle="modal" data-target="#registerModal" class="button button_primary text_capitalize regButton m-1">{{trans('home.signup')}}</button>                                                                                                                                                       <!--onclick="return gtag_report_signup_conversion(false)"-->
            </div>
        @endif
        </nav>
        {{--
        @if(Auth::check())
            <div class="pt-4 mobie-account-info">
                <div class=""><a href="{{LaravelLocalization::getLocalizedURL((config('app.locale') == 'en') ? 'ar':'en') }}" style="color: #244092;font-weight: bold;"><i class="fas fa-globe"></i> {{trans('website.other lang')}} </a></div>
                <a href="/cart"><div class="head_cart"><span class="floated_count">{{ count(getShoppingCart()) }}</span><a href="/cart" class="head_cart_icon"></a></div></a>
                <div>
                    <a class="nav-link dropdown-toggle" href="#" id="userMobileMenuDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ large1(Auth::user()->image) }}" width="38">
                        <span class="avatar_name">{{ charlimit(Auth::user()->name, 10) }}</span>
                    </a>
                    <div class="nav-item dropdown d-block">
                        <div class="dropdown-menu" aria-labelledby="userMobileMenuDropdown">
                            @if(Auth::user()->group_id == 1 || Auth::user()->group_id == 9 || Auth::user()->group_id == 10 || Auth::user()->group_id == 11 || Auth::user()->group_id == 12 || Auth::user()->group_id == 13 || Auth::user()->group_id == 14 || Auth::user()->group_id == 15 || Auth::user()->group_id == 16)
                                <a href="/lazyadmin" class="dropdown-item"><i class="fas fa-graduation-cap"></i> {{trans('home.UserType1')}}</a>
                            @endif
                            @if(Auth::user()->is_affiliate OR Auth::user()->group_id == 3)
                                <a href="/account/analysis" class="dropdown-item"><i class="fas fa-graduation-cap"></i> {{trans('home.analysis')}}</a>
                            @endif
                            <a href="/account/myCourses" class="dropdown-item"><i class="fas fa-graduation-cap"></i> {{trans('home.my courses')}}</a>
                            <a href="/account/myFavourites" class="dropdown-item"><i class="fas fa-heart"></i> {{trans('home.my favorites')}}</a>
                            <a href="/account/myCertificates" class="dropdown-item"><i class="fas fa-certificate"></i> {{trans('home.my certificates')}}</a>
                            <div class="divider"></div>
                            <a href="/account/edit" class="dropdown-item"><i class="fas fa-cog"></i> {{trans('home.account info')}}</a>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> {{trans('home.logout')}}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="pt-4 mobie-account-info">
                <div class="button text_capitalize"><a href="{{LaravelLocalization::getLocalizedURL((config('app.locale') == 'en') ? 'ar':'en') }}" style="color: #244092;font-weight: bold;"><i class="fas fa-globe"></i> {{trans('website.other lang')}} </a></div>
                <button type="button"  data-dismiss="modal" data-remote="/login" data-toggle="modal" data-target="#loginModal" class="button button_primary_reverse text_capitalize">{{trans('home.signin')}}</button>
                <button type="button"  data-dismiss="modal" data-remote="/register" data-toggle="modal" data-target="#registerModal" class="button button_primary text_capitalize regButton">{{trans('home.signup')}}</button>                                                                                                                                                       <!--onclick="return gtag_report_signup_conversion(false)"-->
            </div>
        @endif
        --}}


    </div>
  </header>

{{-- @include('website.theme.bootstrap.layout.igts.shared.search-box-scripts') --}}