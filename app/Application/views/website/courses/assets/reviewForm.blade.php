<!-- write_comment -->
<div class="course_add_comment hide">
    <section class="title mbmd">
        <h2 class="text_primary text_capitalize">{{trans('courses.type in your review')}}</h2>
    </section>
    
    
    <div id="feedbackAlert"></div>
    <form class="clearfix" id="feedbackForm" action="{{ concatenateLangToUrl('coursereviews/item') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form_row">
            <label for="" class="form_label mbmd">{{trans('courses.your rating')}}</label>
            <div class="rating">
                <div id="rate" name="rating" class="jq_rating jq-stars" data-options='{"initialRating":5, "starSize":28, "disableAfterRate":false}'></div>
            </div>
        </div>

                

                    <div class="input-group mb-20">

                        <textarea class="form_input" name="review" id="review" cols="30" rows="10" placeholder="{{trans('courses.add your review')}}"></textarea>
                        <input type="hidden" name="rating" id="talkRating" value="5">

                        <input name="courses_id" type="hidden" value="{{ $id }}">
                    </div>
                        <button href="/id" type="submit" class="button mtmd button_wide button_primary">{{trans('courses.Submit')}}</button>
                    </form>