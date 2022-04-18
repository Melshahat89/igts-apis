<?php $VERSION_NUMBER = 2.0; ?>
<!DOCTYPE html>
<html lang="ar">
  <head>
          <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KGKDP6C');</script>
<!-- End Google Tag Manager -->

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
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

    <link rel="manifest" href="fav/site.webmanifest">
    <link rel="mask-icon" href="fav/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <title>{{ trans('home.HomeTitle') }} | Business</title>

    <!-- Bootstrap core CSS -->

    <!-- Custom styles -->
    @if(getDir() == "rtl")
    <link href="{{ asset('public/website/business/new') }}/css/bootstrap-rtl.min.css?v={{$VERSION_NUMBER}}" rel="stylesheet">
    <link href="{{ asset('public/website/business/new') }}/css/responsive-rtl.css?v={{$VERSION_NUMBER}}" rel="stylesheet">
    <link href="{{ asset('public/website/business/new') }}/css/main-rtl.css?v={{$VERSION_NUMBER}}" rel="stylesheet">
    @else
    <link href="{{ asset('public/website/business/new') }}/css/bootstrap.min.css?v={{$VERSION_NUMBER}}" rel="stylesheet">
    <link href="{{ asset('public/website/business/new') }}/css/responsive.css?v={{$VERSION_NUMBER}}" rel="stylesheet">
    <link href="{{ asset('public/website/business/new') }}/css/main.css?v={{$VERSION_NUMBER}}" rel="stylesheet">
    @endif
    
    
    <!-- Owl carousel -->
    <link href="{{ asset('public/website/business/new') }}/css/owl.carousel.css?v={{$VERSION_NUMBER}}" rel="stylesheet">
    
    

    <!-- HTML5 shim and Respond.js?v={{$VERSION_NUMBER}} IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js?v={{$VERSION_NUMBER}}"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js?v={{$VERSION_NUMBER}}"></script>
    <![endif]-->
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Tajawal:300,400,700&display=swap" rel="stylesheet">
  </head>

  <body role="document" class="{{ (getDir() == 'rtl')?'rtl':'' }}">

  <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KGKDP6C"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

    <div class="loading flexCenter">
      <div class="loader-logo">
        <div class="loader">Loading...</div>
        <img src="{{ asset('public/website') }}/images/logonew.png" alt="..." >
      </div>
    </div>

<header class="header-container">
  <div class="container">
    <div class="row">



     


      <nav class="navbar navbar-expand-lg w-100 pt-30">
        <a class="navbar-brand" href="#">
        <img src="{{ asset('public/website') }}/images/logonew.png" style="height: 63px;" alt="...">
          <span>{{ trans('business.For Business') }}</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
    

         
          <div class="mobileCenter">
            <a class="switcher" href="{{LaravelLocalization::getLocalizedURL((config('app.locale') == 'en') ? 'ar':'en') }}">{{trans('website.other lang')}} </a>

          </div>

          <div class="mobileCenter">
            <a class="solid_btn ml-20" href="javascript.void(0)" data-dismiss="modal" data-toggle="modal" data-target="#salesModal">{{ trans('business.contact us') }}</a>
          </div>
          <div class="mobileCenter">
            <a class="solid_btn ml-20 wa-b2b" href="https://wa.me/201099453688" target="blank">{{ trans('business.contact whatsapp') }}</a>
          </div>
          
        </div>
      </nav>
    </div>
  </div>
  <div class="container-fluid pt-50">
    <div class="hero_section">
      <div class="row reverse-mobile">
        <div class="col-lg-6 col-md-12 flexRight">
         <div class="w-60 content_area">
          <h1>{{trans('business.Our Services') }}</h1>
          <h2>{{ trans('business.Web Development & Design') }}</h2>

            <p>
                {{trans('business.Build your own custom')}}
            </p>
          <div class="flexRight mt-40">
            <a class="solid_btn ml-20" href="javascript.void(0)" data-dismiss="modal" data-toggle="modal" data-target="#salesModal">{{ trans('business.contact us') }}</a>
          </div>
         </div>
        </div>
        <div class="col-lg-6 col-md-12 p-0">
          <img src="{{ asset('public/website/business/new') }}/images/hero.jpg" class="w-100 fit-image"  alt="..." >
        </div>
      </div>
    </div>
  </div>
