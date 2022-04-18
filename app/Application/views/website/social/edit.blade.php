@extends(layoutExtend('website'))

@section('title')
    {{ trans('social.social') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection

@section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
         @include(layoutMessage('website'))
         <a href="{{ url('social') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
        <form action="{{ concatenateLangToUrl('social/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
             		 <div class="form-group {{ $errors->has("user_id") ? "has-error" : "" }}" > 
			<label for="user_id">{{ trans("social.user_id")}}</label>
				<input type="text" name="user_id" class="form-control" id="user_id" value="{{ isset($item->user_id) ? $item->user_id : old("user_id") }}"  placeholder="{{ trans("social.user_id")}}">
		</div>
			@if ($errors->has("user_id"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("user_id") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("provider") ? "has-error" : "" }}" > 
			<label for="provider">{{ trans("social.provider")}}</label>
				<input type="text" name="provider" class="form-control" id="provider" value="{{ isset($item->provider) ? $item->provider : old("provider") }}"  placeholder="{{ trans("social.provider")}}">
		</div>
			@if ($errors->has("provider"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("provider") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("identifier") ? "has-error" : "" }}" > 
			<label for="identifier">{{ trans("social.identifier")}}</label>
				<input type="text" name="identifier" class="form-control" id="identifier" value="{{ isset($item->identifier) ? $item->identifier : old("identifier") }}"  placeholder="{{ trans("social.identifier")}}">
		</div>
			@if ($errors->has("identifier"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("identifier") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("profile_cache") ? "has-error" : "" }}" > 
			<label for="profile_cache">{{ trans("social.profile_cache")}}</label>
				<input type="text" name="profile_cache" class="form-control" id="profile_cache" value="{{ isset($item->profile_cache) ? $item->profile_cache : old("profile_cache") }}"  placeholder="{{ trans("social.profile_cache")}}">
		</div>
			@if ($errors->has("profile_cache"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("profile_cache") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("session_data") ? "has-error" : "" }}" > 
			<label for="session_data">{{ trans("social.session_data")}}</label>
				<input type="text" name="session_data" class="form-control" id="session_data" value="{{ isset($item->session_data) ? $item->session_data : old("session_data") }}"  placeholder="{{ trans("social.session_data")}}">
		</div>
			@if ($errors->has("session_data"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("session_data") }}</strong>
					</span>
				</div>
			@endif

            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="fa fa-save"></i>
                    {{ trans('website.Update') }}  {{ trans('website.social') }}
                </button>
            </div>
        </form>
</div>
@endsection
