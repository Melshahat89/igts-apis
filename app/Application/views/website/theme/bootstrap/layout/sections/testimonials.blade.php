
<section class="testimonials" style="    background: #f3f3f3;">
    <div class="container">
        <div class="section_title_1 text-center">
            <h4><span>{{trans('website.testimonials')}}</span></h4>
        </div>

        <div class="owl-carousel">
            @foreach($Data as $item)
                <div class="test-item text-center">
                <p>
                    {{$item->message_lang}}
                </p>
                <a href="#"><span>{{$item->name_lang}},</span> {{$item->title_lang}} </a>
            </div>
            @endforeach
        </div>

    </div>
</section>