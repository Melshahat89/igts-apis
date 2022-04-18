<ul class="navbar-nav megamenu">
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ url('/talks/category?key=covid19') }}">{{ trans('website.COVID-19') }}</a>
    </li> --}}
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/') }}">{{ trans('website.home') }}</a>
    </li>
    <li class="nav-item dropdown">
        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ trans('website.Courses Menu') }} <b class="caret"></b>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            @foreach(menuCategories() as $cat)
                    <a href="{{url('/courses/category?category='.$cat->slug)}}" class="dropdown-item" >
                            {{ $cat->name_lang }}
                    </a>
            @endforeach
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ trans('website.Talks Menu') }} <b class="caret"></b>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            @foreach(menuCategories() as $cat)
                    <a href="{{url('/talks/category?category='.$cat->slug)}}" class="dropdown-item" >
                            {{ $cat->name_lang }}
                    </a>
            @endforeach
        </div>
    </li>
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ url('/talks/category') }}">{{ trans('website.Talks Menu') }}</a>
    </li> --}}
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/partnership') }}">{{ trans('partnership.partnership') }}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="https://blog.meduo.net/">{{ trans('website.Blog') }}</a>
    </li>

    <li class="nav-item">
        <a class="nav-link m-hero-cat" href="{{ url('/talks/category?key=covid19') }}">{{ trans('website.COVID-19') }}</a>
    </li>

    {{--  <li class="nav-item">
        <a class="nav-link" href="{{ url('/instructors/All') }}">{{ trans('website.Instructors') }}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/contact') }}">{{ trans('website.Contact') }}</a>
    </li>  --}}
</ul>