@extends(layoutExtend('website'))
@section('title')
    {{  ($homesettings->seo_title_lang) ? $homesettings->seo_title_lang : trans('home.HomeTitle') }}
@endsection
@section('description')
    {{ ($homesettings->seo_desc_lang) ? $homesettings->seo_desc_lang : trans('website.Footer IGTS') }}
@endsection
@section('keywords')
    {{ ($homesettings->seo_keys) ? extractSeoKeys($homesettings->seo_keys) : '' }}
@endsection

@push('js')
<script src="{{ asset('public/old') }}/js/front/social.js"></script>
@endpush
  @section('content')

  
<div class="cat-list">
    <div class="container">
         <div class="owl-carousel">
            @foreach(menuCategories() as $cat)
                    <div>
                        <a href="{{url('/talks/category?category='.$cat->slug)}}" >
                            <i class="hero-icons {{ $cat->class }}" ></i>
                            <span>{{ $cat->name_lang }}</span>
                        </a>
                    </div>
            @endforeach
        </div>
    </div>
</div>

<div class="page-title general-gred">
    <div class="container">
        <h1 class="mt-20 mb-20">
            {{ (isset($category))?$category->name_lang:'' }}</h1>
    </div>
</div>

<section class="course-list">
    <div class="container">
        <div class="row">
            <div class="col-md-3 hide-desk hide-tablet show-mobile filters p-0 isDown" id="filterhideshow">
                <div class="filter-title flexBetween">
                    <i class="fliter-ico mr-10"></i>
                    <button onclick="resetFilter()" class="add-to-cart">
                        {{ trans('website.Reset Filter') }}
                    </button>
                </div>
            </div>
            <div class="col-md-3 hide-mobile show-tablet filters p-0">
                <div class="filter-title  flexBetween">
                    <i class="fliter-ico mr-10"></i>
                    <button onclick="resetFilter()" class="add-to-cart">
                        {{ trans('website.Reset Filter') }}
                    </button>
                </div>
                <div class="filter-title">
                    <h6 class="mb-10"> {{ trans('website.Ratings') }}</h6>
                    <div class="rating-filter">
                        <div class="form-check">
                            <input class="form-check-input" onclick="myFilter('rating=5')" <?= ($rating == 5) ?'checked':'' ?> type="radio" name="" id="gridRadios1" value="option1">
                            <label class="form-check-label" for="gridRadios1">
                                <div class="card-rating">
                                    <i class="star-rating checked"></i>
                                    <i class="star-rating checked"></i>
                                    <i class="star-rating checked"></i>
                                    <i class="star-rating checked"></i>
                                    <i class="star-rating checked"></i>
                                    <span>5.0</span>
                                </div>

                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input"  onclick="myFilter('rating=4')" <?= ($rating == 4) ?'checked':'' ?> type="radio" name="" id="gridRadios2" value="option2" >
                            <label class="form-check-label" for="gridRadios2">
                                <div class="card-rating">
                                    <i class="star-rating checked"></i>
                                    <i class="star-rating checked"></i>
                                    <i class="star-rating checked"></i>
                                    <i class="star-rating checked"></i>
                                    <i class="star-rating "></i>
                                    <span>4.0</span>
                                </div>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input"  onclick="myFilter('rating=3')" <?= ($rating == 3) ?'checked':'' ?> type="radio"  id="gridRadios3" value="option3">
                            <label class="form-check-label" for="gridRadios3">
                                <div class="card-rating">
                                    <i class="star-rating checked"></i>
                                    <i class="star-rating checked"></i>
                                    <i class="star-rating checked"></i>
                                    <i class="star-rating "></i>
                                    <i class="star-rating "></i>
                                    <span>3.0</span>
                                </div>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input"  onclick="myFilter('rating=2')" <?= ($rating == 2) ?'checked':'' ?>  type="radio"  id="gridRadios4" value="option4">
                            <label class="form-check-label" for="gridRadios4">
                                <div class="card-rating">
                                    <i class="star-rating checked"></i>
                                    <i class="star-rating checked"></i>
                                    <i class="star-rating "></i>
                                    <i class="star-rating "></i>
                                    <i class="star-rating "></i>
                                    <span>2.0</span>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                


            </div>

            <div class="col-md-3 hide-desk hide-tablet  show-mobile mobile-filter filters p-0">
                <div class="filter-title hide-mobile show-tablet flexBetween">
                    <i class="fliter-ico mr-10"></i>
                    <button onclick="resetFilter()" class="add-to-cart">
                        {{ trans('website.Reset Filter') }}
                    </button>
                </div>
                <div class="filter-title">
                    <div id="">
                        <a id="filterhideshow2"  href="" class="flexRight">X</a>
                    </div>
                    <h6 class="mb-10">{{ trans('website.Ratings') }}</h6>
                    <div class="rating-filter">

                        <div class="form-check">
                            <input class="form-check-input" type="radio"  onclick="myFilter('rating=5')" <?= ($rating == 5) ?'checked':'' ?>  id="gridRadios1" value="option1" >
                            <label class="form-check-label" for="gridRadios1">
                                <div class="card-rating">
                                    <i class="star-rating checked"></i>
                                    <i class="star-rating checked"></i>
                                    <i class="star-rating checked"></i>
                                    <i class="star-rating checked"></i>
                                    <i class="star-rating checked"></i>
                                    <span>5.0</span>
                                </div>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input"  onclick="myFilter('rating=4')" <?= ($rating == 4) ?'checked':'' ?> type="radio"  id="gridRadios2" value="option2" >
                            <label class="form-check-label" for="gridRadios2">
                                <div class="card-rating">
                                    <i class="star-rating checked"></i>
                                    <i class="star-rating checked"></i>
                                    <i class="star-rating checked"></i>
                                    <i class="star-rating checked"></i>
                                    <i class="star-rating "></i>
                                    <span>4.0</span>
                                </div>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input"  onclick="myFilter('rating=3')" <?= ($rating == 3) ?'checked':'' ?> type="radio"  id="gridRadios3" value="option3">
                            <label class="form-check-label" for="gridRadios3">
                                <div class="card-rating">
                                    <i class="star-rating checked"></i>
                                    <i class="star-rating checked"></i>
                                    <i class="star-rating checked"></i>
                                    <i class="star-rating "></i>
                                    <i class="star-rating "></i>
                                    <span>3.0</span>
                                </div>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input"  onclick="myFilter('rating=2')" <?= ($rating == 2) ?'checked':'' ?> type="radio"  id="gridRadios4" value="option4">
                            <label class="form-check-label" for="gridRadios4">
                                <div class="card-rating">
                                    <i class="star-rating checked"></i>
                                    <i class="star-rating checked"></i>
                                    <i class="star-rating "></i>
                                    <i class="star-rating "></i>
                                    <i class="star-rating "></i>
                                    <span>2.0</span>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                

            </div>


            <div class="col-md-9 mt-25">

                {{--  @if (count($mostViewedPerCategory) > 0 )   --}}
                    {{--  <section class="global-cards">  --}}
                        {{--  @if(isset($key))  --}}
                            {{--  <h3 class="mb-20">{{ trans('website.Search Result') }} : {{count($items)  }}</h3>  --}}
                        {{--  @else  --}}
                            {{--  <h3 class="mb-20"><strong> {{ trans('courses.Most Popular') }} </strong></h3>  --}}
                            {{--  <div class="owl-carousel">  --}}

                                {{-- @isset($category) --}}
                                    {{--  @foreach ($mostViewedPerCategory as $data)  --}}
                                        {{--  @include('website.talks.assets.mostViewedItem', ["data" => $data])  --}}
                                    {{--  @endforeach  --}}
                                {{-- @endisset --}}
                            {{--  </div>  --}}
                        {{--  @endif  --}}
                    {{--  </section>  --}}
                {{--  @endif  --}}

@php

    $widBundles = (count($Bundles) > 0) ? 1 : 0;
    $widMasters = (count($Masters) > 0) ? 1 : 0;
    $widEvents = (count($Events) > 0) ? 1 : 0;


    //$sum  = $HomeSettings['bundles'] + $HomeSettings['featured_courses'] + $HomeSettings['talks'] + $HomeSettings['masters'] + $HomeSettings['events'];

    $sum = $widBundles + $widMasters + $widEvents;

    switch ($sum) {
        case 1:
            $percentage = '50';
            break;
        case 2:
            $percentage = '55';
            break;
        case 3:
            $percentage = '60';
            break;
        default:
            $percentage = '35';
    }
@endphp


                <div class="tabs-container">
                    <ul class="nav nav-pills flexBetween custom-tab" id="pills-tab" role="tablist" style="width: {{($percentage) ? $percentage:35 }}% ">
                        <li class="nav-item">
                            <a class="nav-link " onclick="redirectCourse()" href="#" > {{ trans('website.Courses') }} </a>
                        </li>

                        @if(count($Bundles) > 0)
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="redirectBundles()"> {{ trans('website.Bundles') }}</a>
                        </li>
                        @endif

                        @if(count($Events) > 0)
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="redirectEvents()"> {{ trans('website.events') }}</a>
                        </li>
                        @endif

                        <li class="nav-item">
                            <a class="nav-link active"  href="#"> {{ trans('website.Free Talks') }}</a>
                        </li>

                        @if(count($Masters) > 0)
                        <li class="nav-item">
                            <a class="nav-link " href="#"> {{ trans('website.Masters') }}</a>
                        </li>
                        @endif
                    </ul>

                </div>


                @isset($items)
                    @if(count($items) >0 )
                        
                            <section class="list-courses mt-40">
                                <h3 class="mb-20"><strong>
                                    {{ trans('website.Talks') }}</strong></h3>

                                    <div id="categoryList" class="list-view">
                                        <div class="course_card_list">
                                            @foreach($items as $key => $value)
                                                    @include('website.talks.assets.talkCardList', ["data" => $value])
                                            @endforeach
                                        </div>
                                        <div class="global-pagenation flexBetween">
                                            {{--  {{ $items->links('pagination::meduo-pagination') }}  --}}

                                            @if($items instanceof \Illuminate\Pagination\LengthAwarePaginator )

                                        {{$items->appends(request()->input())->links('pagination::meduo-pagination') }}
                                    

                                        @endif
                                        </div>
                                    </div>
                            </section> 
                    @endif
                @endisset
            </div>
        </div>
    </div>
    </div>
    
    
    
</section>
<script src="{{ asset('public/meduo') }}/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
    function myFilter($link){

        var url_string = window.location.href; //window.location.href
        var url = new URL(url_string);
        var c = url.searchParams.toString();


        // if(url_string.includes(c)){
        //     //window.open(url);
        //
        // }else {
            window.open("{{ url('/talks/category') }}?"+c+"&"+$link, "_top");
        //
        // }
        // location.reload()
    };
    function redirectTalks(){

        var url_string = window.location.href; //window.location.href
        var url = new URL(url_string);
        var c = url.searchParams.toString();
        console.log(c);

        window.open("{{ url('/talks/category') }}?"+c, "_top");
        // location.reload()
    }

    function redirectBundles(){
        var url_string = window.location.href; //window.location.href
        var url = new URL(url_string);
        var c = url.searchParams.toString();
        console.log(c);

        window.open("{{ url('/bundles/category') }}?"+c, "_top");
    }
    function redirectEvents(){
        var url_string = window.location.href; //window.location.href
        var url = new URL(url_string);
        var c = url.searchParams.toString();
        console.log(c);

        window.open("{{ url('/events/category') }}?"+c, "_top");
    }
    function redirectCourse(){

        var url_string = window.location.href; //window.location.href
        var url = new URL(url_string);
        var c = url.searchParams.toString();
        console.log(c);

        window.open("{{ url('/courses/category') }}?"+c, "_top");
        // location.reload()
    }

    $(document).ready(function(){

    });

</script>
<script type="text/javascript">
    function resetFilter(){
        window.open("{{ url('/talks/category') }}" , "_top");
        };
</script>
@endsection
