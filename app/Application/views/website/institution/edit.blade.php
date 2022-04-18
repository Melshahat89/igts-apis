@extends(layoutExtend('website'))

@section('title')
    {{ trans('institution.institution') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection

@section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
         @include(layoutMessage('website'))
         <a href="{{ url('institution') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
        <form action="{{ concatenateLangToUrl('institution/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
             		 <div class="form-group {{ $errors->has("temp1") ? "has-error" : "" }}" > 
			<label for="temp1">{{ trans("institution.temp1")}}</label>
				<input type="text" name="temp1" class="form-control" id="temp1" value="{{ isset($item->temp1) ? $item->temp1 : old("temp1") }}"  placeholder="{{ trans("institution.temp1")}}">
		</div>
			@if ($errors->has("temp1"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("temp1") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("temp2") ? "has-error" : "" }}" > 
			<label for="temp2">{{ trans("institution.temp2")}}</label>
				<input type="text" name="temp2" class="form-control" id="temp2" value="{{ isset($item->temp2) ? $item->temp2 : old("temp2") }}"  placeholder="{{ trans("institution.temp2")}}">
		</div>
			@if ($errors->has("temp2"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("temp2") }}</strong>
					</span>
				</div>
			@endif

            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="fa fa-save"></i>
                    {{ trans('website.Update') }}  {{ trans('website.institution') }}
                </button>
            </div>
        </form>
</div>
@endsection
