
<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>404</title>

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


</head>
<body>

<div class="container-fluid">


<div class="error-page d-flex justify-content-center" style="height: 600px;">
    <div class="text-center align-self-center">

        <img src="https://meduo.net/images/front/404.png" alt="" style="width:100%;max-width:280px;">
        <p class="pt-4 pb-4" data-p="NOT FOUND">{{trans('home.404')}}</p>
        <a href="/" class="button button_primary text_capitalize">{{trans('home.back-to-home')}}</a>

    </div>
</div>

</div>

</body>
</html>

