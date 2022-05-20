@php
use Illuminate\Support\Facades\Session as Session;

    $VERSION_NUMBER = 9.3;
@endphp
<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" dir="{{ getDir() }}">
<head>
<script>
    let date = new Date().getTime() / 1000;
    let event_id = date;
</script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="author" content="IGTS">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title') </title>
    
    <!-- Bootstrap core CSS ARABIC -->

        <!-- <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('public/website') }}/images/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('public/website') }}/images/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('public/website') }}/images/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('public/website') }}/images/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('public/website') }}/images/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('public/website') }}/images/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('public/website') }}/images/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('public/website') }}/images/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('public/website') }}/images/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('public/website') }}/images/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('public/website') }}/images/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('public/website') }}/images/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/website') }}/images/favicon-16x16.png"> -->

        <link rel="icon" type="image/x-icon" href="{{ asset('public/website') }}/images/favicon.png">



        <link rel="preload" href="{{ asset('public/website') }}/css/bootstrap.min.css?v={{$VERSION_NUMBER}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript><link rel="stylesheet" href="{{ asset('public/website') }}/css/bootstrap.min.css?v={{$VERSION_NUMBER}}"></noscript>
                
        <link rel="preload" href="{{ asset('public/website') }}/css/front/style.css?v={{$VERSION_NUMBER}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript><link rel="stylesheet" href="{{ asset('public/website') }}/css/front/style.css?v={{$VERSION_NUMBER}}"></noscript>

        <link href="{{ asset('public/website') }}/css/front/owl.theme.default.min.css?v={{$VERSION_NUMBER}}" rel="stylesheet">
        <link href="{{ asset('public/website') }}/css/front/owl.carousel.css?v={{$VERSION_NUMBER}}" rel="stylesheet">

        <link rel="preload" href="{{ asset('public/website') }}/css/front/responsive.css?v={{$VERSION_NUMBER}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript><link rel="stylesheet" href="{{ asset('public/website') }}/css/front/responsive.css?v={{$VERSION_NUMBER}}"></noscript>
        
        <link rel="preload" href="{{ asset('public/website') }}/css/front/flaticon.css?v={{$VERSION_NUMBER}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript><link rel="stylesheet" href="{{ asset('public/website') }}/css/front/flaticon.css?v={{$VERSION_NUMBER}}"></noscript>
        
        @if(getDir() == "rtl")
        <!-- <link rel="preload" href="{{ asset('public/website') }}/css/front/custom-rtl.css?v={{$VERSION_NUMBER}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript><link rel="stylesheet" href="{{ asset('public/website') }}/css/front/custom-rtl.css?v={{$VERSION_NUMBER}}"></noscript> -->
        <link rel="stylesheet" href="{{ asset('public/website') }}/css/front/custom-rtl.css?v={{$VERSION_NUMBER}}">
        @else
        <!-- <link rel="preload" href="{{ asset('public/website') }}/css/front/custom.css?v={{$VERSION_NUMBER}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript><link rel="stylesheet" href="{{ asset('public/website') }}/css/front/custom.css?v={{$VERSION_NUMBER}}"></noscript> -->
        <link rel="stylesheet" href="{{ asset('public/website') }}/css/front/custom.css?v={{$VERSION_NUMBER}}">
        @endif
        

        {{ Html::style('public/css/sweetalert.css') }}

</head>

@if(getDir() == 'rtl')
    <body class="text-right" id="p_wrapper">
    <div id="smartbar-ar" class="smart_bar">
    </div>    
@else
    <body class="text-left" id="p_wrapper">
    <div id="smartbar-en" class="smart_bar">                 
    </div>
@endif

<!-- <div class="se-pre-con"></div> -->
<div class="loading flexCenter">
      <div class="loader-logo">
        <div class="loader">Loading...</div>
        <img src="{{ asset('public/website') }}/images/logonew.png" alt="..." >
      </div>
    </div>


@include(layoutIgtsHeader('website'))


@include(layoutContent('website'))


<a href="https://igtsservice.com/contactus" target="_blank" class="float">
    <i class="fab fa-whatsapp my-float" aria-hidden="true"></i>
</a>

<input type='hidden' id='user_id' value='{{(auth()->check())?Auth::user()->id:''}}'>
<input type='hidden' id='path' value='{{ url('/') }}'>

@include(layoutFooter('website'))

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="lectureModal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body" id="modalBody">
                ...
            </div>

        </div>
    </div>
</div>



</body>
</html>

<!-- START JAVASCRIPT FILES LOADING -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="{{ asset('public/website') }}/js/bootstrap.min.js?v={{$VERSION_NUMBER}}"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js" async defer></script>
<script type="text/javascript" src="{{ asset('public/website') }}/js/app.min.js?v={{$VERSION_NUMBER}}"></script>
<script type="text/javascript" src="{{ asset('public/website') }}/js/owl.carousel.min.js?v={{$VERSION_NUMBER}}"></script>
@if(getDir() == "rtl")
<script type="text/javascript" src="{{ asset('public/website') }}/js/custom.owl-rtl.js?v={{$VERSION_NUMBER}}"></script>
@else
<script type="text/javascript" src="{{ asset('public/website') }}/js/custom.owl.js?v={{$VERSION_NUMBER}}"></script>
@endif
<!--Start of HubSpot Embed Code -->
<script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/4880007.js"></script>
<!--End of HubSpot Embed Code -->
<script src="{{ asset('public/website') }}/js/custom.js?v={{$VERSION_NUMBER}}"></script>
{{ Html::script('public/js/sweetalert.min.js') }}
@include('sweet::alert')

<script>
    (function (e, t, n) {
        var r = e.querySelectorAll("html")[0];
        r.className = r.className.replace(/(^|\s)no-js(\s|$)/, "$1js$2")
    })(document, window, 0);
</script>

@if(Session::get('socialUserRegister'))
<script>$('#registerModal').modal('show');</script>
@php Session::pull('socialUserRegister') @endphp
@endif