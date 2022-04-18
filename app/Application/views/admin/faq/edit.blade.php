@extends(layoutExtend())

@section('title')
    {{ trans('faq.faq') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
@section('style')
    {{ Html::style('/public/admin/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}
@endsection
@section('content')
    @component(layoutForm() , ['title' => trans('faq.faq') , 'model' => 'faq' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
         @include(layoutMessage())
        <form action="{{ concatenateLangToUrl('lazyadmin/faq/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

 		 <div class="form-group {{ $errors->has("group_id") ? "has-error" : "" }}" > 
			<label for="group_id">{{ trans("faq.group_id")}}</label>

			@php  $group_id = isset($item) ? $item->group_id : null @endphp
			<select name="group_id"  class="form-control" >
			    {{--  <option value="">None</option>  --}}
				@foreach( faqTypes() as $key => $relatedItem)
					<option value="{{ $key }}"  {{ $key == $group_id  ? "selected" : "" }}> {{ is_json($relatedItem) ? getDefaultValueKey($relatedItem) :  $relatedItem}}</option>
				@endforeach
			</select>
			


				{{--  <input type="text" name="group_id" class="form-control" id="group_id" value="{{ isset($item->group_id) ? $item->group_id : old("group_id") }}"  placeholder="{{ trans("faq.group_id")}}">  --}}
		</div>
			@if ($errors->has("group_id"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("group_id") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group  {{  $errors->has("question.en")  &&  $errors->has("question.ar")  ? "has-error" : "" }}" >
			<label for="question">{{ trans("faq.question")}}</label>
				{!! extractFiled(isset($item) ? $item : null , "question", isset($item->question) ? $item->question : old("question") , "text" , "faq") !!}
		</div>
			@if ($errors->has("question.en"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("question.en") }}</strong>
					</span>
				</div>
			@endif
			@if ($errors->has("question.ar"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("question.ar") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group  {{  $errors->has("answer.en")  &&  $errors->has("answer.ar")  ? "has-error" : "" }}" >
			<label for="answer">{{ trans("faq.answer")}}</label>
			{!! extractFiled(isset($item) ? $item : null , "answer" , isset($item->answer) ? $item->answer : old("answer") , "textarea" , "faq" , 'tinymce' ) !!}

		
		</div>
			@if ($errors->has("answer.en"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("answer.en") }}</strong>
					</span>
				</div>
			@endif
			@if ($errors->has("answer.ar"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("answer.ar") }}</strong>
					</span>
				</div>
			@endif


            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="material-icons">check_circle</i>
                    {{ trans('home.save') }}  {{ trans('faq.faq') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection
@section('script')
@include(layoutPath('layout.helpers.tynic'))
@endsection
