<header class="inner-page main-header">

    <div class="mobile-header show-mobile">
        <div class="container">
            <div class="flexBetween">
                <div class="m-logo">
                    <a href="{{url('/')}}"><img src="{{ asset('public/meduo') }}/images/mobile_logo.svg"  alt=""></a>
                </div>
                <div class="actions-m flexBetween">
                    <a href="{{LaravelLocalization::getLocalizedURL((config('app.locale') == 'en') ? 'ar':'en') }}"><i class="m-switcher"></i></a>
                    <a href="#"  data-toggle="modal" data-target="#searchmodal"><i class="flaticon-magnifying-glass"></i></a>
                    <div id="hideshow" class="hamburger hamburger--slider isDown">
                        <div class="hamburger-box">
                            <div class="hamburger-inner"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hidden-m-menu">
                <div class="slide-menu">
                    <div class="flexBetween actions-bar">

                        @if (Auth::check())
                            {{--  user tab --}}
                            <div class="dropdown user-tab">
                                @include(layoutUserTab('website'))
                            </div>
                            <div class="flexBetween">
                                {{--  cart --}}
                                <div class="dropdown mr-20">
                                    <a class="mini-cart" href="{{url('cart')}}" role="button" id="dropdownMenuLink">
                                        <i class="flaticon-shopping-bag"></i>
                                        <span class="count cart-count" id="mobile-cart-count"> {{ count(getShoppingCart()) }} </span>
                                    </a>
                                </div>
                                {{--  notification --}}
                                <div class="dropdown">
                                    @include(layoutNotificationTab('website'))

                                </div>
                            </div>
                        @else
                            <div class="login-signin">
                                <a href="#" data-toggle="modal" data-target="#loginmodal">
                                    <i class="flaticon-user"></i>
                                    <a href="#" data-dismiss="modal" data-remote="/login" data-toggle="modal" data-target="#loginModal">{{ trans('website.login') }}</a>
                                    <a href="#" data-dismiss="modal" data-remote="/register" data-toggle="modal" data-target="#registerModal"> / {{ trans('website.register') }}</a>
                                </a>
                            </div>
                        @endif
                    </div>

                </div>
                <div class="mobile-menu">
                    @include(layoutMegaMenu('website'))
                </div>
            </div>

        </div>
    </div>

    <div class="desc-header hide-mobile">

        <div class="container">
            <div class="top-header">
                <div class="row">
                    <div class="col-md-6">
                        <a class="switcher" href="{{LaravelLocalization::getLocalizedURL((config('app.locale') == 'en') ? 'ar':'en') }}">{{ trans('website.another lang') }} </a>
                        <a class="instructor-btn" href="{{ url('/joinAsInstructor') }}">
                            {{trans('website.Become an Instructor')}}
                        </a>
                        <a class="" style="margin: 10px;     font-weight: bold;" href="{{ url('/talks/category?key=covid19') }}">
                            {{ trans('website.COVID-19') }} 
                          </a>
                    </div>
                    <div class="col-md-6 flexRight actions-bar">

                        @if (Auth::check())
                            {{--  cart --}}
                            <div class="dropdown mr-20">
                                <a class=" mini-cart" href="{{url('cart')}}" role="button" id="dropdownMenuLink">
                                    <i class="flaticon-shopping-bag"></i>
                                    <span class="count cart-count" id="desktop-cart-count"> {{ count(getShoppingCart()) }} </span>
                                </a>
                            </div>
                            {{--  notification --}}
                            <div class="dropdown">
                                @include(layoutNotificationTab('website'))
                            </div>
                            {{--  user tab --}}
                            <div class="dropdown user-tab">
                                @include(layoutUserTab('website'))
                            </div>
                        @else
                            <div class="login-signin">
                                <a href="#" data-toggle="modal" data-target="#loginmodal" >
                                    <i class="flaticon-user"></i>
                                    <a href="#" data-dismiss="modal" data-remote="/login" data-toggle="modal" data-target="#loginModal">{{ trans('website.login') }}</a>
                                    <a href="#" data-dismiss="modal" data-remote="/register" data-toggle="modal" data-target="#registerModal"> / {{ trans('website.register') }}</a>

                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <nav class="navbar navbar-expand-lg w-100" id="menu">

                    <a class="navbar-brand" href="{{url('/')}}">
                        <img src="{{ asset('public/meduo') }}/images/logo.svg"  alt="">
                    </a>

                    <nav class="navbar navbar-light">
                        <form class="search-form-popup" action="{{ concatenateLangToUrl('courses/category') }}" method="get" enctype="multipart/form-data">
                            {{--  {{ csrf_field() }}  --}}
                            <div class="search-form-popup-wrapper">
                                <input type="text" placeholder="{{ trans('website.Search for the skills you want to learn') }}" name="key" class="apus-search form-control" autocomplete="off">
                                <button type="submit" class="btn-search-icon"><i class="flaticon-magnifying-glass"></i></button>
                            </div>
                        </form>
                    </nav>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        @include(layoutMegaMenu('website'))
                    </div>
                </nav>
            </div>
        </div>
    </div>

</header>