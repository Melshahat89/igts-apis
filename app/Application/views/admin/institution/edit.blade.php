@extends(layoutExtend())

@section('title')
    {{ trans('institution.institution') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection

@section('content')
    @component(layoutForm() , ['title' => trans('institution.institution') , 'model' => 'institution' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
         @include(layoutMessage())
        <form action="{{ concatenateLangToUrl('lazyadmin/institution/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
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
                    <i class="material-icons">check_circle</i>
                    {{ trans('home.save') }}  {{ trans('institution.institution') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection
