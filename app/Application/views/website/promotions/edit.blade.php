@extends(layoutExtend('website'))

@section('title')
    {{ trans('promotions.promotions') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection

@section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
         @include(layoutMessage('website'))
         <a href="{{ url('promotions') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
        <form action="{{ concatenateLangToUrl('promotions/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
             		 <div class="form-group {{ $errors->has("title") ? "has-error" : "" }}" > 
			<label for="title">{{ trans("promotions.title")}}</label>
				<input type="text" name="title" class="form-control" id="title" value="{{ isset($item->title) ? $item->title : old("title") }}"  placeholder="{{ trans("promotions.title")}}">
		</div>
			@if ($errors->has("title"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("title") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("description") ? "has-error" : "" }}" > 
			<label for="description">{{ trans("promotions.description")}}</label>
				<textarea name="description" class="form-control" id="description"   placeholder="{{ trans("promotions.description")}}" >{{isset($item->description) ? $item->description : old("description") }}</textarea >
		</div>
			@if ($errors->has("description"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("description") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("type") ? "has-error" : "" }}" > 
			<label for="type">{{ trans("promotions.type")}}</label>
				<input type="text" name="type" class="form-control" id="type" value="{{ isset($item->type) ? $item->type : old("type") }}"  placeholder="{{ trans("promotions.type")}}">
		</div>
			@if ($errors->has("type"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("type") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("value_for_egp") ? "has-error" : "" }}" > 
			<label for="value_for_egp">{{ trans("promotions.value_for_egp")}}</label>
				<input type="text" name="value_for_egp" class="form-control" id="value_for_egp" value="{{ isset($item->value_for_egp) ? $item->value_for_egp : old("value_for_egp") }}"  placeholder="{{ trans("promotions.value_for_egp")}}">
		</div>
			@if ($errors->has("value_for_egp"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("value_for_egp") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("value_for_other_currencies") ? "has-error" : "" }}" > 
			<label for="value_for_other_currencies">{{ trans("promotions.value_for_other_currencies")}}</label>
				<input type="text" name="value_for_other_currencies" class="form-control" id="value_for_other_currencies" value="{{ isset($item->value_for_other_currencies) ? $item->value_for_other_currencies : old("value_for_other_currencies") }}"  placeholder="{{ trans("promotions.value_for_other_currencies")}}">
		</div>
			@if ($errors->has("value_for_other_currencies"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("value_for_other_currencies") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("code") ? "has-error" : "" }}" > 
			<label for="code">{{ trans("promotions.code")}}</label>
				<input type="text" name="code" class="form-control" id="code" value="{{ isset($item->code) ? $item->code : old("code") }}"  placeholder="{{ trans("promotions.code")}}">
		</div>
			@if ($errors->has("code"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("code") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("start_date") ? "has-error" : "" }}" > 
			<label for="start_date">{{ trans("promotions.start_date")}}</label>
				<input type="date" name="start_date" class="form-control datepicker" id="start_date" value="{{ isset($item->start_date) ? $item->start_date : old("start_date") }}"  placeholder="{{ trans("promotions.start_date")}}">
		</div>
			@if ($errors->has("start_date"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("start_date") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("expiration_date") ? "has-error" : "" }}" > 
			<label for="expiration_date">{{ trans("promotions.expiration_date")}}</label>
				<input type="text" name="expiration_date" class="form-control" id="expiration_date" value="{{ isset($item->expiration_date) ? $item->expiration_date : old("expiration_date") }}"  placeholder="{{ trans("promotions.expiration_date")}}">
		</div>
			@if ($errors->has("expiration_date"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("expiration_date") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("active") ? "has-error" : "" }}" > 
			<label for="active">{{ trans("promotions.active")}}</label>
				 <div class="form-check">
					<label class="form-check-label">
					<input class="form-check-input" name="active" {{ isset($item->active) && $item->active == 0 ? "checked" : "" }} type="radio" value="0" > 
					{{ trans("promotions.No")}}
				 </label > 
				<label class="form-check-label">
				<input class="form-check-input" name="active" {{ isset($item->active) && $item->active == 1 ? "checked" : "" }} type="radio" value="1" > 
									{{ trans("promotions.Yes")}}
				 </label> 
				</div> 		</div>
			@if ($errors->has("active"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("active") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("promotion_limit") ? "has-error" : "" }}" > 
			<label for="promotion_limit">{{ trans("promotions.promotion_limit")}}</label>
				<input type="text" name="promotion_limit" class="form-control" id="promotion_limit" value="{{ isset($item->promotion_limit) ? $item->promotion_limit : old("promotion_limit") }}"  placeholder="{{ trans("promotions.promotion_limit")}}">
		</div>
			@if ($errors->has("promotion_limit"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("promotion_limit") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("promotion_usage") ? "has-error" : "" }}" > 
			<label for="promotion_usage">{{ trans("promotions.promotion_usage")}}</label>
				<input type="text" name="promotion_usage" class="form-control" id="promotion_usage" value="{{ isset($item->promotion_usage) ? $item->promotion_usage : old("promotion_usage") }}"  placeholder="{{ trans("promotions.promotion_usage")}}">
		</div>
			@if ($errors->has("promotion_usage"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("promotion_usage") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("publish_as_notification") ? "has-error" : "" }}" > 
			<label for="publish_as_notification">{{ trans("promotions.publish_as_notification")}}</label>
				 <div class="form-check">
					<label class="form-check-label">
					<input class="form-check-input" name="publish_as_notification" {{ isset($item->publish_as_notification) && $item->publish_as_notification == 0 ? "checked" : "" }} type="radio" value="0" > 
					{{ trans("promotions.No")}}
				 </label > 
				<label class="form-check-label">
				<input class="form-check-input" name="publish_as_notification" {{ isset($item->publish_as_notification) && $item->publish_as_notification == 1 ? "checked" : "" }} type="radio" value="1" > 
									{{ trans("promotions.Yes")}}
				 </label> 
				</div> 		</div>
			@if ($errors->has("publish_as_notification"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("publish_as_notification") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("notification_message") ? "has-error" : "" }}" > 
			<label for="notification_message">{{ trans("promotions.notification_message")}}</label>
				<textarea name="notification_message" class="form-control" id="notification_message"   placeholder="{{ trans("promotions.notification_message")}}" >{{isset($item->notification_message) ? $item->notification_message : old("notification_message") }}</textarea >
		</div>
			@if ($errors->has("notification_message"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("notification_message") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("include_courses") ? "has-error" : "" }}" > 
			<label for="include_courses">{{ trans("promotions.include_courses")}}</label>
				 <div class="form-check">
					<label class="form-check-label">
					<input class="form-check-input" name="include_courses" {{ isset($item->include_courses) && $item->include_courses == 0 ? "checked" : "" }} type="radio" value="0" > 
					{{ trans("promotions.No")}}
				 </label > 
				<label class="form-check-label">
				<input class="form-check-input" name="include_courses" {{ isset($item->include_courses) && $item->include_courses == 1 ? "checked" : "" }} type="radio" value="1" > 
									{{ trans("promotions.Yes")}}
				 </label> 
				</div> 		</div>
			@if ($errors->has("include_courses"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("include_courses") }}</strong>
					</span>
				</div>
			@endif

            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="fa fa-save"></i>
                    {{ trans('website.Update') }}  {{ trans('website.promotions') }}
                </button>
            </div>
        </form>
</div>
@endsection
