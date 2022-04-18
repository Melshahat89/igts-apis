		<div class="form-group {{ $errors->has("instructors") ? "has-error" : "" }}">
			<label for="instructors">{{ trans( "website.Instructors") }}</label>
			@php $instructors = App\Application\Model\User::where(function ($query) {
            $query->where('group_id', 3)
                 ->orWhere('group_id', 4)
                 ->orWhere('group_id', 5)
            ;
        })->pluck("name" ,"id")->all();
			@endphp
			@php  $instructor_id = isset($item) ? $item->instructor_id : null @endphp
			<select id="instructor_id" name="instructor_id"  class="form-control mdb-select md-form" >
			@foreach( $instructors as $key => $relatedItem)
			<option value="{{ $key }}"  {{ $key == $instructor_id  ? "selected" : "" }}> {{ is_json($relatedItem) ? getDefaultValueKey($relatedItem) :  $relatedItem}}</option>
			@endforeach
			</select>
			@if ($errors->has("instructors"))
				<div class="alert alert-danger">
					<span class="help-block">
						<strong>{{ $errors->first("instructors") }}</strong>
					</span>
				</div>
			@endif
			</div>
