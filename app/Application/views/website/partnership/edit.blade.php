@extends(layoutExtend('website'))

@section('title')
    {{ trans('partnership.partnership') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection

@section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
         @include(layoutMessage('website'))
         <a href="{{ url('partnership') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
        <form action="{{ concatenateLangToUrl('partnership/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
             		 <div class="form-group {{ $errors->has("setting") ? "has-error" : "" }}" > 
			<label for="setting">{{ trans("partnership.setting")}}</label>
				<input type="text" name="setting" class="form-control" id="setting" value="{{ isset($item->setting) ? $item->setting : old("setting") }}"  placeholder="{{ trans("partnership.setting")}}">
		</div>
			@if ($errors->has("setting"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("setting") }}</strong>
					</span>
				</div>
			@endif

            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="fa fa-save"></i>
                    {{ trans('website.Update') }}  {{ trans('website.partnership') }}
                </button>
            </div>
        </form>
</div>
@endsection
