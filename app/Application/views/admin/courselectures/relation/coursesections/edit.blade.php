		<div class="form-group {{ $errors->has("coursesections") ? "has-error" : "" }}">
			<label for="coursesections">{{ trans( "coursesections.coursesections") }}</label>
			@php $coursesections = App\Application\Model\Coursesections::pluck("title" ,"id")->all()  @endphp
			@php  
			if(isset($item)){

				$coursesections_id = $item->coursesections_id;
			}elseif(isset($data['section_id'])){

				$coursesections_id = $data['section_id'];

			}else{
				$coursesections_id = null;

			}
			@endphp
			<select name="coursesections_id"  class="form-control" >
			@foreach( $coursesections as $key => $relatedItem)
			<option value="{{ $key }}"  {{ $key == $coursesections_id  ? "selected" : "" }}> {{ is_json($relatedItem) ? getDefaultValueKey($relatedItem) :  $relatedItem}}</option>
			@endforeach
			</select>
			@if ($errors->has("coursesections"))
				<div class="alert alert-danger">
					<span class="help-block">
						<strong>{{ $errors->first("coursesections") }}</strong>
					</span>
				</div>
			@endif
			</div>
