@php
use App\Application\Model\Courses;
use App\Application\Model\User;

@endphp

@extends(layoutExtend('website'))
@section('title')
{{$course->title_lang}} - {{ trans('home.IGTS') }}
@endsection
@section('description')
{{ ($course->seo_desc) ? $course->seo_desc_lang : $course->description_lang }}
@endsection
@section('keywords')
{{ ($course->seo_keys) ? extractSeoKeys($course->seo_keys) : defaultSeoKeys($course->title_lang) }}
@endsection

@push('js')
<script src="{{asset('public/website')}}/js/courses.js?v=2"></script>
<script src="{{asset('public/website')}}/js/social.js?v=2"></script>
@endpush
@section('content')


<div class="bread-crumb">
    <div class="wrapper">
        <a href="/{{getCourseTypeText($course)}}/category/<?= $course->categories->slug ?>"><?=  $course->categories->name_lang ?> </a> > <span><?= $course->title_lang ?></span>
    </div>
</div>

<main class="main_content">
    <div class="course_detail" id="course_detail">
        <section class="bb course_detail_header">
            <div class="video_wrapper">
                <div>
                    @if($course->type != Courses::TYPE_BUNDLES && $course->type != Courses::TYPE_MASTERS)
                        {{-- <div class="user_name">

                            @if($course->instructor->image)
                                <img src="{{ large1($course->instructor->image) }}" style="height: 40px;">
                            @endif
                            &nbsp;  {{$course->instructor->Fullname_lang}}
                        </div> --}}
                    @endif
                    <div class="course_detail_title mbsm"><h1>{{ $course->title_lang }}</h1>
                    
                    <p class="d-none">{{ $course->title_ar }}</p>
                    
                    </div>
                    <div class="course_detail_sub_info mbmd">
                        <strong>

                        </strong>
                    </div>

                    <div class="course_detail_rating mbsm {{isMobile() ? 'd-flex justify-content-between' : ''}}">
                        <div class="jq_rating jq-stars" data-options='{"initialRating":{{$course->CourseRating}}, "readOnly":true, "starSize":19}'></div>
                        <span>{{ round($course->CourseRating, 1) }} ( {{ $course->CourseCountRating}} {{trans('courses.ratings')}} )</span>
                        <div class="show-mobile d-none">
                        @if(Auth::check())
                            <a href="/courses/toggleFavourite/id/{{$course->id}}" class=" button button_primary_reverse button_large add_wishlist <?= ($wishListed) ? 'active' :  '' ?>"  data-course-id="{{$course->id}}">
                        @else
                            <a href="javascript:void(0)" data-dismiss="modal" data-remote="/login" data-toggle="modal" data-target="#loginModal" class="button button_primary_reverse button_large">
                        @endif
                                <i class="far fa-heart"></i>
                            </a>
                        </div>
                    </div>

                    
                    @if($course->type == Courses::TYPE_WEBINAR)
                        <h3>{{ localizeDate($course->start_date) }}</h3>
                        <br>
                        <p>({{trans('courses.egypt')}}) @php $datetime = new DateTime($course->start_date); @endphp {{ $datetime->format('h:i A') }}</p>
                        <p>({{trans('courses.ksa')}}) @php $datetime = new DateTime($course->start_date); $datetime->add(new DateInterval('PT1H')); @endphp {{ $datetime->format('h:i A') }}</p>

                    @else

                    <h3>{!! $course->PriceText !!}</h3>
                                        
                    @endif

                        @if($course->course_hubspot_form)
                            <br>
                            <h2 class="text_primary text_capitalize">معتمدة بـ 10 CME</h2>
                        @endif

                    <div class="course_price_actions mtmd">
                        <div class="course_ad_to_cart hide-mobile">
                            @if(!$shoppingCart && !$enrolled)
                                @if(Auth::check())

                                    @if($course->type == Courses::TYPE_WEBINAR)
                                        @if(getEventStatus($course) == "passed")
                                            <a href="javascript:void(0)" class="button button_primary button_large add_cart" style="background-color: #cf2626;">
                                            {{ trans('courses.This Webinar Has Ended') }}
                                            </a>
                                        @else
                                            <a href="/site/enrollWebinar/{{$course->id}}" class="button button_primary button_large add_cart">
                                            {{ trans('courses.Watch This Webinar') }}
                                            </a>
                                        @endif
                                    @else

                                        @if(count($course->certificatesContainer) > 0)
                                            <a href="javascript:void(0)"  onclick="loadModal('/courses/certificatesContainer/id/', {{$course->id}})" data-toggle="modal" data-target="#exampleModal" class="button button_primary button_large add_cart track" data-course-id="{{$course->id}}">
                                                <i class="fas fa-cart-plus track"></i>
                                            </a>
                                        @else
                                            <a href="/courses/addToCart/id/{{$course->id}}" class="button button_primary button_large add_cart track" data-course-id="{{$course->id}}">
                                                <i class="fas fa-cart-plus track"></i>
                                            </a>
                                        @endif
                                        
                                    @endif

                                @else

                                    @if($course->type == Courses::TYPE_WEBINAR)
                                        @if(getEventStatus($course) == "passed")
                                            <a href="javascript:void(0)" class="button button_primary button_large add_cart" style="background-color: #cf2626;">
                                                {{ trans('courses.This Webinar Has Ended') }}
                                            </a>
                                        @else
                                            <a href="javascript:void(0)" data-dismiss="modal" data-remote="/login" data-toggle="modal" data-target="#loginModal" class="button button_primary button_large">
                                               {{ trans('courses.Sign in to join this webinar') }}
                                            </a>
                                        @endif

                                    @else
                                        <a href="javascript:void(0)" data-dismiss="modal" data-remote="/login" data-toggle="modal" data-target="#loginModal" class="button button_primary button_large">
                                            <i class="fas fa-cart-plus"></i>
                                        </a>
                                    @endif

                                @endif
                            @endif

                            @if($enrolled && $course->type == Courses::TYPE_WEBINAR)

                                @if(getEventStatus($course) == "passed")
                                    <a href="javascript:void(0)" class="button button_primary button_large add_cart" style="background-color: #cf2626;">
                                        {{ trans('courses.This Webinar Has Ended') }}
                                    </a>
                                @else
                                    <a href="{{($course->webinar_url) ? $course->webinar_url : 'javascript:void(0)'}}" target="_blank" class="button button_primary button_large add_cart">
                                        {{ trans('courses.Watch This Webinar') }}
                                    </a>
                                @endif

                            @endif

                            <a href="/cart" class="button button_primary button_large go_to_cart" style="<?= (!$shoppingCart) ? 'display:none' : '' ?>">
                                ابدأ التعلم الآن
                            </a>



                            @if(Auth::check())
                                <a href="/courses/toggleFavourite/id/{{$course->id}}" class=" button button_primary_reverse button_large add_wishlist <?= ($wishListed) ? 'active' :  '' ?>"  data-course-id="{{$course->id}}">
                            @else
                                <a href="javascript:void(0)" data-dismiss="modal" data-remote="/login" data-toggle="modal" data-target="#loginModal" class="button button_primary_reverse button_large">
                            @endif
                                    <i class="far fa-heart"></i>
                                </a>
                                
                        </div>

                        
                        @if($course->type != Courses::TYPE_WEBINAR)
                        <p class="pt-4">
                            {{trans('courses.add coupon code in cart')}}
                        </p>
                        @endif

                        
                        {{-- <div class="mtlg">
                            <div class="socials" style="height: 50px;">
                                <span>{{trans('courses.share on')}}</span>
                                <!-- ShareThis BEGIN -->
                                <div class="sharethis-inline-share-buttons" style="z-index: 0;"></div>
                                    <!-- ShareThis END -->
                                <!-- <div class="sharethis-inline-share-buttons"></div> -->
                            </div>
                        </div> --}}

                    </div>
                </div>

                @if($course->type == Courses::TYPE_WEBINAR)
                    <div>
                        <div class="flowplayer-embed-container">
                            <img src="{{ large1($course->image) }}" style="height: 600px; width: 100%; object-fit: contain;" class="webinar-poster">
                        </div>
                    </div>
                @else

                    <div>
                        <div class="flowplayer-embed-container" style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width:100%;">

                            @if($course->promo_video)
                                <iframe style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" webkitAllowFullScreen mozallowfullscreen allowfullscreen src="https://player.vimeo.com/video/{{ $course->promo_video }}" title="0" byline="0" portrait="0" width="640" height="360" frameborder="0" allow="autoplay"></iframe>
                            @else
                                <img src="{{ large1($course->image) }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: contain;">
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </section>

        <nav class="course_detail_nav" data-sticky="nav" data-plugin-option='{"offset_top":59, "parent": "#course_detail"}'>
            <div class="wrapper">
                <ul>
                    @if($course->targetstudents_lang)
                        <li><a class="smooth_scroll" href="#target_students_section">{{trans('courses.target_students')}}</a></li>
                    @endif
                    @if($course->description_lang)
                        <li><a class="smooth_scroll" href="#nav_course_gools">{{trans('courses.course description head')}}</a></li>
                    @endif
                    @if($course->willlearn_lang)
                        <li><a class="smooth_scroll" href="#will_learn_section">{{trans('courses.You Will Learn')}}</a></li>
                    @endif
                    @if($course->dynamicfields)
                                
                        @foreach($course->dynamicfields as $field)
                            <li><a class="smooth_scroll" href="#{{$field->name}}">{{$field->title_lang}}</a></li>
                        @endforeach
                        
                    @endif
                    @if($course->requirments_lang)
                        <li><a class="smooth_scroll" href="#requirements_section">{{trans('courses.Requirments')}}</a></li>
                    @endif
                    {{-- <li><a class="smooth_scroll" href="#instructors_section">{{trans('home.instructors')}}</a></li> --}}
                    @if($course->coursesections)
                        <li><a class="smooth_scroll" href="#nav_course_list">{{trans('courses.lectures')}}</a></li>
                    @endif
                    @if($enrolled  && !empty($course->resources) )
                        <li><a class="smooth_scroll" href="#nav_course_resource">{{trans('courses.course resources head')}}</a></li>
                    @endif
                       
                    @if($course->course_hubspot_form)
                        <li><a class="smooth_scroll" href="#cme_section">{{trans('courses.course cme form head')}}</a></li>
                    @endif
                    @if($course->CourseRating > 0)
                        <li><a class="smooth_scroll" href="#nav_course_reviews">{{trans('courses.course rating and reviews head')}}</a></li>
                    @endif
                    <li><a class="smooth_scroll" href="#learning-adv-section">{{trans('courses.learning benefits')}}</a></li>
                </ul>
            </div>
        </nav>

        <div class="course_detail_nav_tabs bg_lightgray">
            <!-- course_streamer -->
            <!-- <section class="course_streamer streamer_fixed" id="course_detail_streamer">
                <div class="wrapper">
                    <div class="section_shrank">
                        <div class="title">{{ $course->title_lang }}</div>

                        <div class="course_streamer_rating">
                            @if($course->CourseRating > 0)
                                <div class="jq_rating jq-stars" data-options='{"initialRating":{{$course->CourseRating}}, "readOnly":true, "starSize":19}'></div>
                            @endif
                            <div class="course_detail_watched_number">{{trans('courses.price')}}
                                <span>&nbsp;&nbsp;{!! $course->PriceText !!}</span>
                                <a href="/cart" class="button button_primary button_large go_to_cart" style="<?php //if(!$shoppingCart){ echo "display:none;";}?>" >
                                    {{trans('courses.start learning now')}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section> -->
            <!-- end course_streamer -->

            <section class="sec sec_pad_top_sm sec_pad_bottom_sm">
                <div class="wrapper">
                    <div class="course_detail_content">
                        <!--DESKTOP course_column_info -->
                        <div class="course_column_info is_stuck col-md-4 hide-mobile" data-sticky="nav" data-plugin-option='{"offset_top":130}' style="position: unset;">
                            @if($course->type != Courses::TYPE_WEBINAR)
                                <div class="b_all">
                                    <h3>
                                        <div class="course_price">
                                            {!! $course->PriceText !!}                                  
                                        </div>
                                    </h3>
                                    <div class="share_course text_center bt pbsm">
                                        <div class="socials" style="height: 50px;">
                                            <span><small>{{trans('courses.share on')}}</small></span>
                                            <!-- ShareThis BEGIN -->
                                            <div class="sharethis-inline-share-buttons" style="z-index: 0;"></div>
                                            <!-- ShareThis END -->
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="course_column_info_inner mtxs b_all">
                                <div class="about_auther">
                                    <h3 class="text_primary mblg text_capitalize">{{trans('courses.about instructor')}}</h3>
                                    <figure class="mbsm">
                                        <a href="/instructors/view/{{$course->instructor->slug}}">
                                            
                                            @if($course->instructor->image)
                                                <img src="{{large1($course->instructor->image)}}" style="width: 100px;">
                                            @endif
                                        </a>
                                    </figure>
                                    <div class="auther_name mbmd">
                                        <h5 class="mbxs"><a href="/instructors/view/{{$course->instructor->slug}}">{{$course->instructor->Fullname_lang}}</a></h5>
                                        <span class="auther_title">{{$course->instructor->title_lang}}</span>
                                    </div>
                                    <div>{!!$course->instructor->about_lang!!}</div>
                                </div>
                            </div>

                            @if($enrolled && $course->type != Courses::TYPE_WEBINAR && isset($course->quiz))
                                <div class="course_column_info_inner mtxs b_all">
                                    <div class="about_auther">
                                        <a href="/courses/startExam/{{$course->slug}}" class="button button_primary button_shadow">{{trans('courses.start exam')}}</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <!-- end course_column_info -->

                        <!-- course_detail_content -->
                        <div class="col-md-8">
                            @if($course->type == Courses::TYPE_WEBINAR && $enrolled)
                                @if(getEventStatus($course) == "passed")
                                    <section class="title mbmd" id="target_students_section">
                                        <h2 class="text_primary text_capitalize">{{trans('courses.Event Certificate')}}</h2>
                                    </section>
                                    @if(isset($enrollment->certificate))
                                        <div class="certificate_list">
                                            <div class="item">
                                                <div>
                                                    <span class="item_icon text_primary"><i class="fas fa-certificate"></i></span>
                                                    <h5 class="item_name">{{ $course->title_lang }}</h5>
                                                </div>
                                                <div>
                                                    <a href="{{ url(env("CERTIFICATE_PATH_1")."/".$enrollment->certificate) }}" class="button button_link" target="_blank"><i class="far fa-eye"></i></a>
                                                    <a href="{{ url(env("CERTIFICATE_PATH_1")."/".$enrollment->certificate) }}" class="button button_link" target="_blank"><i class="fas fa-cloud-download-alt"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <img src="{{ asset('public/website') }}/images/igts certificate placeholder.jpg" id="webinar-certificate-placeholder">
                                        <form action="{{concatenateLangToUrl('savewebinarcertificate')}}/{{$course->id}}" method="POST">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label for="name">{{ trans('courses.Name') }}</label>
                                                <input type="text" name="name" required class="form-control" id="name" aria-describedby="nameHelp" placeholder="{{ trans('courses.Your Full Name In English') }}">
                                                <small id="nameHelp" class="form-text text-muted">{{ trans('courses.Type in the name') }} <strong>({{trans('courses.In English')}})</strong> {{ trans('courses.that you want to be shown on the certificate') }}</small>
                                            </div>
                                            <button type="submit" class="btn btn-primary">{{ trans('courses.Save') }}</button>
                                        </form>
                                    @endif
                                @endif
                            @endif

                            @if($course->targetstudents_lang)
                                <section class="title mbmd" id="target_students_section">
                                    <h2 class="text_primary text_capitalize">{{trans('courses.target_students')}}</h2>
                                </section>
                                <div class="text mbmd">{!! $course->targetstudents_lang !!}</div>                            
                            @endif

                            @if($course->description_lang)
                                <section class="sec sec_pad_top_sm sec_pad_bottom_sm" id="nav_course_gools">
                                    <div class="title mbmd">
                                        <h2 class="text_primary text_capitalize">{{trans('courses.course description content')}} {{$course->title_lang}}</h2>
                                    </div>
                                    <div class="text mbmd">{!! $course->description_lang !!}</div>
                                </section>
                            @endif

                            @if($course->willlearn_lang)
                                <section class="sec sec_pad_top_sm sec_pad_bottom_sm" id="will_learn_section">
                                    <div class="title mbmd">
                                        <h2 class="text_primary text_capitalize">{{trans('courses.You Will Learn')}}</h2>
                                    </div>
                                    <div class="text mbmd"> {!! $course->willlearn_lang !!} </div>
                                </section>
                            @endif

                            @if($course->dynamicfields)
                                @foreach($course->dynamicfields as $field)
                                    <section class="sec sec_pad_top_sm sec_pad_bottom_sm" id="{{$field->name}}">
                                        <div class="title mbmd">
                                            <h2 class="text_primary text_capitalize">{{$field->title_lang}}</h2>
                                        </div>
                                        <div class="text mbmd"> {!! $field->description_lang !!} </div>
                                    </section>
                                @endforeach
                            @endif

                            @if($course->requirments_lang)
                                <section class="sec sec_pad_top_sm sec_pad_bottom_sm" id="requirements_section">
                                    <div class="title mbmd">
                                        <h2 class="text_primary text_capitalize">{{trans('courses.Requirments')}}</h2>
                                    </div>
                                    {!! $course->requirments_lang !!}
                                </section>
                            @endif

                            {{--
                                <section class="sec sec_pad_top_sm sec_pad_bottom_sm" id="instructors_section">
                                    <div class="title mbmd">
                                        <h2 class="text_primary text_capitalize">{{trans('home.instructors')}}</h2>
                                    </div>
                                    <div class="lectures col-12">
                                        @include('website.courses.assets.instructors', ['instructor' => $course->instructor]) 
                                        @foreach(getInstructors($course) as $instructor)
                                            @include('website.courses.assets.instructors', ['instructor' => $instructor]) 
                                        @endforeach
                                    </div>
                                </section>
                            --}}

                            <section class="sec">
                                <div class="mtlg">
                                    @if($course->created_at)
                                        {{trans('courses.created at')}} {{ $course->created_at }}
                                    @endif
                                    <br>
                                    @if($course->updated_at)
                                        {{trans('courses.updated at')}} {{ $course->updated_at }}
                                    @endif
                                    <div class="socials contact_whatsapp">
                                        @if($course->type != Courses::TYPE_WEBINAR)
                                                <span class="contact_whatsapp"><h6><a href="https://igtsservice.com/contactus/index.php">{{trans('home.contact us on whatsapp')}}</a></h6></span>
                                                <a href="https://igtsservice.com/contactus/index.php" class="social_link contact_whatsapp" style="background-color: #4AC959;"><i class="fab fa-whatsapp"></i></a>
                                        @endif
                                    </div>                 
                                </div>
                            </section>

                            <!-- Course Content -->
                            @if($course->coursesections)
                                @include('website.courses.assets.courseContent', ['course' => $course, 'enrolled' => $enrolled]) 
                            @endif

                            @if($course->coursesincluded)
                                @foreach ($course->courseincludes as $course1)
                                    @if($course1->includedCourse->coursesections)
                                        @include('website.courses.assets.courseContent', ['course' => $course1->includedCourse, 'includedTitle' => $course1->included_course_title, 'enrolled' => $enrolled]) 
                                    @endif
                                @endforeach
                            @endif

                            
                            @if($enrolled)
                                @if($course->course_hubspot_form)
                                    <section id="cme_section">
                                        <header class="course_list_header">
                                            <div class="title">{{trans('courses.course cme form content')}}</div>
                                        </header>
                                        <br>
                                        <p>{{trans('courses.course cme form email')}}</p> 
                                        <br>
                                        <p class="text-center">{{Auth::user()->email}}</p>
                                        <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/shell.js"></script>
                                        <script>
                                            hbspt.forms.create({
                                                portalId: "4880007",
                                                formId: '{{ $course->course_hubspot_form }}',
                                            });
                                        </script>
                                    </section>
                                @endif
                            @endif

                            {{--
                                @if($course->type != Courses::TYPE_BUNDLES && $course->type != Courses::TYPE_MASTERS && isMobile())
                                    <div class="course_column_info">
                                        <div class="course_column_info_inner mtxs b_all">
                                            <div class="about_auther">
                                                <h3 class="text_primary mblg text_capitalize">{{trans('courses.about instructor')}}</h3>
                                                <figure class="mbsm">
                                                    <a href="/instructors/view/{{$course->instructor->slug}}">

                                                        @if($course->instructor->image)
                                                            <img src="{{ large1($course->instructor->image) }}" style="width: 100px;">
                                                        @endif
                                                    </a>
                                                </figure>
                                                <div class="auther_name mbmd">
                                                    <h5 class="mbxs"><a href="/instructors/view/{{$course->instructor->slug}}">{{$course->instructor->Fullname_lang}}</a></h5>
                                                    <span class="auther_title">{{$course->instructor->slug}}</span>
                                                </div>
                                                <div>{!! $course->instructor->about_lang !!}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            --}}

                            {{--
                                @if(isMobile())
                                    <div class="course_column_info_inner mtxs b_all">
                                        <div class="about_auther" style="text-align: center;">
                                            <h3 class="text_primary mblg text_capitalize">{{trans('courses.learning benefits')}}</h3>

                                            <ul class="learning-adv">

                                                <li>{{trans('courses.benefits-1')}}</li>
                                                <li>{{trans('courses.benefits-2')}}</li>
                                                <li>{{trans('courses.benefits-3')}}</li>
                                                <li>{{trans('courses.benefits-4')}}</li>
                                                <li>{{trans('courses.benefits-5')}}</li>
                                                <li>{{trans('courses.benefits-6')}}</li>
                                                <li>{{trans('courses.benefits-7')}}</li>
                                                <li>{{trans('courses.benefits-8')}}</li>
                                                <li>{{trans('courses.benefits-9')}}</li>
                                                <li>{{trans('courses.benefits-10')}}</li>

                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            --}}

                            <section class="sec sec_pad_top_sm sec_pad_bottom_sm" id="learning-adv-section">
                                <div class="accordion accordion_list">
                                    <div class="card">
                                        <div class="card_header">
                                            <button data-toggle="collapse" data-target="#learning-adv" aria-expanded="true" aria-controls="coll_1" class="d-flex justify-content-between" style="background-color: #244092; color: white;">
                                                <span class="card_header_title">{{trans('courses.learning benefits')}}</span>
                                                <i class="fa mr-10 fa-plus" aria-hidden="true" style="place-self: center;"></i>
                                            </button>
                                        </div>
                                        <div id="learning-adv" class="panel_collapse collapse">
                                            <div class="card_body">
                                                <div class="card p-3">
                                                    {{trans('courses.benefits-1')}}
                                                </div>
                                                <div class="card p-3">
                                                    {{trans('courses.benefits-2')}}
                                                </div>
                                                <div class="card p-3">
                                                    {{trans('courses.benefits-3')}}
                                                </div>
                                                <div class="card p-3">
                                                    {{trans('courses.benefits-4')}}
                                                </div>
                                                <div class="card p-3">
                                                    {{trans('courses.benefits-5')}}
                                                </div>
                                                <div class="card p-3">
                                                    {{trans('courses.benefits-6')}}
                                                </div>
                                                <div class="card p-3">
                                                    {{trans('courses.benefits-7')}}
                                                </div>
                                                <div class="card p-3">
                                                    {{trans('courses.benefits-8')}}
                                                </div>
                                                <div class="card p-3">
                                                    {{trans('courses.benefits-9')}}
                                                </div>
                                                <div class="card p-3">
                                                    {{trans('courses.benefits-10')}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            @if(isMobile())
                                <!--Mobile course_column_info -->
                                <div class="course_column_info">
                                    @if($course->type != Courses::TYPE_WEBINAR)
                                        <div class="b_all">
                                            <div class="share_course text_center bt pbsm">
                                                <div class="socials" style="height: 50px;">
                                                    <span><small>{{trans('courses.share on')}}</small></span>
                                                    <!-- ShareThis BEGIN -->
                                                    <div class="sharethis-inline-share-buttons" style="z-index: 0;"></div>
                                                    <!-- ShareThis END -->
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="course_column_info_inner mtxs b_all">
                                        <div class="about_auther">
                                            <h3 class="text_primary mblg text_capitalize">{{trans('courses.about instructor')}}</h3>
                                            <figure class="mbsm">
                                                <a href="/instructors/view/{{$course->instructor->slug}}">
                                                    
                                                    @if($course->instructor->image)
                                                        <img src="{{large1($course->instructor->image)}}" style="width: 100px;">
                                                    @endif
                                                </a>
                                            </figure>
                                            <div class="auther_name mbmd">
                                                <h5 class="mbxs"><a href="/instructors/view/{{$course->instructor->slug}}">{{$course->instructor->Fullname_lang}}</a></h5>
                                                <span class="auther_title">{{$course->instructor->title_lang}}</span>
                                            </div>
                                            <div>{!!$course->instructor->about_lang!!}</div>
                                        </div>
                                    </div>

                                    @if($enrolled && $course->type != Courses::TYPE_WEBINAR)
                                        @if($course->type == Courses::TYPE_BUNDLES)
                                            <div class="course_column_info_inner mtxs b_all">
                                                <div class="about_auther">
                                                    <button type="button" data-dismiss="modal" data-remote="/courses/bundleExams/{{$course->slug}}" data-toggle="ajaxModal" class="button button_primary_reverse text_capitalize">{{trans('courses.start exam')}}</button>
                                                </div>
                                            </div>
                                        @else
                                            <div class="course_column_info_inner mtxs b_all">
                                                <div class="about_auther">
                                                    <a href="/courses/startExam/{{$course->slug}}" class="button button_primary button_shadow">{{trans('courses.start exam')}}</a>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                                <!-- end course_column_info -->
                            @endif
                            <section class="sec sec_pad_top_sm sec_pad_bottom_sm" id="nav_course_reviews">
                                @if($course->CourseRating)
                                    <section class="title mbmd">
                                        <h2 class="text_primary text_capitalize">{{trans('home.customer reviews')}}</h2>
                                    </section>
                                    <div class="course_review_summary">
                                        <div class="course_review_summary_total">
                                            <div class="course_review_summary_number">{{ round($course->CourseRating, 1) }}</div>
                                            <div class="course_review_summary_rating">
                                                <div class="jq_rating jq-stars" data-options='{"initialRating":{{$course->CourseRating}}, "readOnly":true, "starSize":22}'></div>
                                            </div>
                                            <small>{{trans('courses.total rating score')}}</small>
                                        </div>
                                        @php
                                            $ratingDetails = $course->CourseRatingDetails['ratingDetails'];
                                            $ratingCount = $course->CourseRatingDetails['count'];
                                        @endphp
                                        @if($ratingDetails)
                                            <div class="review_summary_chart">
                                                @foreach ($ratingDetails as $ratingItem) 
                                                    @php
                                                        $ratingPercent = round( (( $ratingItem->ratingCount / $ratingCount ) * 100), 1 ) ;
                                                    @endphp
                                                    <div class="review_summary_chart_row">
                                                        <div class="review_summary_chart_prograss">
                                                            <div class="review_summary_chart_buffer" style="width:{{$ratingPercent}}%;"></div>
                                                        </div>
                                                        <div class="review_summary_chart_rating">
                                                            <div class="jq_rating jq-stars" data-options='{"initialRating":{{$ratingItem->rating}}, "readOnly":true, "starSize":16}'></div>
                                                            <div><span class="text_primary">{{round($ratingPercent)}}%</span></div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                @endif
                                <!-- Reviews -->
                                @include('website.courses.assets.courseReviews', ['courseReviews' => $course->coursereviews, 'courseId' => $course->id]) 

                            </section>
                        </div>
                        <!-- end course_detail_content -->
                    </div>
                </div>
            </section>

            @if(count($course->courserelated) > 0)
                <section class="sec sec_pad_top sec_pad_bottom">
                    <div class="wrapper">
                        <section class="title mbmd">
                            <h2 class="text_primary text_capitalize">{{trans('courses.Recommended courses')}}</h2>
                        </section>
                        <div id="relatedCourses">
                            <div class="courses_cards owl-carousel owl-theme relatedCourses">
                                @foreach($course->courserelated as $data)
                                    @include('website.courses.assets.mostViewedItem', ['data' => $data->relatedCourse]) 
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        </div>

        <!-- START MOBILE FIXED BUTTONS -->
        <div class="show-mobile fixed-buttons text-center d-none">
            @if(!$shoppingCart && !$enrolled)
                @if(Auth::check())
                    @if($course->type == Courses::TYPE_WEBINAR)
                        @if(getEventStatus($course) == "passed")
                            <a href="javascript:void(0)" class="more_button button_primary w-100 text-center mb-10 p-3" style="background-color: #cf2626;">
                                {{ trans('courses.This Webinar Has Ended') }}
                            </a>
                        @else
                            <a href="/site/enrollWebinar/{{$course->id}}" class="more_button button_primary w-100 text-center mb-10 p-3" style="background-color: #cf2626;">
                                {{ trans('courses.Watch This Webinar') }}
                            </a>
                        @endif
                    @else
                        @if(count($course->certificatesContainer) > 0)
                            <a href="javascript:void(0)" onclick="loadModal('/courses/certificatesContainer/id/', {{$course->id}})" class="more_button button_primary w-100 text-center mb-10 p-3" data-dismiss="modal" data-toggle="modal" data-target="#exampleModal" class="button button_primary button_large add_cart track" data-course-id="{{$course->id}}">
                                <i class="fas fa-cart-plus track"></i> {{ $course->OriginalPrice }} {{getCurrency()}}
                            </a>
                        @else
                            <a href="/courses/addToCart/id/{{$course->id}}" class="more_button button_primary w-100 text-center mb-10 p-3">
                                <i class="fas fa-cart-plus track"></i> {{ $course->OriginalPrice }} {{getCurrency()}}
                            </a>
                        @endif
                    @endif
                @else
                    @if($course->type == Courses::TYPE_WEBINAR)
                        @if(getEventStatus($course) == "passed")
                            <a href="javascript:void(0)" class="more_button button_primary w-100 text-center mb-10 p-3" style="background-color: #cf2626;">
                                {{ trans('courses.This Webinar Has Ended') }}
                            </a>
                        @else
                            <a href="javascript:void(0)" data-dismiss="modal" data-remote="/login" data-toggle="modal" data-target="#loginModal" class="more_button button_primary w-100 text-center mb-10 p-3">
                                {{ trans('courses.Sign in to join this webinar') }}
                            </a>
                        @endif
                    @else
                        <a href="javascript:void(0)" data-dismiss="modal" data-remote="/login" data-toggle="modal" data-target="#loginModal" class="more_button button_primary w-100 text-center mb-10 p-3">
                            <i class="fas fa-cart-plus"></i> {{ $course->OriginalPrice }} {{getCurrency()}}
                        </a>
                    @endif
                @endif
            @endif

            @if($enrolled && $course->type == Courses::TYPE_WEBINAR)
                @if(getEventStatus($course) == "passed")
                    <a href="javascript:void(0)" class="more_button button_primary w-100 text-center mb-10 p-3" style="background-color: #cf2626;">
                        {{ trans('courses.This Webinar Has Ended') }}
                    </a>
                @else
                    <a href="{{($course->webinar_url) ? $course->webinar_url : 'javascript:void(0)'}}" target="_blank" class="more_button button_primary w-100 text-center mb-10 p-3">
                        {{ trans('courses.Watch This Webinar') }}
                    </a>
                @endif
            @endif

            @if($enrolled && $course->type != Courses::TYPE_WEBINAR && isset($course->quiz))
                <a href="/courses/startExam/{{$course->slug}}" class="more_button button_primary w-100 text-center mb-10 p-3">
                    {{trans('courses.start exam')}}
                </a>
            @endif
        </div>
        <!-- END MOBILE FIXED BUTTONS -->
    </div>
</main>

<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=612247d00596560012d381ab&product=inline-share-buttons' async='async'></script>
@endsection
