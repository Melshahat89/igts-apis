<div class="form-group {{ $errors->has("events") ? "has-error" : "" }}">
            <label for="events">{{ trans( "events.events") }}</label>
            <?php $event_id = isset($item) ? $item->event_id : null; ?>

			<select name="event_id"  class="form-control" >
                <option value=''></option>
            @foreach(allEvents() as $event)
            
                <option value="{{$event->id}}" {{ $event->id === $event_id ? 'selected' : '' }}>{{ $event->title_lang }}</option>

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