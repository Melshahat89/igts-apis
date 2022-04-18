<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="author" content="Meduo">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('public/meduo') }}/fav/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('public/meduo') }}/fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/meduo') }}/fav/favicon-16x16.png">
    <link rel="manifest" href="{{ asset('public/meduo') }}/fav/site.webmanifest">
    <link rel="mask-icon" href="{{ asset('public/meduo') }}/fav/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">


    <meta property="og:image" content="https://meduo.net/newassets/images/defaultthumbnail.jpg">
    <meta property="og:image:type" content="image/jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="1200">


    <title> @yield('title') </title>


@if(getDir() == 'rtl')
    <!-- Bootstrap core CSS -->
        <link href="{{ asset('public/meduo') }}/css/bootstrap-rtl.min.css" rel="stylesheet">
        <link href="{{ asset('public/meduo') }}/css/main-rtl.css" rel="stylesheet">
        <link href="{{ asset('public/meduo') }}/css/custom-rtl.css" rel="stylesheet">
        <link href="{{ asset('public/meduo') }}/css/responsive-rtl.css" rel="stylesheet">
@else
    <!-- Bootstrap core CSS -->
        <link href="{{ asset('public/meduo') }}/css/bootstrap.min.css" rel="stylesheet">

        <link href="{{ asset('public/meduo') }}/css/main.css" rel="stylesheet">
        <link href="{{ asset('public/meduo') }}/css/custom.css" rel="stylesheet">
        <link href="{{ asset('public/meduo') }}/css/responsive.css" rel="stylesheet">

@endif
@if (Request::path() != 'en' or Request::path() != 'ar')
    @if(getDir() == 'rtl')
        <!-- Bootstrap core CSS -->
            <link href="{{ asset('public/meduo') }}/css/inner-rtl.css" rel="stylesheet">
    @else
        <!-- Bootstrap core CSS -->
            <link href="{{ asset('public/meduo') }}/css/inner.css" rel="stylesheet">

    @endif
@endif


<!-- Flaticon Font -->
    <link href="{{ asset('public/meduo') }}/css/flaticon.css" rel="stylesheet">


    <!-- Hover -->
    <link href="{{ asset('public/meduo') }}/css/hover-min.css" rel="stylesheet">
    <link href="{{ asset('public/meduo') }}/css/owl.carousel.css" rel="stylesheet">

    <!-- Hamburgers Menu -->
    <link href="{{ asset('public/meduo') }}/css/hamburgers.css" rel="stylesheet">
    {{ Html::style('public/css/sweetalert.css') }}
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>



@stack('css')

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Tajawal:300,400,700&display=swap" rel="stylesheet">
</head>

<body role="document">

<div class="loading flexCenter">
    <div class="loader-logo">
        <div class="loader">Loading...</div>
        <img src="{{ asset('public/meduo') }}/images/logo.svg" alt="Meduo" >
    </div>
</div>

@if (Request::path() == 'en' or Request::path() == 'ar')
    @include(layoutMeduoHeader('website'))
@else
    @if(Route::getCurrentRoute()->getActionMethod() != 'lecture')
        @include(layoutMeduoHeaderInner('website'))
    @endif
@endif

{{--@include(layoutMeduoHeader('website'));--}}

@include(layoutContent('website'))
<input type='hidden' id='user_id' value='1'>
<input type='hidden' id='path' value=''>
@include(layoutFooter('website'))





{!! Links::track(true) !!}
{{ Html::script('public/js/sweetalert.min.js') }}
<!-- Bootstrap core JavaScript  -->

<script src="{{ asset('public/meduo') }}/js/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="{{ asset('public/meduo') }}/js/bootstrap.min.js"></script>
<script src="{{ asset('public/meduo') }}/js/owl.carousel.min.js"></script>
@if(getDir() == 'rtl')
    <script src="{{ asset('public/meduo') }}/js/script-rtl.js"></script>
@else
    <script src="{{ asset('public/meduo') }}/js/script.js"></script>
@endif


<!-- Notifications  -->
<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-firestore.js"></script>
<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-database.js"></script>
<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-storage.js"></script>
<script src="https://kit.fontawesome.com/20e9a55510.js" crossorigin="anonymous"></script>



@if (Auth::check())
    <script type="text/javascript" src="{{ asset('public/meduo') }}/js/notification.js"></script>
@endif



@include('sweet::alert')
@stack('js')


</body>
</html>
