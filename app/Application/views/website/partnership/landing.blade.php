@php $VERSION_NUMBER = 1.0; @endphp
<!DOCTYPE html>
<html lang="ar">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ trans('home.MeduoHomeDescription') }}">
    <meta name="keywords" content="{{ trans('home.MeduoHomeKeywords') }}">
    <meta name="author" content="Meduo">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('public/partnership') }}/fav/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('public/partnership') }}/fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/partnership') }}/fav/favicon-16x16.png">
    <link rel="manifest" href="{{ asset('public/partnership') }}/fav/site.webmanifest">
    <link rel="mask-icon" href="{{ asset('public/partnership') }}/fav/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <meta property="og:image" content="https://meduo.net/newassets/{{ asset('public/partnership') }}/images/defaultthumbnail.jpg">
    <meta property="og:image:type" content="image/jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="1200">

    <title>Meduo - {{ trans('partnership.partnership') }}</title>


    <!-- Flaticon Font -->
    <link href="{{ asset('public/partnership') }}/css/flaticon.css?v={{$VERSION_NUMBER}}" rel="stylesheet">


    

    @if(getDir() == 'rtl')
    <!-- Bootstrap core CSS -->
        <link href="{{ asset('public/partnership') }}/css/bootstrap-rtl.min.css?v={{$VERSION_NUMBER}}" rel="stylesheet">
        <link href="{{ asset('public/partnership') }}/css/main-rtl.css?v={{$VERSION_NUMBER}}" rel="stylesheet">
        <link href="{{ asset('public/partnership') }}/css/responsive-rtl.css?v={{$VERSION_NUMBER}}" rel="stylesheet">
        <link href="{{ asset('public/partnership') }}/css/inner.css?v={{$VERSION_NUMBER}}" rel="stylesheet">
        <link href="{{ asset('public/partnership') }}/css/custom-rtl.css?v={{$VERSION_NUMBER}}" rel="stylesheet">

        <link href="{{ asset('public/partnership') }}/css/partnership-rtl.css?v={{$VERSION_NUMBER}}" rel="stylesheet">

@else
    <!-- Bootstrap core CSS -->
        <link href="{{ asset('public/partnership') }}/css/bootstrap.min.css?v={{$VERSION_NUMBER}}" rel="stylesheet">
        <link href="{{ asset('public/partnership') }}/css/main.css?v={{$VERSION_NUMBER}}" rel="stylesheet">
        <link href="{{ asset('public/partnership') }}/css/responsive.css?v={{$VERSION_NUMBER}}" rel="stylesheet">
        <link href="{{ asset('public/partnership') }}/css/inner.css?v={{$VERSION_NUMBER}}" rel="stylesheet">
        <link href="{{ asset('public/partnership') }}/css/custom.css?v={{$VERSION_NUMBER}}" rel="stylesheet">
        <link href="{{ asset('public/partnership') }}/css/partnership.css?v={{$VERSION_NUMBER}}" rel="stylesheet">



@endif

    
    <!-- Hover -->
    <link href="{{ asset('public/partnership') }}/css/hover-min.css?v={{$VERSION_NUMBER}}" rel="stylesheet">
    <link href="{{ asset('public/partnership') }}/css/owl.carousel.css?v={{$VERSION_NUMBER}}" rel="stylesheet">
    
    <!-- Hamburgers Menu -->
    <link href="{{ asset('public/partnership') }}/css/hamburgers.css?v={{$VERSION_NUMBER}}" rel="stylesheet">


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Tajawal:300,400,700&display=swap" rel="stylesheet">
  </head>

  <body class="partnership_body">

  <div class="loading flexCenter">
    <div class="loader-logo">
        <div class="loader">Loading...</div>
        <img src="{{ asset('public/meduo') }}/images/logo.svg" alt="Meduo" >
    </div>