</header>

<section class="section-1 d-none">
  <div class="container-fluid">
    <div class="instant_access">
      <div class="row">
        <div class="col-lg-6 col-md-12 p-0">
          <img src="{{ asset('public/website/business/new') }}/images/Section1-img.jpg" class="w-100 fit-image" alt="..." >
        </div>
        <div class="col-lg-6 col-md-12 flexLeft">
         <div class="w-80 section_content">
          <h2>Get instant Access</h2>
          <h3>To your chosen courses</h3>
          <p class="mt-40 mb-40">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Bibendum est ultricies integer quis. Iaculis urna id volutpat lacus laoreet. Mauris vitae ultricies leo integer malesuada. Ac odio tempor orci dapibus ultrices in.
          </p>

          <div class="flexBetween MobileflexColCenter mt-30">
            <img src="{{ asset('public/website/business/new') }}/images/instant-access-img1.svg" class="mr-20 m-0-mobile" alt="..." >
            <p class="mt-mobile-20">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Bibendum est ultricies integer quis. Iaculis urna id volutpat lacus laoreet. Mauris vitae ultricies leo integer malesuada. Ac odio tempor orci dapibus ultrices in.
            </p>
          </div>

          <div class="flexBetween MobileflexColCenter mt-30">
            <img src="{{ asset('public/website/business/new') }}/images/instant-access-img2.svg" class="mr-20 m-0-mobile" alt="..." >
            <p class="mt-mobile-20">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Bibendum est ultricies integer quis. Iaculis urna id volutpat lacus laoreet. Mauris vitae ultricies leo integer malesuada. Ac odio tempor orci dapibus ultrices in.
            </p>
          </div>

          <div class="flexBetween MobileflexColCenter mt-30">
            <img src="{{ asset('public/website/business/new') }}/images/instant-access-img3.svg" class="mr-20 m-0-mobile" alt="..." >
            <p class="mt-mobile-20">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Bibendum est ultricies integer quis. Iaculis urna id volutpat lacus laoreet. Mauris vitae ultricies leo integer malesuada. Ac odio tempor orci dapibus ultrices in.
            </p>
          </div>


          <div class="flexRight MobileflexColCenter mb-mobile-20 mt-40">
          <a class="solid_btn ml-20" href="javascript.void(0)" data-dismiss="modal" data-toggle="modal" data-target="#salesModal">{{ trans('business.contact us') }}</a>

          </div>
         </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section-2 d-none">
  <div class="owl-carousel">
    <div>
      <img src="{{ asset('public/website/business/new') }}/images/instant-discount-img.jpg" alt="..." >
      <div class="content-box">
        <h2>Give instant discount <br> to your employees</h2>
        <h3>On their chosen courses </h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Bibendum est ultricies integer quis. Iaculis urna id volutpat lacus laoreet. Mauris vitae ultricies leo integer malesuada. Ac odio tempor orci dapibus ultrices in. Egestas diam in</p>
        <div class="flexRight mt-30">
        <a class="solid_btn ml-20" href="javascript.void(0)" data-dismiss="modal" data-toggle="modal" data-target="#salesModal">{{ trans('business.contact us') }}</a>
        </div>
      </div>
    </div>

    <div>
      <img src="{{ asset('public/website/business/new') }}/images/instant-discount-img.jpg" alt="..." >
      <div class="content-box">
        <h2>Give instant discount <br> to your employees</h2>
        <h3>On their chosen courses </h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Bibendum est ultricies integer quis. Iaculis urna id volutpat lacus laoreet. Mauris vitae ultricies leo integer malesuada. Ac odio tempor orci dapibus ultrices in. Egestas diam in</p>
        <div class="flexRight mt-30">
        <a class="solid_btn ml-20" href="javascript.void(0)" data-dismiss="modal" data-toggle="modal" data-target="#salesModal">{{ trans('business.contact us') }}</a>
        </div>
      </div>
    </div>

    <div>
      <img src="{{ asset('public/website/business/new') }}/images/instant-discount-img.jpg" alt="..." >
      <div class="content-box">
        <h2>Give instant discount <br> to your employees</h2>
        <h3>On their chosen courses </h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Bibendum est ultricies integer quis. Iaculis urna id volutpat lacus laoreet. Mauris vitae ultricies leo integer malesuada. Ac odio tempor orci dapibus ultrices in. Egestas diam in</p>
        <div class="flexRight mt-30">
        <a class="solid_btn ml-20" href="javascript.void(0)" data-dismiss="modal" data-toggle="modal" data-target="#salesModal">{{ trans('business.contact us') }}</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section-3">
  <div class="container">
    <div class="section-title">
      <h2>{{trans('business.Why choose us?')}}
      </h2>
      <p>
      {{trans('business.why choose us sub')}}
      </p>
    </div>

    <div class="owl-carousel mt-40">
      <div class="content-card">
        <img src="{{ asset('public/website/business/new') }}/images/payment.jpg">
        <h4 class="mt-20 mb-20">{{trans('business.Online Payment Integrations')}}
        </h4>
        <p>
        {{trans('business.Choose your payment methods')}}
        </p>
      </div>
      <div class="content-card">
        <img src="{{ asset('public/website/business/new') }}/images/cms.jpg">
        <h4 class="mt-20 mb-20">{{trans('business.Easy Content Management')}}
        </h4>
        <p>
        {{trans('business.Easy Content Management Sub')}}
        </p>
      </div>
      <div class="content-card">
        <img src="{{ asset('public/website/business/new') }}/images/techsupport.jpg">
        <h4 class="mt-20 mb-20">{{trans('business.Technical Support')}}
        </h4>
        <p>
        {{trans('business.Technical Support Sub')}}
        </p>
      </div>

    
    </div>

    <div class="flexCenter mt-40">
    <a class="solid_btn ml-20" href="javascript.void(0)" data-dismiss="modal" data-toggle="modal" data-target="#salesModal">{{ trans('business.contact us') }}</a>
    </div>
  </div>
