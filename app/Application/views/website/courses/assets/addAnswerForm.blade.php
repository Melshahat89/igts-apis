<div class=""> 
<div id="addQuestionAlert"></div>

@if(Auth::check() && $enrolled)
<div id="answer_form">
<form id="addAnswerForm-{{ $questionId }}" class="form-content answer-form">
            {{ csrf_field() }}
        <input type="hidden" name="lecturequestions_id" value="{{ $questionId }}">
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <input type="hidden" name="instructor_id" value="{{ $instructor_id }}">

        <div class="input-group">
            <textarea name="answer" style="height:40px;" type="text" class="form_input" placeholder="{{ trans('courses.Message') }}" aria-label="Your Answer" required></textarea>
        </div>

    </form>

    <div class="d-flex justify-content-right">
            <button id="answer-submit" onclick="sendAnswer('{{ $questionId }}');" type="submit" class="button mtmd button_wide button_primary"><i class="fas fa-paper-plane"></i></button>
        </div>

</div>
    

@else

    <a class="button button_primary_reverse text_capitalize" href="#" data-dismiss="modal" data-remote="/login"data-toggle="modal" data-target="#loginModal">{{ trans('website.Register now to be able to add a comment') }} </a>

@endif

</div>
