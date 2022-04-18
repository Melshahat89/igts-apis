<section id="section-4" class="regular-data">
    <h3 class="mb-20">
        {{ $course->title_lang }}
    </h3>
    @php
        $enrolled = App\Application\Model\Courses::isEnrolledCourse($course->id);
    @endphp

    @if (Auth::check())
        @isset($masterCourse)
            @php
                $masterCourseEnrolled = App\Application\Model\Courses::isEnrolledCourse($masterCourse->id);
            @endphp
            @if(($masterCourse->type == 3) AND ((!$enrolled) AND (!$masterCourseEnrolled)) AND ($masterCourse->MasterRequestApprove))
                    <div class="flexRight fixed-info">
                        <a class="view-more-section course-action-btns w-50 text-center mb-10 add_cart"
                            href={{ url('/courses/addToCart/id/' . $course->id) }}>
                            {{ trans('courses.Add to cart') }}
                        </a>
                    </div>
            @endif
        @endisset
    @endif
    
    <div>
        @if (Auth::check())
        @isset($masterCourse)
            @php
                $masterCourseEnrolled = App\Application\Model\Courses::isEnrolledCourse($masterCourse->id);
            @endphp
            @if (($enrolled Or $masterCourseEnrolled) AND $masterCourse->MasterRequestApprove)
            <div class="flexRight fixed-info ">
            
                    <a class="view-more-section course-action-btns w-50 text-center mb-10 add_cart" href="{{ url('/courses/startExam/' . $course->slug) }}">
                        {{ trans('courses.Start Exam') }}
                    </a>
            
            </div>
            @endif
            @endisset
    @endif
    </div>
</section>

    

<section>
    <div class="accordion course-accordion" id="accordionExample">
        @foreach ($course->coursesections as $section)
            <div class="card">
                <div class="card-header" id="headingOne_<?= $section->id ?>_<?= $course->id ?>">
                <h2 class="mb-0">
                    <a type="button" class="btn btn-link flexBetween" data-toggle="collapse" data-target="#collapse_<?= $section->id ?>_<?= $course->id ?>">
                        <div class="acco-title flexLeft">
                            <i class="fa fa-plus mr-10"></i>
                            <span>{{ $section->title_lang }}</span>
                        </div>
                        <p>{{ count($section->courselectures) }}   {{ trans('courses.lectures') }}</p>
                        <p>{{ $section->HoursLectures }}</p>

                    </a>
                </h2>
            </div>
            <div id="collapse_<?= $section->id ?>_<?= $course->id ?>" class="collapse show" aria-labelledby="headingOne_<?= $section->id ?>_<?= $course->id ?>" data-parent="#accordionExample">
                @foreach ($section->courselectures as $lecture)
                        <div class="course-line flexBetween watched">
                        <div class="flexLeft">
                            <i class="flaticon-play-button mr-10 ml-20"></i>
                            {{ $lecture->title_lang }}
                        </div>
                        <div class="flexBetween">
                       
                    @if (Auth::check())
                            @if ($lecture->is_free || $enrolled)
                                <a class="mr-20" href="{{ url('/courses/courseLecture/id/' . $lecture->id) }}">
                                   {{ $lecture->is_free ? trans('courses.Watch Free') : trans('courses.Preview') }}
                                
                                </a>
                            @elseif(!$lecture->is_free && $enrolled){
                                ?>
                                <a class="mr-20"  href="{{ url('/courses/courseLecture/id/' . $lecture->id) }}">
                                    {{ trans('courses.Preview') }}
                                </a>
                               
                            @else
                            <a class="mr-20 disabled">
                                {{ trans('courses.Preview') }}
                            </a>
                            @endif
                       
                    @else
                        <a class="mr-20  <?= $lecture->is_free ? '' : 'disabled' ?>" href="#" data-dismiss="modal" data-remote="/login"data-toggle="modal" data-target="#loginModal">{{ $lecture->is_free ? trans('courses.Watch Free') : trans('courses.Preview') }}
                             </a>
                    @endif
                        <p>
                        
                            @php
                            $duration = $lecture->length;
                            @endphp
                            
                            @if ($duration >= 3600)
                                {{ gmdate('H:i:s', $duration) }}
                            @else
                                {{ gmdate('i:s', $duration) }} 
                            @endif
                       
                    </p>
                    </div>
                    </div>
             
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</section>