</section>

<section class="section-4">
  <div class="container p-4">
    <div class="section-title">
      <h2>{{ trans('business.What do we offer?') }}
      </h2>
      <p>{{ trans('business.Provide you with the most important') }}

      </p>
    </div>

    <div class="row p-4">
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
         <div class="full feature_box">
             <div class="full icon">
                <img class="default-block" src="{{ asset('public/website/business/new') }}/images/insight.png" alt="#" />
                <img class="default-none" src="{{ asset('public/website/business/new') }}/images/insightw.png" alt="#" />
             </div>
             <div class="full pt-4">
                <h4>{{ trans('business.Analysis and insights') }}

                </h4>
             </div>
             
         </div>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
        <div class="full feature_box">
            <div class="full icon">
               <img class="default-block" src="{{ asset('public/website/business/new') }}/images/security.png" alt="#" />
               <img class="default-none" src="{{ asset('public/website/business/new') }}/images/securityw.png" alt="#" />
            </div>
            <div class="full pt-4">
               <h4>{{ trans('business.Multi-Layers Security') }}

               </h4>
            </div>
            
        </div>
     </div>
     <div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
      <div class="full feature_box">
          <div class="full icon">
             <img class="default-block" src="{{ asset('public/website/business/new') }}/images/payment-method.png" alt="#" />
             <img class="default-none" src="{{ asset('public/website/business/new') }}/images/payment-methodw.png" alt="#" />
          </div>
          <div class="full pt-4">
             <h4>{{ trans('business.Payment Methods Coverage') }}

             </h4>
          </div>
          
      </div>
   </div>
   <div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
    <div class="full feature_box">
        <div class="full icon">
           <img class="default-block" src="{{ asset('public/website/business/new') }}/images/content.png" alt="#" />
           <img class="default-none" src="{{ asset('public/website/business/new') }}/images/contentw.png" alt="#" />
        </div>
        <div class="full pt-4">
           <h4>{{ trans('business.Content Management System') }}

           </h4>
        </div>
        
    </div>
 </div>
 <div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
  <div class="full feature_box">
      <div class="full icon">
         <img class="default-block" src="{{ asset('public/website/business/new') }}/images/user-management.png" alt="#" />
         <img class="default-none" src="{{ asset('public/website/business/new') }}/images/user-managementw.png" alt="#" />
      </div>
      <div class="full pt-4">
         <h4>{{ trans('business.Team Management') }}

         </h4>
      </div>
      
  </div>
