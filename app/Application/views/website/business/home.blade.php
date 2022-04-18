@extends(layoutBusiness())
@section('title')
  {{ trans('businessdata.MEDU | Dashboard') }}
@endsection
@section('description')
    {{ trans('home.MeduoHomeDescription') }}
@endsection
@section('keywords')
    {{ trans('home.MeduoHomeKeywords') }}
@endsection
@section('content')

<div class="panel panel-headline">
  <div class="panel-heading">
      <h3 class="panel-title">{{ trans('businessdata.Dashboard') }}</h3>
      <p class="panel-subtitle"></p>
  </div>
  <div class="panel-body">
      <div class="row">

      </div>
  </div>
</div>

@endsection