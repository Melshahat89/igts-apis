		<div class="form-group {{ $errors->has("events") ? "has-error" : "" }}">
			<label for="events">{{ trans( "events.events") }}</label>
			@php 
				$user = App\Application\Model\User::findOrfail(Auth::user()->id);
				$events = App\Application\Model\Events::where('eventsdata_id',$user->eventsdata->id)->pluck("title" ,"id")->all()  
			@endphp
			@php  $events_id = isset($item) ? $item->events_id : null @endphp
			<select name="events_id"  class="form-control" >
			@foreach( $events as $key => $relatedItem)
			<option value="{{ $key }}"  {{ $key == $events_id  ? "selected" : "" }}> {{ is_json($relatedItem) ? getDefaultValueKey($relatedItem) :  $relatedItem}}</option>
			@endforeach
			</select>
			@if ($errors->has("events"))
				<div class="alert alert-danger">
					<span class="help-block">
						<strong>{{ $errors->first("events") }}</strong>
					</span>
				</div>
			@endif
			</div>