</div>
<div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
  <div class="full feature_box">
      <div class="full icon">
         <img class="default-block" src="{{ asset('public/website/business/new') }}/images/category.png" alt="#" />
         <img class="default-none" src="{{ asset('public/website/business/new') }}/images/categoryw.png" alt="#" />
      </div>
      <div class="full pt-4">
         <h4>{{ trans('business.Categories Management') }}

         </h4>
      </div>
      
  </div>
</div>
<div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
  <div class="full feature_box">
      <div class="full icon">
         <img class="default-block" src="{{ asset('public/website/business/new') }}/images/course-management.png" alt="#" />
         <img class="default-none" src="{{ asset('public/website/business/new') }}/images/course-managementw.png" alt="#" />
      </div>
      <div class="full pt-4">
         <h4>{{ trans('business.Courses Management') }}

         </h4>
      </div>
      
  </div>
</div>
<div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
  <div class="full feature_box">
      <div class="full icon">
         <img class="default-block" src="{{ asset('public/website/business/new') }}/images/subscription.png" alt="#" />
         <img class="default-none" src="{{ asset('public/website/business/new') }}/images/subscriptionw.png" alt="#" />
      </div>
      <div class="full pt-4">
         <h4>{{ trans('business.Individual Subscriptions') }}

         </h4>
      </div>
      
  </div>
</div>
   </div>
  </div>
</section>


<section class="section-5">
  <div class="container">
    <div class="section-title">
      <h2>{{ trans('business.Additional Features') }}
      </h2>
      <p>
      {{ trans('business.Extra features to empower your services and reach more potenital customers') }}
      </p>
    </div>

    <div class="row align-items-center mt-40">
      <div class="col-lg-12 col-md-12">
          <div class="row align-items-center">

              <div class="col-md-6 col-12 d-flex justify-between mb-4">
                <div class="additional-features-image-container">
                  <img class="" src="{{ asset('public/website/business/new/images') }}/firewall.png">
                </div>
                <div class="features-single-wrap mb-sm-0 mb-md-5 mb-lg-5">
                    <div class="features-single-content d-block overflow-hidden">
                        <h5 class="mb-2">{{ trans('business.Encrypted Videos Hosting') }}</h5>
                        <p>{{ trans('business.Secured video hosting to make sure that your videos are safe from unauthorized access') }}</p>
                    </div>
                </div>
              </div>
<div class="col-md-6 col-12 d-flex justify-between mb-4">
                <div class="additional-features-image-container">
                  <img class="" src="{{ asset('public/website/business/new/images') }}/notification.png">
                </div>
                <div class="features-single-wrap mb-sm-0 mb-md-5 mb-lg-5">
                    <div class="features-single-content d-block overflow-hidden">
                        <h5 class="mb-2">{{ trans('business.Notifications System') }}</h5>
                        <p>{{ trans('business.Secured video hosting to make sure that your videos are safe from unauthorized access') }}</p>
                    </div>
                </div>
              </div>
              <div class="col-md-6 col-12 d-flex justify-between mb-4">
                <div class="additional-features-image-container">
                  <img class="" src="{{ asset('public/website/business/new/images') }}/business.png">
                </div>
                <div class="features-single-wrap mb-sm-0 mb-md-5 mb-lg-5">
                    <div class="features-single-content d-block overflow-hidden">
                        <h5 class="mb-2">{{ trans('business.Business Module') }}</h5>
                        <p>{{ trans('business.Sell your courses to a business and allow them') }}</p>
                    </div>
                </div>
              </div>
              <div class="col-md-6 col-12 d-flex justify-between mb-4">
                <div class="additional-features-image-container">
                  <img class="" src="{{ asset('public/website/business/new/images') }}/event.png">
                </div>
                <div class="features-single-wrap mb-sm-0 mb-md-5 mb-lg-5">
                    <div class="features-single-content d-block overflow-hidden">
                        <h5 class="mb-2">{{ trans('business.Events Module') }}</h5>
                        <p>{{ trans('business.Make your website a gateway for event planners and hosts') }}</p>
                    </div>
                </div>
              </div>
              <div class="col-md-6 col-12 d-flex justify-between mb-4">
                <div class="additional-features-image-container">
                  <img class="" src="{{ asset('public/website/business/new/images') }}/partnership.png">
                </div>
                <div class="features-single-wrap mb-sm-0 mb-md-5 mb-lg-5">
                    <div class="features-single-content d-block overflow-hidden">
                        <h5 class="mb-2">{{ trans('business.Partnership Module') }}</h5>
                        <p>{{ trans('business.Make your website a gateway for professional and amature instructors') }}</p>
                    </div>
                </div>
              </div>
  
              
                           
                        </div>
                    </div>
                </div>


    <div class="flexCenter mt-40 ">
    <a class="solid_btn ml-20" href="javascript.void(0)" data-dismiss="modal" data-toggle="modal" data-target="#salesModal">{{ trans('business.contact us') }}</a>
    </div>
  </div>
