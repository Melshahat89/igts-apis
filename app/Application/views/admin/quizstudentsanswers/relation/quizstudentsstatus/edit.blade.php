		<div class="form-group {{ $errors->has("quizstudentsstatus") ? "has-error" : "" }}">
			<label for="quizstudentsstatus">{{ trans( "quizstudentsstatus.quizstudentsstatus") }}</label>
			@php $quizstudentsstatuses = App\Application\Model\Quizstudentsstatus::pluck("id" ,"id")->all()  @endphp
			@php  $quizstudentsstatus_id = isset($item) ? $item->quizstudentsstatus_id : null @endphp
			<select name="quizstudentsstatus_id"  class="form-control" >
			@foreach( $quizstudentsstatuses as $key => $relatedItem)
			<option value="{{ $key }}"  {{ $key == $quizstudentsstatus_id  ? "selected" : "" }}> {{ is_json($relatedItem) ? getDefaultValueKey($relatedItem) :  $relatedItem}}</option>
			@endforeach
			</select>
			@if ($errors->has("quizstudentsstatus"))
				<div class="alert alert-danger">
					<span class="help-block">
						<strong>{{ $errors->first("quizstudentsstatus") }}</strong>
					</span>
				</div>
			@endif
			</div>
