<!doctype html>
<html lang="{{ config('app.locale') }}">

<head>

    <title>@yield('title') </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="author" content="Meduo">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
    @if (getDir() == 'rtl')
        <link rel="stylesheet" href="{{ asset('public/business') }}/vendor/bootstrap/css/bootstrap.rtl.full.min.css">
        <link rel="stylesheet" href="{{ asset('public/business') }}/css/main-rtl.css">
    @else
        <link rel="stylesheet" href="{{ asset('public/business') }}/vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('public/business') }}/css/main.css">
    @endif

    <link rel="stylesheet" href="{{ asset('public/business') }}/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('public/business') }}/vendor/linearicons/style.css">
    <link rel="stylesheet" href="{{ asset('public/business') }}/vendor/chartist/css/chartist-custom.css">
    <link rel="stylesheet" href="{{ asset('public/business') }}/vendor/toggle-master/css/bootstrap-toggle.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.0.3/css/dataTables.dateTime.min.css">


    <link href="{{ url('/public/css/select2.css') }}" rel="stylesheet" />

    <!-- MAIN CSS -->

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Tajawal:300,400,700&display=swap" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
  

    <!-- FAV ICONS -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('public/business') }}/fav/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('public/business') }}/fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/business') }}/fav/favicon-16x16.png">
    <link rel="manifest" href="{{ asset('public/business') }}/fav/site.webmanifest">
    <link rel="mask-icon" href="{{ asset('public/business') }}/fav/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    {{ Html::style('public/css/sweetalert.css') }}
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <style>
        .notf-line {
            padding: 10px 15px;
            display: block;
            border-bottom: 1px solid #ddd;
        }
        .head_notifications{
            width: 310px;
        }
        .flexLeft {
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }
        .notf-line img {
            margin-right: 10px;
            width: 35px;
            height: 35px;
            border-radius: 90px;
        }
        .card-date {
            font-size: 12px;
            color: #9b9a9a;
            margin-bottom: 5px;
        }
    </style>



    @stack('css')
</head>