</section>

<section class="section-6">
  <div class="container">
    <div class="section-title white-font mb-40">
      <h2>{{ trans('business.Media Production Service') }}</h2>
    </div>
  </div>


  <div class="wrapper">
    <div>
      <video preload="preload"  id="video" poster="{{ asset('public/website/business/new') }}/images/video-poster.jpg"  style="width:100%; height: 370px;" >
        <source src="{{ asset('public/website/business/new') }}/images/showreel-igts.mp4" type="video/mp4"></source>
      </video> 
      <div class="playpause"></div>

    </div>
  </div>

  <div class="container"> 
    <div class="under-video-content">
      <h5>{{ trans('business.Courses Videos') }}</h5>
      <p>{{ trans('business.We aim to provide the best smart media production solution to improve the quality of education and training in institutions, companies and universities in the medical field, this solution help overcome the difficulties of the traditional learning process. We provide educational media production for all the medical departments inside any institution.') }}</p>
      <br>
      <h5>{{ trans('business.Training Videos') }}</h5>
      <p>{{ trans('business.Also, you can accelerate your staff learning curve by using demonstration and training videos. The power of the visual medium allows team members to watch the video over and over again until the information is understood. It’s an excellent way to clarify “how to” steps. Quality training videos that use clear communication can cut down on training expenses since they eliminate the need for repetitious instruction to accommodate new team members.') }}</p>
      <br>
      <h5>{{ trans('business.Documentary Videos') }}</h5>
      <p>{{ trans('business.One of the best ways to introduce your company to consumers is through a company profile video. It can include messages from the CEO, other top officials and services experts. This type of video helps reach a common ground with people within and beyond your target market. By showing pictures of inside the enterprise and giving a little company history, along with its mission statement and unique marketing proposition, viewers can get a clear idea of the company’s purpose in the market.') }}</p>
      <br>
      <h5>{{ trans('business.Motion Graphic Videos') }}</h5>
      <p>{{ trans('business.We offers end-to-end motion graphics services which include visuals, typography and plain motion graphics. Our team has the experience to initiate motion graphics even with a simple script and arrive at the best user experience. After understanding the input, our motion graphic artists create a storyboard and transform it into engaging motion graphic content by creatively syncing visual and audio.') }}</p>
      <br>
      <h5>{{ trans('business.Studio Services') }}</h5>
      <p>{{ trans('business.If you need space to shoot your projects, Meduo Studio is a great place to shoot your next project! Meduo Studio houses option to take advantage of hiring professional camera gear, photographer and videographer.') }}</p>
      <br>
      <h5>{{ trans('business.Editing Services') }}</h5>
      <p>{{ trans('business.All the tasks associated with video production that come after shooting the raw video. During this phase, a range of profiles will pool our talents to complete video of tasks, editing, sound design, special effects, and animation.') }}</p>

      <div class="flexRight mt-40 ">
      <a class="solid_btn ml-20" href="javascript.void(0)" data-dismiss="modal" data-toggle="modal" data-target="#salesModal">{{ trans('business.contact us') }}</a>
      </div>
    </div>
  </div>

