		<div class="form-group {{ $errors->has("user") ? "has-error" : "" }}">
			<label for="user">{{ trans( "user.affiliate") }}</label>
			@php $user = App\Application\Model\User::where('is_affiliate',1)->pluck("email" ,"id")->all()  @endphp
			@php  $affiliate_id = isset($item) ? $item->affiliate_id : null @endphp
			<select name="affiliate_id"  class="form-control" >
			    <option value="">None</option>
			@foreach( $user as $key => $relatedItem)
			<option value="{{ $key }}"  {{ $key == $affiliate_id  ? "selected" : "" }}> {{ is_json($relatedItem) ? getDefaultValueKey($relatedItem) :  $relatedItem}}</option>
			@endforeach
			</select>
			@if ($errors->has("user"))
				<div class="alert alert-danger">
					<span class="help-block">
						<strong>{{ $errors->first("user") }}</strong>
					</span>
				</div>
			@endif
			</div>
