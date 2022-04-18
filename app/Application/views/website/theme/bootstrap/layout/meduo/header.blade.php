@push('css')
<style>
    .slider {
        width: 40rem;
    }
    
    .slide > img{
        
        
            display: block;
            width: 100%;
            height: 200px;
            object-fit: cover;
        
        
    }
    
    
    .slick-dots {
        display: flex;
        justify-content: center;
        
        margin: 0;
        padding: 1rem 0;
        
        list-style-type: none;
        
        
    }
    
    .slick-dots > li {
         
                margin: 0 0.25rem;
            
    }
    
    .slick-dots > button {
                display: block;
                width: 1rem;
                height: 1rem;
                padding: 0;
                
                border: none;
                border-radius: 100%;
                background-color: blue;
                
                text-indent: -9999px;
    }
    </style>
@endpush
<header class="home main-header">
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
                                        <span class="count cart-count"> {{ count(getShoppingCart()) }} </span>
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

    <div class="container">
        <div class="top-header hide-mobile">
            <div class="row">
                <div class="col-md-6">
                    <a class="switcher" href="{{LaravelLocalization::getLocalizedURL((config('app.locale') == 'en') ? 'ar':'en') }}">{{trans('website.other lang')}} </a>
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
                                <span class="count cart-count"> {{ count(getShoppingCart()) }} </span>
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

        <div class="row hide-mobile">
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

        <div class="hero-section flexCenter mt-40">
            <div class="container">
                <div class="hero-content text-center">
                    {{-- <h1>{{ trans('website.home h1') }}</h1>
                    <p>
                        {!! trans('website.home p') !!}
                    </p>
                    <a href="#" class="custom-btn mt-20" >
                        {!! trans('website.home p2') !!}
                    </a> --}}
                </div>


                <div class="slider" style="width: 100% !important;">
                    @foreach(sliders() as $key => $slider)
                        <div class="slide">
                            {{-- //Desc --}}
                            <img style="height: 370px;width: 1100px;" class="hide-mobile" src="{{large1((getDir() == 'rtl')?$slider->image_d_ar: $slider->image_d_en )}}" />
                            {{-- //Mob --}}
                            <img style="" class="show-mobile m-hero-cat" src="{{large1((getDir() == 'rtl')?$slider->image_m_ar: $slider->image_m_en )}}" />
                        </div>
                    @endforeach
                </div> 

                <div class="cat-container hide-mobile flexCenter">
                    @foreach(menuCategories() as $cat)
                        <a href="{{url('/courses/category?category='.$cat->slug)}}" class="hvr-float" >
                            <i class="hero-icons {{$cat->class}}" ></i>
                            <span>
                              @foreach(explode(" ",$cat->name_lang) as $row)
                                    @if ($loop->last &&  $loop->count > 1  ) <br> @endif
                                    {{ $row }}
                                @endforeach
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</header>

@push('js')
<script>

    $(document).ready(function(){
        $('.slider').slick({
      infinite: true,
        dots: true,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 3000,
        fade: true,
        fadeSpeed: 1000
    });
    });
    
    
    </script>
    
@endpush