@extends(layoutExtend('website'))
 
@section('title')
    {{ trans('faq.faq') }}
@endsection
 
@section('content')
<div class="bread-crumb">
    <div class="container">
        <a href="{{url('/')}}">Home</a> > <span>{{ trans('faq.faq') }}</span>
    </div>
</div>

<div class="page-title general-gred">
    <div class="container">
        <h1>{{ trans('faq.faq') }}</h1>


    </div>
</div>

<div class="container">
 
   
<section class="about-content">


    @foreach($faq as $key => $value)
    <h4 class="mt-4 mb-4"><span>{{faqTypes()[$value->group_id]}}</span> </h4>
        @foreach ($value->groups as $group)
        <div class="accordion course-accordion" id="accordionExample{{$group->group_id}}">
            <div class="card">
                <div class="card-header" id="headingOne_{{$group->group_id}}">
                    <h2 class="mb-0">
                        <a type="button" class="btn btn-link flexBetween" data-toggle="collapse" data-target="#collapse_{{$group->id}}">
                            <div class="acco-title flexLeft">
                                <i class="fa fa-plus mr-10"></i>
                                <span>{{$group->question_lang}}</span>
                            </div>
                        </a>
                    </h2>
                </div>
                <div id="collapse_{{$group->id}}" class="collapse show" aria-labelledby="headingOne_{{$group->group_id}}" data-parent="#accordionExample{{$group->group_id}}">

                        <div class="course-line flexBetween watched">
                            <div class="flexLeft">
                                {!!$group->answer_lang!!}
                            </div>
                        </div>
                </div>
            </div>
        </div>
        @endforeach

    
    @endforeach

    
</section>
 
</div>
 
 
 
 
 
@endsection
 