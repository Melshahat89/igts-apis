@extends(layoutExtend())

@section('title')
    {{ trans('paymentmethods.paymentmethods') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
@section('style')
    {{ Html::style('/public/admin/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}
@endsection
@section('content')
    @component(layoutForm() , ['title' => trans('paymentmethods.paymentmethods') , 'model' => 'paymentmethods' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
         @include(layoutMessage())
        <form action="{{ concatenateLangToUrl('lazyadmin/paymentmethods/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}


            <div class="form-group  {{  $errors->has("title.en")  &&  $errors->has("title.ar")  ? "has-error" : "" }}" >
                <label for="title">{{ trans("courses.title")}}</label>
                {!! extractFiled(isset($item) ? $item : null , "title", isset($item->title) ? $item->title : old("title") , "text" , "paymentmethods") !!}
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


            <div class="form-group {{ $errors->has("class") ? "has-error" : "" }}" >
                <label for="class">{{ trans("paymentmethods.class")}}</label>
                <input type="text" name="class" class="form-control" id="class" value="{{ isset($item->class) ? $item->class : old("class") }}"  placeholder="{{ trans("paymentmethods.class")}}">
            </div>
            @if ($errors->has("class"))
                <div class="alert alert-danger">
                     <span class='help-block'>
                      <strong>{{ $errors->first("class") }}</strong>
                     </span>
                </div>
            @endif


            <div class="form-group {{ $errors->has("logo") ? "has-error" : "" }}" >
                <label for="logo">{{ trans("paymentmethods.logo")}}</label>
                <input type="text" name="logo" class="form-control" id="logo" value="{{ isset($item->logo) ? $item->logo : old("logo") }}"  placeholder="{{ trans("paymentmethods.logo")}}">
            </div>
            @if ($errors->has("logo"))
                <div class="alert alert-danger">
                     <span class='help-block'>
                      <strong>{{ $errors->first("logo") }}</strong>
                     </span>
                </div>
            @endif

            <div class="form-group {{ $errors->has("action") ? "has-error" : "" }}" >
                <label for="action">{{ trans("paymentmethods.action")}}</label>
                <input type="text" name="action" class="form-control" id="action" value="{{ isset($item->action) ? $item->action : old("action") }}"  placeholder="{{ trans("paymentmethods.action")}}">
            </div>
            @if ($errors->has("action"))
                <div class="alert alert-danger">
                     <span class='help-block'>
                      <strong>{{ $errors->first("action") }}</strong>
                     </span>
                </div>
            @endif
            
            <div class="form-group {{ $errors->has("type") ? "has-error" : "" }}" >
                <label for="type">{{ trans("paymentmethods.status")}}</label>
                <select name="status"  class="form-control input-item select-custom" >
                    <option value="1" {{ (isset($item) && $item->status == 1) ? 'selected' : '' }}> Enabled </option>
                    <option value="0" {{ (isset($item) && $item->status == 0) ? 'selected' : '' }}> Disabled </option>
                </select>
            </div>
            @if ($errors->has("status"))
                <div class="alert alert-danger">
                    <span class='help-block'>
                        <strong>{{ $errors->first("status") }}</strong>
                    </span>
                </div>
            @endif



            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="material-icons">check_circle</i>
                    {{ trans('home.save') }}  {{ trans('paymentmethods.paymentmethods') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection
@section('script')
@include(layoutPath('layout.helpers.tynic'))
@endsection
