@extends(layoutExtend())

@section('title')
    {{ trans('partners.partners') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection

@section('content')
    @component(layoutForm() , ['title' => trans('partners.partners') , 'model' => 'partners' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
         @include(layoutMessage())
        <form action="{{ concatenateLangToUrl('lazyadmin/partners/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

 		 <div class="form-group  {{  $errors->has("title.en")  &&  $errors->has("title.ar")  ? "has-error" : "" }}" >
			<label for="title">{{ trans("partners.title")}}</label>
				{!! extractFiled(isset($item) ? $item : null , "title", isset($item->title) ? $item->title : old("title") , "text" , "partners") !!}
		</div>
			@if ($errors->has("title.en"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("title.en") }}</strong>
					</span>
				</div>
			@endif
			@if ($errors->has("title.ar"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("title.ar") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group  {{  $errors->has("description.en")  &&  $errors->has("description.ar")  ? "has-error" : "" }}" >
			<label for="description">{{ trans("partners.description")}}</label>
				{!! extractFiled(isset($item) ? $item : null , "description", isset($item->description) ? $item->description : old("description") , "textarea" , "partners" ) !!}
		</div>
			@if ($errors->has("description.en"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("description.en") }}</strong>
					</span>
				</div>
			@endif
			@if ($errors->has("description.ar"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("description.ar") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("logo") ? "has-error" : "" }}" > 
			<label for="logo">{{ trans("partners.logo")}}</label>
				@if(isset($item) && $item->logo != "")
				<br>
				<img src="{{ small($item->logo) }}" class="thumbnail" alt="" width="200">
				<br>
				@endif
				<input type="file" name="logo" >
		</div>
			@if ($errors->has("logo"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("logo") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group  {{  $errors->has("seo_desc[].en")  &&  $errors->has("seo_desc[].ar")  ? "has-error" : "" }}" >
			<label for="seo_desc">{{ trans("partners.seo_desc")}}</label>
				<div id="laraflat-seo_desc">
					@if(isset($item) || old("seo_desc"))
						@if((isset($item->seo_desc) && json_decode($item->seo_desc) ) || old("seo_desc"))
						@php $items = isset($item->seo_desc) && json_decode($item->seo_desc) ? json_decode($item->seo_desc)  : old("seo_desc") @endphp
							@foreach($items as $jsonseo_desc)
								<div class="title form-inline" style="margin-top:5px;margin-bottom:5px"><input class="form-control" name="seo_desc[]"  value="{{ $jsonseo_desc}}" type="text" placeholder="{{ trans("partners.seo_desc")}}" ><span class="btn btn-warning" onclick="removetitle(this)"> <i class="fa fa-minus"></i></span></div>
							@endforeach
						@endif
					@endif
				<span class="btn btn-success" onclick="AddNewseo_desc()"><i class="fa fa-plus"></i></span>
				<span class="btn btn-danger" onclick="clearAllseo_desc(this)"><i class="fa fa-minus"></i></span>
				@push("js")
                                        <script>
                                            function AddNewseo_desc() {
                                                $("#laraflat-seo_desc").append('<div class="seo_desc form-inline" style="margin-top:5px;margin-bottom:5px">'+'<input class="form-control" name="seo_desc[]"  type="text" placeholder="{{ trans("partners.seo_desc")}}" >'+'<span class="btn btn-warning" onclick="removeseo_desc(this)">'+' <i class="fa fa-minus"></i></span>'+'</div>');
                                            }
                                            function removeseo_desc(e) {
                                                $(e).closest("div.seo_desc").remove();
                                            }
                                            function clearAllseo_desc(e) {
                                                $("#laraflat-seo_desc").html("");
                                            }
                                        </script>
            @endpush
					</div>
		</div>
			@if ($errors->has("seo_desc[].en"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("seo_desc[].en") }}</strong>
					</span>
				</div>
			@endif
			@if ($errors->has("seo_desc[].ar"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("seo_desc[].ar") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group  {{  $errors->has("seo_keys[].en")  &&  $errors->has("seo_keys[].ar")  ? "has-error" : "" }}" >
			<label for="seo_keys">{{ trans("partners.seo_keys")}}</label>
				<div id="laraflat-seo_keys">
					@if(isset($item) || old("seo_keys"))
						@if((isset($item->seo_keys) && json_decode($item->seo_keys) ) || old("seo_keys"))
						@php $items = isset($item->seo_keys) && json_decode($item->seo_keys) ? json_decode($item->seo_keys)  : old("seo_keys") @endphp
							@foreach($items as $jsonseo_keys)
								<div class="title form-inline" style="margin-top:5px;margin-bottom:5px"><input class="form-control" name="seo_keys[]"  value="{{ $jsonseo_keys}}" type="text" placeholder="{{ trans("partners.seo_keys")}}" ><span class="btn btn-warning" onclick="removetitle(this)"> <i class="fa fa-minus"></i></span></div>
							@endforeach
						@endif
					@endif
				<span class="btn btn-success" onclick="AddNewseo_keys()"><i class="fa fa-plus"></i></span>
				<span class="btn btn-danger" onclick="clearAllseo_keys(this)"><i class="fa fa-minus"></i></span>
				@push("js")
                                        <script>
                                            function AddNewseo_keys() {
                                                $("#laraflat-seo_keys").append('<div class="seo_keys form-inline" style="margin-top:5px;margin-bottom:5px">'+'<input class="form-control" name="seo_keys[]"  type="text" placeholder="{{ trans("partners.seo_keys")}}" >'+'<span class="btn btn-warning" onclick="removeseo_keys(this)">'+' <i class="fa fa-minus"></i></span>'+'</div>');
                                            }
                                            function removeseo_keys(e) {
                                                $(e).closest("div.seo_keys").remove();
                                            }
                                            function clearAllseo_keys(e) {
                                                $("#laraflat-seo_keys").html("");
                                            }
                                        </script>
            @endpush
					</div>
		</div>
			@if ($errors->has("seo_keys[].en"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("seo_keys[].en") }}</strong>
					</span>
				</div>
			@endif
			@if ($errors->has("seo_keys[].ar"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("seo_keys[].ar") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group  {{  $errors->has("search_keys[].en")  &&  $errors->has("search_keys[].ar")  ? "has-error" : "" }}" >
			<label for="search_keys">{{ trans("partners.search_keys")}}</label>
				<div id="laraflat-search_keys">
					@if(isset($item) || old("search_keys"))
						@if((isset($item->search_keys) && json_decode($item->search_keys) ) || old("search_keys"))
						@php $items = isset($item->search_keys) && json_decode($item->search_keys) ? json_decode($item->search_keys)  : old("search_keys") @endphp
							@foreach($items as $jsonsearch_keys)
								<div class="title form-inline" style="margin-top:5px;margin-bottom:5px"><input class="form-control" name="search_keys[]"  value="{{ $jsonsearch_keys}}" type="text" placeholder="{{ trans("partners.search_keys")}}" ><span class="btn btn-warning" onclick="removetitle(this)"> <i class="fa fa-minus"></i></span></div>
							@endforeach
						@endif
					@endif
				<span class="btn btn-success" onclick="AddNewsearch_keys()"><i class="fa fa-plus"></i></span>
				<span class="btn btn-danger" onclick="clearAllsearch_keys(this)"><i class="fa fa-minus"></i></span>
				@push("js")
                                        <script>
                                            function AddNewsearch_keys() {
                                                $("#laraflat-search_keys").append('<div class="search_keys form-inline" style="margin-top:5px;margin-bottom:5px">'+'<input class="form-control" name="search_keys[]"  type="text" placeholder="{{ trans("partners.search_keys")}}" >'+'<span class="btn btn-warning" onclick="removesearch_keys(this)">'+' <i class="fa fa-minus"></i></span>'+'</div>');
                                            }
                                            function removesearch_keys(e) {
                                                $(e).closest("div.search_keys").remove();
                                            }
                                            function clearAllsearch_keys(e) {
                                                $("#laraflat-search_keys").html("");
                                            }
                                        </script>
            @endpush
					</div>
		</div>
			@if ($errors->has("search_keys[].en"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("search_keys[].en") }}</strong>
					</span>
				</div>
			@endif
			@if ($errors->has("search_keys[].ar"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("search_keys[].ar") }}</strong>
					</span>
				</div>
			@endif


            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="material-icons">check_circle</i>
                    {{ trans('home.save') }}  {{ trans('partners.partners') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection
