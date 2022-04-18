@extends(layoutExtend('website'))
@section('title')
    {{ trans('home.HomeTitle') }}
@endsection
@section('description')
    {{ trans('home.HomeDescription') }}
@endsection
@section('keywords')
    {{ trans('home.HomeKeywords') }}
@endsection
@section('content')


<link rel="preload" href="{{ asset('public/website') }}/css/front/main_v2d3cb.css?v=9.2" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="{{ asset('public/website') }}/css/front/main_v2d3cb.css?v=9.2"></noscript>
        

<div class="outer-wrap modified-home">
    <section class="two-columns-wide-outer viewport">
        <div class="two-columns-wide-wrapper wrapper">
            <div class="row columns-wrapper">
                <div class="home-left-column col-md-6 match-height">
<div class="home-left-column-insert text-center">
                        <?php if(isset($sliderItems) && !empty($sliderItems->title) ) { ?>
                            <h2><?= $sliderItems->title; ?></h2>
                        <?php } else { ?>
                            <h2>{{trans('home.IGTS')}}</h2>
                        <?php } ?>

                        <div class="clearfix"></div>
                         </div>
                </div>
                <div class="home-right-column col-md-6 match-height text-center">
                    <div class="home-right-column-insert">
                        <div class="row">
                            <div class="categories-gradient"></div>
                            <div class="text-center home-column-category-item">
                                <div class="card">
                                    <a href="/diplomas/category" id="header_category_1">
                                        <div class="front item {{($diplomas_discount) ? 'promoted' : ''}}" data-awards="{{($diplomas_discount) ? $diplomas_discount . '%' : ''}} {{trans('home.discount')}}">
<!--                                            <span class="home-cat-icon technology-color icon-category-it"></span>-->
                                            <i class="fas fa-chalkboard-teacher"></i>
                                            <p class="home-category-heading">{{trans('home.diplomas')}}</p>
                                            <div class="border technology-color"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="text-center home-column-category-item">
                                <div class="card">
                                    <a href="/courses/category" id="header_category_2">
                                    <div class="front item {{($courses_discount) ? 'promoted' : ''}}" data-awards="{{($courses_discount) ? $courses_discount . '%' : ''}} {{trans('home.discount')}}">
<!--                                            <span class="home-cat-icon languages-color icon-category-language"></span>-->
                                            <i class="fas fa-user-md"></i>
                                            <p class="home-category-heading">{{trans('home.courses')}}</p>
                                            <div class="border languages-color"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="text-center home-column-category-item">
                                <div class="card">
                                    <a href="/masters/category" id="header_category_3">
<!--                                        <div class="front  item promoted">-->
                                            <div class="front item {{($masters_discount) ? 'promoted' : ''}}" data-awards="{{($masters_discount) ? $masters_discount . '%' : ''}} {{trans('home.discount')}}">
<!--                                            <span class="home-cat-icon science-color icon-category-science"></span>-->
                                            <i class="fas fa-user-graduate"></i>
                                            <p class="home-category-heading">{{trans('home.masters')}}</p>
                                            <div class="border science-color"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="text-center home-column-category-item">
                                <div class="card">
                                    <a href="/bundles/category" id="header_category_4">
                                    <div class="front item {{($bundle_discount) ? 'promoted' : ''}}" data-awards="{{($bundle_discount) ? $bundle_discount . '%' : ''}} {{trans('home.discount')}}">
<!--                                            <span class="home-cat-icon health-color icon-category-health"></span>-->
                                            <i class="fas fa-heartbeat"></i>
                                            <p class="home-category-heading">{{trans('home.bundles')}}</p>
                                            <div class="border health-color"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<main class="main_content">

@if($featuredAll && count($featuredAll) > 0)

    {{--    Best Learning Experience Section  --}}

    <section class="sec sec_pad_top bg_gradient_home mtxs" style="direction: rtl;">
    <div class="section_image_overlay"></div>
    <div class="wrapper">
        <div class="row">
        <div class="col-md-4 text-center align-self-center">
                <div class="">
                    <h3 class="mbmd" style="color: #FFF;font-weight: bold;">{{trans('home.best learning')}}</h3>
                </div>
            </div>
            <div class="col-md-8">
                <div id="bestLearning">
                    <div class="owl-carousel owl-theme bestLearning">
                        @foreach($featuredAll as $featuredAll1)
                            @include(sectionBestLearning('website'), ['data' => $featuredAll1]) 
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>

@endif

{{--
@foreach($coursesPerCategory as $category)

    @if(count($category) > 0)
        <section class="sec sec_pad_top sec_pad_bottom bg_white ">
            <div class="wrapper">
                <section class="title mblg">
                    <h2 class="text_primary text_capitalize">{{$category[0]->categories->name_lang}}</h2>
                    <!-- <div class="actions">
                        <a href="/courses/category/masters" class="button button_primary button_small text_capitalize" type="button" role="button">{{trans('home.view all')}}</a>
                    </div> -->
                </section>

                <div id="latestCourses">
                    <div class="owl-carousel owl-theme latestCourses">
                        
                        @foreach($category as $course)
                            @include(sectionMasterCourses('website'), ['data' => $course]) 
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </section>
    @endif
   
@endforeach
--}}


@if($latestReleased)
        <section class="sec sec_pad_top sec_pad_bottom bg_lightgray ">
            <div class="wrapper">
                <section class="title mblg">
                    <h2 class="text_primary text_capitalize">{{trans('home.latest courses')}}</h2>
                    <!-- <div class="actions">
                        <a href="/courses/category/masters" class="button button_primary button_small text_capitalize" type="button" role="button">{{trans('home.view all')}}</a>
                    </div> -->
                </section>

                <div id="latestCourses">
                    <div class="owl-carousel owl-theme latestCourses">
                        
                        @foreach ($latestReleased as $latestRelease)
                            @include(sectionMasterCourses('website'), ['data' => $latestRelease]) 
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </section>
@endif

@if($featuredDiplomas && count($featuredDiplomas) > 0)
        <section class="sec sec_pad_top sec_pad_bottom bg_white ">
            <div class="wrapper">
                <section class="title mblg">
                    <h2 class="text_primary text_capitalize">{{trans('home.diplomas')}}</h2>
                    <div class="actions">
                        <a href="/diplomas/category" class="button button_primary button_small text_capitalize" type="button" role="button">{{trans('home.view all')}}</a>
                    </div> 
                </section>

                <div id="diplomas">
                    <div class="owl-carousel owl-theme diplomas" >
                        
                        @foreach ($featuredDiplomas as $featuredDiploma)
                            @include(sectionMasterCourses('website'), ['data' => $featuredDiploma]) 
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </section>
@endif

@if($featuredCourses && count($featuredCourses) > 0)
        <section class="sec sec_pad_top sec_pad_bottom bg_lightgray ">
            <div class="wrapper">
                <section class="title mblg">
                    <h2 class="text_primary text_capitalize">{{trans('home.courses')}}</h2>
                    <div class="actions">
                        <a href="/courses/category" class="button button_primary button_small text_capitalize" type="button" role="button">{{trans('home.view all')}}</a>
                    </div>
                </section>

                <div id="courses">
                    <div class="owl-carousel owl-theme courses" >
                        
                        @foreach ($featuredCourses as $featuredCourse)
                            @include(sectionMasterCourses('website'), ['data' => $featuredCourse]) 
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </section>
@endif

@if($featuredMasters && count($featuredMasters) > 0)
        <section class="sec sec_pad_top sec_pad_bottom bg_white ">
            <div class="wrapper">
                <section class="title mblg">
                    <h2 class="text_primary text_capitalize">{{trans('home.masters')}}</h2>
                    <div class="actions">
                        <a href="/masters/category" class="button button_primary button_small text_capitalize" type="button" role="button">{{trans('home.view all')}}</a>
                    </div>
                </section>

                <div id="masters">
                    <div class="owl-carousel owl-theme masters" >
                        
                        @foreach ($featuredMasters as $featuredMaster)
                            @include(sectionMasterCourses('website'), ['data' => $featuredMaster]) 
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </section>
@endif

@if($bundleCourses && count($bundleCourses) > 0)
        <section class="sec sec_pad_top sec_pad_bottom bg_lightgray ">
            <div class="wrapper">
                <section class="title mblg">
                    <h2 class="text_primary text_capitalize">{{trans('home.bundles')}}</h2>
                    <div class="actions">
                        <a href="/bundles/category" class="button button_primary button_small text_capitalize" type="button" role="button">{{trans('home.view all')}}</a>
                    </div>
                </section>

                <div id="bundles">
                    <div class="owl-carousel owl-theme bundles">
                        @foreach ($bundleCourses as $bundleCourse)
                            @include(sectionMasterCourses('website'), ['data' => $bundleCourse]) 
                        @endforeach
                    </div>
                </div>

            </div>
        </section>
@endif

@if($instructors && count($instructors) > 0)
    <section class="sec sec_pad_top sec_pad_bottom bg_white">
        <div class="wrapper">
            <section class="title mblg">
                <h2 class="text_primary text_capitalize">{{trans('home.instructors')}}</h2>
                <div class="actions">
                    <a href="/instructors/All" class="button button_primary button_small text_capitalize" type="button" role="button">{{trans('home.view all')}}</a>
                </div>
            </section>

            <div id="instructors">
                <div class="owl-carousel owl-theme instructors">
                    
                    @foreach ($instructors as $instructor)
                        @include(sectionHomeInstructors('website'), ['data' => $instructor]) 
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif


@if(!$testimonials && count($testimonials) > 0)
    <section class="sec sec_pad_top sec_pad_bottom bg_lightgray">
        <div class="wrapper">
            <section class="title mblg">
                <h2 class="text_primary text_capitalize">{{trans('home.customer reviews')}}</h2>
            </section>

                
                    <div class="row_nm_videos">

            @foreach($testimonials as $testimonial)

            <div class="row__inner">
                <div class="tile" id="facebook_1">
                    <div class="tile__media">

                    <iframe width="250" height="140" src="{{$testimonial->title_en}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>                    </div>
                    <div class="tile__details">
                        <div class="tile__title">
                        </div>
                    </div>
                </div>
                
                </div>
                @endforeach

        </div>

    </div>

            
        
    </section>
@endif

</main>

        
    {{--    Partners Section  --}}
    {{-- @include(sectionPartnerCards('website'), ['Data' => $PartnerCards]) --}}

    {{--    Instructors Section  --}}
    {{-- @include(sectionInstructors('website'), ['Data' => $Instructors]) --}}

    {{--    Partners Section  --}}
    {{-- @include(sectionPartners('website'), ['Data' => $Partners]) --}}

    {{--    Testimonials Section  --}}
    {{-- @include(sectionTestimonials('website'), ['Data' => $Testimonials]) --}}

@endsection