    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img src="{{ small(Auth::user()->image)}}" alt="..." >
        <span class="user-name"> {{ Auth::user()->name }}   <b class="caret"></b> </span>
    </a>
    <div class="dropdown-menu custom-drop-item" aria-labelledby="dropdownMenuLink">

        @if((Auth::user()->is_affiliate == 1) OR Auth::user()->group_id == 3 OR Auth::user()->group_id == 4 OR Auth::user()->group_id == 5)
        <a class="dropdown-item" href="{{url('account/analysis')}}">{{trans('website.Analysis')}}</a>
        @endif
        <a class="dropdown-item" href="{{url('account/myCourses')}}">{{trans('website.My Courses')}}</a>
        <a class="dropdown-item" href="{{url('account/myCertificates')}}">{{trans('website.My Certificates')}}</a>
        <a class="dropdown-item" href="{{url('account/myFavourites')}}">{{trans('website.My Favorite')}}</a>
        <a class="dropdown-item" href="{{url('account/edit')}}">{{trans('website.Account Settings')}}</a>

        @if((Auth::user()->group_id == 4) OR (Auth::user()->group_id == 5))
        {{--  <a class="dropdown-item" href="{{url('partnership/addCourse')}}">{{trans('partnership.Add new course')}}</a>  --}}
        <a class="dropdown-item" href="{{url('partnership/myCourses')}}">{{trans('website.My List Courses')}}</a>
        @endif
        @if((Auth::user()->group_id == 6))
        <a class="dropdown-item" href="{{url('business/home')}}">{{trans('businessdata.Dashboard')}}</a>
        @endif
        
        <a class="dropdown-item" href="{{url('events/home')}}">{{trans('eventsdata.Events Dashboard')}}</a>
        
        @if((Auth::user()->group_id == 8))
        <a class="dropdown-item" href="{{url('institution/home')}}">{{trans('institution.Institution Dashboard')}}</a>
        @endif

        @if((Auth::user()->businessdata_id))

        <a class="dropdown-item" href="{{url('business/businessCourses')}}">{{trans('courses.businessCourses')}}</a>
        @endif




        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            {{ trans('website.Sign out') }} <i class="flaticon-logout" ></i>
        </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
    </div>