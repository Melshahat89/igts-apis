		<div class="form-group {{ $errors->has("quizquestions") ? "has-error" : "" }}">
			<label for="quizquestions">{{ trans( "quizquestions.quizquestions") }}</label>
			@php $quizquestions = App\Application\Model\Quizquestions::orderBy('id', 'DESC')->pluck("question" ,"id")->all()  @endphp
			@php  $quizquestions_id = isset($item) ? $item->quizquestions_id : null @endphp
			<select name="quizquestions_id"  class="form-control" >
			@foreach( $quizquestions as $key => $relatedItem)
			<option value="{{ $key }}"  {{ $key == $quizquestions_id  ? "selected" : "" }}> {{ is_json($relatedItem) ? getDefaultValueKey($relatedItem) :  $relatedItem}}</option>
			@endforeach
			</select>
			@if ($errors->has("quizquestions"))
				<div class="alert alert-danger">
					<span class="help-block">
						<strong>{{ $errors->first("quizquestions") }}</strong>
					</span>
				</div>
			@endif
			</div>
