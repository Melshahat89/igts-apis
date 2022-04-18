<div class="form-container">
    <h4 class="mb-20"> {{ trans('courses.Ask a question') }} </h4>

    <div id="addQuestionAlert"></div>
    @if(Auth::check())
        <form action="{{ concatenateLangToUrl('lecturequestions/item') }}" id="addQuestionForm.{{ $lectureId }}" class="form-content" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
        <input type="hidden" name="courselectures_id" value="{{ $lectureId }}">
        @if ($errors->has("courselectures_id"))
				<div class="alert alert-danger">
					<span class="help-block">
						<strong>{{ $errors->first("courselectures_id") }}</strong>
					</span>
				</div>
			@endif
        <div class="input-group">
            <textarea name="question_description" type="text" class="form-control" placeholder="{{ trans('courses.Message') }}" aria-label="Your question"></textarea>
        </div>
        <div class="text-right">
            <button type="submit" class="add-to-cart">
                {{ trans('courses.Send Now') }}
            </button>
        </div>
    </form>
    @else
        <a class="button button_primary_reverse text_capitalize" href="#" data-dismiss="modal" data-remote="/login"data-toggle="modal" data-target="#loginModal">{{ trans('website.Register now to be able to add a comment') }} </a>

    @endif

</div>
