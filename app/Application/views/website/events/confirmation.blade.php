@extends(layoutExtend('website'))
@section('title')
   {{ $model->title_lang }} - Meduo.net
@endsection
@section('description')
    {{ trans('home.MeduoHomeDescription') }}
@endsection
@section('keywords')
    {{ trans('home.MeduoHomeKeywords') }}
@endsection
@section('content')
@php
    use App\Application\Model\Events;
@endphp

<div class="bread-crumb">
    <div class="container">
        <a href="{{ url('/events/category') }}"> {{ trans('website.events Menu') }} </a> > 
        <span> {{ $model->title_lang }} </span>
    </div>
</div>

<section class="talks-content">
    <div class="container">

    


    <section class="mycart-container"  id="steps">
        <div class="container">
            <div class="my-items mt-40">
                <div class="row">
                    <div class="col-md-12">
                        <div class="Summary">
                            <h4><strong class="successfully"> {{ trans('website.Thank you! Your request was successfully submitted!') }} </strong></h4>
                            <div class="total">
                                <h5><strong> {{ trans('events.To Complete your registration, kindly fill in your details from the button below') }} <span><?php // echo $orderId; ?></span></strong></h5>
                                <a class="view-more-section course-action-btns  text-center mb-4 mt-4 add_cart" target="_blank"
                                href="{{ url($model->live_link) }}">
                                {{ trans('courses.Register in Zoom') }}
                                </a>
                            </div>
                            <div class="coupon">
                                <p>
                                {!! trans('website.Do you need help?') !!}
                                </p>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-40 next-step">
                        <div class="flexLeft">
                            <a class="view-more-section" href="{{ url('/events/view/' . $model->id) }}"><i class="flaticon-left-arrow"></i>
                                <span> {{ trans('events.Back to Event') }} </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    </div>
</section>
        

@endsection
