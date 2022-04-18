@push('css')
{{ Html::style('public/css/rate.css') }}
@endpush
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-bar-rating/1.2.2/jquery.barrating.min.js"></script>
<script type="application/javascript">

    $('#rate').barrating({
        theme: 'fontawesome-stars',
    });

</script>
@endpush

<style>
    .rating {
        display: -webkit-flex;
        display: flex;
        -webkit-align-items: center;
        align-items: center;
        -webkit-flex-wrap: wrap;
        flex-wrap: wrap;
        margin-right: 7px;
    }
    .jq-stars {
        display: -webkit-flex;
        display: flex;
        -webkit-align-items: center;
        align-items: center;
        direction: ltr;
        margin-top: -14px;
    }
    .jq-star {
        width: 100px;
        height: 100px;
        cursor: pointer;
        margin: 0;
        padding: 0;
    }
    .jq-stars {
        display: -webkit-flex;
        display: flex;
        -webkit-align-items: center;
        align-items: center;
        direction: ltr;
        margin-top: -14px;
    }
    .jq-star-svg {
        padding-left: 3px;
        width: 100%;
        height: 100%;
    }
    .jq-star {
        width: 100px;
        height: 100px;
        cursor: pointer;
        margin: 0;
        padding: 0;
    }
    .jq-stars {
        display: -webkit-flex;
        display: flex;
        -webkit-align-items: center;
        align-items: center;
        direction: ltr;
        margin-top: -14px;
    }

</style>

@if(Auth::check())

    <div class="text-center mb-20 mt-20">
        <a class="view-more-section" data-toggle="modal" data-target="#add-review" href="#">
            {{ trans('courses.Add Review') }}</a>
    </div>



    <div class="modal fade" id="add-review" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header flexRight">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body custom-rev p-0">
                    <h1>
                        {{ trans('courses.Add Review') }}
                    </h1>

            
                    <form class="clearfix" id="feedbackForm" action="{{ concatenateLangToUrl('eventsreviews/item') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}

                    <div class="flexBetween mb-20">
                        <span>
                        {{ trans('courses.Rate your Talk') }}
                        </span>
                        <div class="rating">
                            <div class="form-group" > 
                                <select id="rate" name="rating">
                                <option value="1"> 1</option> 
                                <option value="2"> 2</option> 
                                <option value="3"> 3</option> 
                                <option value="4"> 4</option> 
                                <option value="5"> 5</option> 
                                </select> 
                            </div> 
                        </div>
                        @if ($errors->has("rating"))
                            <div class="alert alert-danger">
                            <span class='help-block'>
                            <strong>{{ $errors->first("rating") }}</strong>
                            </span>
                            </div>
                        @endif
                    </div>

                    <div class="input-group mb-20">

                        <textarea class="form-control form-replay" name="review" id="review" cols="5" rows="3"></textarea>

                        <input name="events_id" type="hidden" value="{{ $model->id }}">
                    </div>
                        <button  href="/id" type="submit" class="view-more-section w-100 text-center mb-20">{{ trans('courses.Submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
  
@else    

    <div class="text-center mb-20 mt-20">
        <a class="view-more-section" href="#" data-dismiss="modal" data-remote="/login"data-toggle="modal" data-target="#loginModal">{{ trans('courses.Add Review') }} </a>
    </div>
@endif