</section>

        <!--counter section start-->
        <section class="counter-section gradient-bg ptb-40" style="margin-top: 70px;">
          <div class="container">
              <div class="row">
                  <div class="col-sm-6 col-md-6 col-lg-4">
                      <div class="text-white p-2 count-data text-center my-3">
                          <img class="mb-4" src="{{ asset('public/website/business/new/images') }}/expert.png">
                          <h3 class="count-number mb-1 text-white font-weight-bolder">8</h3>
                          <span>{{ trans('business.Years Of Experience') }}</span>
                      </div>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-4">
                      <div class="text-white p-2 count-data text-center my-3">
                      <img class="mb-4" src="{{ asset('public/website/business/new/images') }}/countries.png">
                          <h3 class="count-number mb-1 text-white font-weight-bolder">23</h3>
                          <span>{{ trans('business.Countries') }} </span>
                      </div>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-4">
                      <div class="text-white p-2 count-data text-center my-3">
                      <img class="mb-4" src="{{ asset('public/website/business/new/images') }}/team.png">
                          <h3 class="count-number mb-1 text-white font-weight-bolder">65</h3>
                          <span>{{ trans('business.Team Members') }}</span>
                      </div>
                  </div>
                  
              </div>
          </div>
      </section>
      <!--counter section end-->


<section class="section-7">
  <div class="container">
    <div class="section-title">
      <h2>{{ trans('business.Our Projects') }} </h2>
    </div>

    <div class="mt-40 owl-carousel">
      <div class="row row-item-content mb-40">
        <div class="col-md-4 p-0">
          <img src="{{ asset('public/website/business/new') }}/images/igts.jpg" alt="..." class="w-100 p-10" >
        </div>
        <div class="col-md-8 flexCenter">
          <div class="item-content">
            <h4>{{ trans('business.IGTS') }}</h4>
            <p>{{ trans('business.The idea behind IGTS was to build a dedicated platform to publish our courses on and provide our users with a life-time accessibilty so they can watch our courses and do the entire online learning lifecycle at their own pace.') }}</p>
            <p>{{ trans('business.It provides social login with Facebook and Google for easy accessibilty.') }}</p>
            <p>{{ trans('business.IGTS was built from scratch using PHP programming language.') }}</p>
            <p>{{ trans('business.The website supports multi-currency and online payment integration with Visa & MasterCard to suit the global customers from different countries.') }}</p>
            <p>{{ trans('business.The users will be provided with certificate of completion upon passing the course exams.') }}</p>
            <p>{{ trans('business.The exams module is built to support MCQ and True/False questions with the ability set an exam timer and passing percentage of each exam.') }}</p>
          </div>
        </div>
      </div>

      <div class="row row-item-content mb-40">
        <div class="col-md-4 p-0">
          <img src="{{ asset('public/website/business/new') }}/images/meduo.jpg" alt="..." class="w-100 p-10" >
        </div>
        <div class="col-md-8 flexCenter">
          <div class="item-content">
            <h4>{{ trans('business.MEDUO') }}</h4>
            <p>{{ trans('business.Meduo required an LMS platform that provides speed, elegent and simple design, security and flexbility.') }}</p>
            <p>{{ trans('business.It provides social login with Facebook Google and Twitter for easy accessibilty.') }}</p>
            <p>{{ trans('business.The website supports multi-currency and online payment integrations with multiple payment gateway providers, such as Visa & MasterCard, Fawry, Mobile Wallet.') }}</p>
            <p>{{ trans('business.Meduos customers are able to choose from different subscription plan for each of their courses, such as monthly, yearly and life-time plans.') }}</p>
            <p>{{ trans('business.The users will be provided with certificate of completion upon passing the course exams.') }}</p>
            <p>{{ trans('business.The exams module is built to support MCQ and True/False questions with the ability set an exam timer and passing percentage of each exam.') }}</p>
            <p></p>

        </div>
      </div>
    </div>

    <div class="row row-item-content mb-40">
      <div class="col-md-4 p-0">
        <img src="{{ asset('public/website/business/new') }}/images/ihtiraf.jpg" alt="..." class="w-100 p-10" >
      </div>
      <div class="col-md-8 flexCenter">
        <div class="item-content">
          <h4>{{ trans('business.IHTIRAF') }}</h4>
          <p>{{ trans('business.Ihtiraf required an LMs platform where they can published their courses on') }}</p>
          <p>{{ trans('business.Ihtirafs web design was the result of intensive research using the top LMS platforms as reference to come up with a design that is elgent, simple and responsive on all devices.') }}</p>
          <p>{{ trans('business.The website supports multi-currency and online payment integrations with multiple payment gateway providers.') }}</p>
          <p>{{ trans('business.Ihtirafs customers are able to choose from different subscription plan for all of their courses, such as monthly and yearly plans.') }}</p>
          <p>{{ trans('business.The exams module is built to support MCQ, True/False and essay questions with the ability to set the passing percentage and the mark of each question.') }}</p>
        </div>
      </div>
    </div>
  </div>

    <div class="flexCenter mt-40 ">
    <a class="solid_btn ml-20" href="javascript.void(0)" data-dismiss="modal" data-toggle="modal" data-target="#salesModal">{{ trans('business.contact us') }}</a>
    </div>

  </div>
