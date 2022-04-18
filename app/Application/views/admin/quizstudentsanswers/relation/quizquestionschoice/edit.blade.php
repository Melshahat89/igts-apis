		<div class="form-group {{ $errors->has("quizquestionschoice") ? "has-error" : "" }}">
			<label for="quizquestionschoice">{{ trans( "quizquestionschoice.quizquestionschoice") }}</label>
			@php $quizquestionschoices = App\Application\Model\Quizquestionschoice::pluck("choice" ,"id")->all()  @endphp
			@php  $quizquestionschoice_id = isset($item) ? $item->quizquestionschoice_id : null @endphp
			<select name="quizquestionschoice_id"  class="form-control" >
			@foreach( $quizquestionschoices as $key => $relatedItem)
			<option value="{{ $key }}"  {{ $key == $quizquestionschoice_id  ? "selected" : "" }}> {{ is_json($relatedItem) ? getDefaultValueKey($relatedItem) :  $relatedItem}}</option>
			@endforeach
			</select>
			@if ($errors->has("quizquestionschoice"))
				<div class="alert alert-danger">
					<span class="help-block">
						<strong>{{ $errors->first("quizquestionschoice") }}</strong>
					</span>
				</div>
			@endif
			</div>