</div>
  <header>
   <div class="container">
    <nav class="navbar navbar-light">
      <a href="#">
      @if(getDir() == "rtl")
        <img class="logo" src="{{ asset('public/partnership') }}/images/partnership/logo_partner-rtl.png"  alt="..." />
      @else
      <img class="logo" src="{{ asset('public/partnership') }}/images/partnership/logo_partner.png"  alt="..." />

      @endif
        <!-- <img class="m-logo" src="{{ asset('public/partnership') }}/images/partnership/m-logo.png"  alt="..." /> -->
      </a>
      <div class="form-inline mobile-center mobile-100">

        @if (Auth::check())
          @if((Auth::user()->group_id == 4) OR (Auth::user()->group_id == 5))
            <a href="{{url('partnership/myCourses')}}" class="custom-btn mt-20 mr-15">{{trans('website.Dashboard')}}</a>
          @endif
        @else
          <a href="#" class="custom-btn mt-20 mr-15" data-dismiss="modal" data-remote="/login" data-toggle="modal" data-target="#loginModal">{{ trans('website.login') }}</a>


          <a href="{{ url('partnership/register-individual') }}" class="custom-btn mt-20">{{trans('website.register')}}</a>
        @endif


      </div>
    </nav>
   </div>
  </header>

  <section class="main_slider mt-150">
    <div class="container">
      <div class="owl-carousel">
        <div>
          <div class="row mt-40 mb-40 justify-content-start">
            <div class="col-md-5 slider_content ">
              <h1>{{ trans('partnership.partnership program') }}</h1>
              <p>
                {{ trans('partnership.description') }}
              </p>  

              <a href="/partnership/register-individual" class="joinusnow">
                {{ trans('partnership.join') }}
              </a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <section class="whyus mt-80">
    <div class="container">
      <h2 class="mb-40"><strong>{{ trans('partnership.why') }} </strong> {{ trans('partnership.you should join us') }}</h2>

      <div class="row center_me mobile-center">
        <div class="col-md-3">
          <img src="{{ asset('public/partnership') }}/images/partnership/why_1.png" alt="..." >
        </div>
        <div class="col-md-9">
          <h3>{{ trans('partnership.Information accessibility') }}</h3>
          <p>
          {{ trans('partnership.information access desc') }}
          </p>
        </div>
      </div>
      <div class="row reverse_me center_me text-right mobile-center">
        <div class="col-md-3">
          <img src="{{ asset('public/partnership') }}/images/partnership/why_2.png" alt="..." >
        </div>
        <div class="col-md-9">
          <h3>{{ trans('partnership.Your voice will be heard') }}</h3>
          <p>
          {{ trans('partnership.your voice desc') }}          </p>
        </div>
      </div>
      <div class="row center_me mobile-center">
        <div class="col-md-3">
          <img src="{{ asset('public/partnership') }}/images/partnership/why_3.png" alt="..." >
        </div>
        <div class="col-md-9">
          <h3>{{ trans('partnership.Continuous support and follow-up') }}</h3>
          <p>
          {{ trans('partnership.support and follow up desc') }}
          </p>
        </div>
      </div>
    </div>
  </section>

  <section class="benefits mt-80">
    <div class="container">
      
      @if(getDir() == "rtl")
      <h2 class="mb-20"><strong>{{ trans('partnership.Benefits') }}</strong> {{ trans('partnership.Your') }}</h2>
      @else
      <h2 class="mb-20"><strong>{{ trans('partnership.Your') }}</strong> {{ trans('partnership.Benefits') }}</h2>
      @endif
      <div class="owl-carousel mt-40 mb-40">
        <div>
          <div class="benefits-card">
            <img src="{{ asset('public/partnership') }}/images/partnership/benefits_1.png" alt="..." >
            <div class="card_decor">
              <h4>{{ trans('partnership.Profit analysis') }}</h4>
              <p>
                {{ trans('partnership.profit analysis desc') }}
              </p>
            </div>
          </div>
        </div>

        <div>
          <div class="benefits-card">
            <img src="{{ asset('public/partnership') }}/images/partnership/benefits_2.png" alt="..." >
            <div class="card_decor">
              <h4>{{ trans('partnership.Courses Analysis') }}</h4>
              <p>
                {{ trans('partnership.courses analysis desc') }}
              </p>
            </div>
          </div>
        </div>

        <div>
          <div class="benefits-card">
            <img src="{{ asset('public/partnership') }}/images/partnership/benefits_3.png" alt="..." >
            <div class="card_decor">
              <h4>{{ trans('partnership.Online Examination System') }}</h4>
              <p>
                {{ trans('partnership.online exam desc') }}
              </p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <section class="how-to-register meet_our">
    <div class="container">
      <div class="flexBetween">
        <h2 class="mb-20"><strong>{{ trans('partnership.How') }}</strong> {{ trans('partnership.register with us') }}</h2>
        <div class="arrow-action">
          <i class="flaticon-back"></i>
          <i class="flaticon-right-arrow"></i>
        </div>
      </div>
      <p class="d-none">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
      <div class="owl-carousel mt-40 mb-40">
        <div class="row center_me">
          <div class="col-md-6">
            <div class="wrapper">
              <video preload="preload" class="video" id="video1" poster="{{ asset('public/partnership') }}/images/partnership/how_poster.jpg" style="width:100%">
                  <source src="{{ asset('public/partnership') }}/images/Select-account-type.mp4" type="video/mp4">
                </video> 
                  <div class="playpause"></div>
              </div>
          </div>
          <div class="col-md-6">
            <h4>{{ trans('partnership.Step 1') }}</h4>
            <h3>{{ trans('partnership.Select account type') }}</h3>
            <p>
              <a href="/partnership/register-individual"> {{ trans('partnership.step 1 desc 1') }} </a> {{ trans('partnership.step 1 desc 2') }}            
            </p>
          </div>
        </div>

        <div class="row center_me">
          <div class="col-md-6">
            <div class="wrapper">
              <video preload="preload" class="video" id="video2" poster="{{ asset('public/partnership') }}/images/partnership/how_poster.jpg" style="width:100%">
                  <source src="{{ asset('public/partnership') }}/images/Fill-the-form.mp4" type="video/mp4">
                </video> 
                  <div class="playpause"></div>
              </div>
          </div>
          <div class="col-md-6">
            <h4>{{ trans('partnership.Step 2') }}</h4>
            <h3> {{ trans('partnership.Fill a form') }} </h3>
            <p>
              {{ trans('partnership.step 2 desc') }}
          </p>
          </div>
          
        </div>

        <div class="row center_me">
          <div class="col-md-6">
            <div class="wrapper">
              <video preload="preload" class="video" id="video3" poster="{{ asset('public/partnership') }}/images/partnership/how_poster.jpg" style="width:100%">
                  <source src="{{ asset('public/partnership') }}/images/Add-new-course.mp4" type="video/mp4">
                </video> 
                  <div class="playpause"></div>
              </div>
          </div>
          <div class="col-md-6">
            <h4>{{ trans('partnership.Step 3') }}</h4>
            <h3>{{ trans('partnership.Add new course') }}</h3>
            <p>
              {{ trans('partnership.step 3 desc') }}
            </p>
          </div>
        </div>
      </div>  
     
    </div>
  </section>

  <footer class="partners_footer">
    <div class="container">
    <p class="text-center d-none">
      Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
    </p>
    <div class="text-center comment-more-btn mt-40">
      <a class="more_button text-center" href="/partnership/register-individual">{{ trans('partnership.join') }}</a>
    </div>
    </div>
    <div class="copywrite">
      <div class="container">
        <p>{{ trans('partnership.Copyright') }} © 2021 <span>Meduo.net</span>. {{ trans('partnership.All rights reserved') }}.</p>
      </div>
    </div>
  </footer>


<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
    @include('website.theme.bootstrap.layout.popup.login');
</div>

<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModal" aria-hidden="true">
    @include('website.theme.bootstrap.layout.popup.register');
</div>



    <!-- Bootstrap core JavaScript  -->
    
    <script src="{{ asset('public/partnership') }}/js/jquery-3.4.1.min.js?v={{$VERSION_NUMBER}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js?v={{$VERSION_NUMBER}}" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="{{ asset('public/partnership') }}/js/bootstrap.min.js?v={{$VERSION_NUMBER}}"></script>
    <script src="{{ asset('public/partnership') }}/js/owl.carousel.min.js?v={{$VERSION_NUMBER}}"></script>

    @if(getDir() == 'rtl')
    <script src="{{ asset('public/partnership') }}/js/script-rtl.js?v={{$VERSION_NUMBER}}"></script>
    @else
    <script src="{{ asset('public/partnership') }}/js/script.js?v={{$VERSION_NUMBER}}"></script>
    @endif

    
  </body>
</html>