</section>




<footer class="footer-container">
  <div class="container text-center">
    <img src="{{ asset('public/website') }}/images/logonewwhite.png" class="footer-image" alt="MEDU Footer Logo">
    <p class="mb-40 white-color footer-content">
        {{trans('website.Footer IGTS')}}
    </p>

    <div class="social-links">
      <a href="https://www.facebook.com/igtsgroup" target="blank"><img src="{{ asset('public/website/business/new') }}/images/facebook.svg" alt="facebook" ></a>
      <a href="https://twitter.com/igtsgroup" target="blank"><img src="{{ asset('public/website/business/new') }}/images/twitter.svg" alt="twitter" ></a>
      <a href="https://www.linkedin.com/company/igtsgroup" target="blank"><img src="{{ asset('public/website/business/new') }}/images/linkedin.svg" alt="linkedin" ></a>
    </div>
  </div>
  <div class="copywrite text-center">
    <div class="container">
      <p style="color: white;">{{ trans('business.Copyright') }} © {{currentYear()}} <a href="#">IGTS.</a> All rights reserved.</p>
    </div>
  </div>
</footer>

<!-- Modal -->
<div class="modal fade" id="salesModal" tabindex="-1" role="dialog" aria-labelledby="salesModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="salesModal">{{ trans('business.contact_sales') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/shell.js"></script>
        <script>
          hbspt.forms.create({
          region: "na1",
          portalId: "7171341",
          formId: "4242db24-56b6-444f-827c-13baa3fce2af"
        });
        </script>
      </div>

    </div>
  </div>
</div>


<div class="modal fade" id="HubspotModal" tabindex="-1" role="dialog" aria-labelledby="HubspotModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header flexRight">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body p-0 sign-tabs">
            Hubspot form
        </div>
    </div>
</div>
</div>

    <!-- Bootstrap core JavaScript  -->
    
    <script src="{{ asset('public/website/business/new') }}/js/jquery-3.4.1.min.js?v={{$VERSION_NUMBER}}"></script>
    <script src="{{ asset('public/website/business/new') }}/https://cdnjs.cloudflare.com/ajax/libs/popper.js?v={{$VERSION_NUMBER}}/1.11.0/umd/popper.min.js?v={{$VERSION_NUMBER}}" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="{{ asset('public/website/business/new') }}/js/bootstrap.min.js?v={{$VERSION_NUMBER}}"></script>
    <script src="{{ asset('public/website/business/new') }}/js/owl.carousel.min.js?v={{$VERSION_NUMBER}}"></script>
    @if(getDir() == "rtl")
    <script src="{{ asset('public/website/business/new') }}/js/script-rtl.js?v={{$VERSION_NUMBER}}"></script>
    @else
    <script src="{{ asset('public/website/business/new') }}/js/script.js?v={{$VERSION_NUMBER}}"></script>
    @endif
    

    
  </body>
</html>