<body>
    <!-- WRAPPER -->
    <div id="wrapper">
        <!-- NAVBAR -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="brand">
                <a href="index.html"><img src="{{ asset('public/business') }}/img/logo.svg" alt="MEDU Logo"
                        class="img-responsive logo"></a>
            </div>
            <div class="container-fluid">
                <div class="navbar-btn">
                    <button type="button" class="btn-toggle-fullwidth"><i
                            class="lnr lnr-arrow-left-circle"></i></button>
                </div>
                <form class="navbar-form navbar-left">
                    <div class="input-group" style="display: none;">
                        <input type="text" value="" class="form-control" placeholder="Search dashboard...">
                        <span class="input-group-btn"><button type="button" class="btn btn-primary">Go</button></span>
                    </div>
                </form>
                <div class="navbar-btn navbar-btn-right hide-desktop show-mobile">
                    <a href="index.html"><img src="{{ asset('public/business') }}/img/logo.svg" alt="MEDU Logo"
                            class="img-responsive logo"></a>
                </div>
                <div id="navbar-menu">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a
                                href="{{ LaravelLocalization::getLocalizedURL(config('app.locale') == 'en' ? 'ar' : 'en') }}">
                                <span>{{ trans('website.another lang') }}</span> <i class="lnr lnr-earth"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                                <i class="lnr lnr-alarm"></i>
                                <span class="floated_count badge bg-danger">0</span>
                            </a>
                            <div class="dropdown-menu notifications head_notifications">
                            </div>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img
                                    src="{{ small(Auth::user()->image) }}" class="img-circle" alt="Avatar">
                                <span>{{ Auth::user()->name }}</span> <i
                                    class="icon-submenu lnr lnr-chevron-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item"
                                        href="{{ url('account/edit') }}">{{ trans('website.Account Settings') }}</a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="lnr lnr-exit"> </i> <span>{{ trans('website.Sign out') }}</span>
                                    </a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- END NAVBAR -->
        <!-- LEFT SIDEBAR -->
        <div id="sidebar-nav" class="sidebar">
            <div class="sidebar-scroll">
                <nav>
                    <ul class="nav">
						<li>
							<a href="{{ url('business/home') }}" class="" id="home"><i class="lnr lnr-home"></i> 
							<span>{{ trans('businessdata.Dashboard') }}</span>
							</a>
                        </li>
                        <li><a href="{{ url('business/settings') }}" class="" id="settings"><i class="lnr lnr-cog"></i> <span>{{ trans('businessdata.Settings') }}</span></a></li>
                        <li><a href="{{ url('business/groups') }}" class="" id="groups"><i class="lnr lnr-file-add"></i> <span>{{ trans('businessdata.Groups') }}</span></a></li>
                        <li>
                            <a href="#subTabs1" data-toggle="collapse" class="collapsed"><i class="lnr lnr-users"></i>
                                <span>{{ trans('businessdata.Users') }}</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="subTabs1" class="collapse ">
                                <ul class="nav">
                                    <li><a href="{{ url('business/users-information') }}" class="" id="usersInformation">{{ trans('businessdata.Users information') }}</a></li>
                                    <li><a href="{{ url('business/invite-users') }}" class="" id="inviteUsers">{{ trans('businessdata.Invite Users') }} </a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="{{ url('business/enrollments') }}" class=""><i class="lnr lnr-film-play"></i>
                                <span>{{ trans('businessdata.Enrollments') }}</span></a></li>
                        <li>
                            <a href="#subTabs2" data-toggle="collapse" class="collapsed"><i class="lnr lnr-user"></i>
                                <span>{{ trans('businessdata.Users Performance') }}</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                            <div id="subTabs2" class="collapse ">
                                <ul class="nav">
                                    <li><a href="{{ url('business/user-adoption-funnel') }}" class="" id="userAdoptionFunnel">{{ trans('businessdata.User Adoption Funnel') }}</a></li>
                                    <li><a href="{{ url('business/courses-insight') }}" class="" id="coursesInsight">{{ trans('businessdata.Courses Insight') }}</a></li>
                                    <li><a href="{{ url('business/users-insight') }}" class="" id="usersInsight">{{ trans('businessdata.Users insight') }}</a></li>
                                    <li style="display: none;"><a href="{{ url('business/user-activity') }}" class="">{{ trans('businessdata.User activity log') }} </a></li>
                                </ul>
                            </div>
                        </li>

                        <li style="display: none;"><a href="{{ url('business/tickets') }}" class=""><i class="lnr lnr-film-play"></i>
                            <span>{{ trans('businessdata.tickets') }}</span></a></li>
                       

                    </ul>
                </nav>
            </div>
        </div>
        <!-- END LEFT SIDEBAR -->
        <!-- MAIN -->
        <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    @yield('content')
                    <input type='hidden' id='user_id' value='{{(auth()->check())?Auth::user()->id:''}}'>
                    <input type='hidden' id='path' value='{{ url('/') }}'>

                    @if (count($errors) > 0)
                        <div class="alert bg-red">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                

                </div>
                <!-- END HomePage -->
            </div>
        </div>
        <!-- END MAIN CONTENT -->
    </div>
    <!-- END MAIN -->
    <div class="clearfix"></div>
    <footer>
        <div class="container-fluid">
            <p class="copyright">&copy; 2020 <a href="#" target="_blank">MEDU</a>. All Rights Reserved.</p>
        </div>
    </footer>
    </div>
    <!-- END WRAPPER -->

    {{--  {!! Links::track(true) !!}  --}}
    {{ Html::script('public/js/sweetalert.min.js') }}
    <!-- Bootstrap core JavaScript  -->

    <!-- Javascript -->
    <script src="{{ asset('public/business') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('public/business') }}/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ asset('public/business') }}/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  
    <script src="{{ asset('public/business') }}/vendor/toggle-master/bootstrap-toggle.min.js"></script>
    <script src="{{ asset('public/business') }}/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
    <script src="{{ asset('public/business') }}/scripts/scripts.js"></script>
    <!-- Notifications  -->
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-firestore.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-storage.js"></script>
    <script src="https://kit.fontawesome.com/20e9a55510.js" crossorigin="anonymous"></script>

    <link href="{{ url('/public/css/mainselec2.css') }}" rel="stylesheet" />
    <script src="{{ url('public/js/select2.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/datetime/1.0.3/js/dataTables.dateTime.min.js"></script>


    

    <script>
    $('.select2').select2({
        theme: "bootstrap",
        allowClear: true,
        width: '100%',
        placeholder: "Select courses to assign",

        dir:"{{ getDirection() }}"
    });

  
    </script>

    @if (Auth::check())
        <script type="text/javascript" src="{{ asset('public/meduo') }}/js/notification.js"></script>
    @endif


    @php  $actionName = substr(Route::getCurrentRoute()->getActionName(), strpos(Route::getCurrentRoute()->getActionName(), "@") + 1);  @endphp

    <script>

        var selectedMenu = document.getElementById("{{$actionName}}");
        selectedMenu.classList.add("active");

    </script>

    @include('sweet::alert')
    @stack('js')


</body>

</html>
