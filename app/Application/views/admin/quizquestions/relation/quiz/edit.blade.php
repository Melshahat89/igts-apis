		<div class="form-group {{ $errors->has("quiz") ? "has-error" : "" }}">
			<label for="quiz">{{ trans( "quiz.quiz") }}</label>
			@php $quizzes = App\Application\Model\Quiz::pluck("title" ,"id")->all()  @endphp
			@php 
			
			
			if(isset($item)){

				$quiz_id = $item->quiz_id;
			}elseif(isset($data['section_id'])){

				$quiz_id = $data['section_id'];

			}else{
				$quiz_id = null;
			}
			
			
			@endphp
			<select name="quiz_id"  class="form-control" >
			@foreach( $quizzes as $key => $relatedItem)
			<option value="{{ $key }}"  {{ $key == $quiz_id  ? "selected" : "" }}> {{ is_json($relatedItem) ? getDefaultValueKey($relatedItem) :  $relatedItem}}</option>
			@endforeach
			</select>
			@if ($errors->has("quiz"))
				<div class="alert alert-danger">
					<span class="help-block">
						<strong>{{ $errors->first("quiz") }}</strong>
					</span>
				</div>
			@endif
			</div>
