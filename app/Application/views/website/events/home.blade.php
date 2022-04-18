@extends(layoutEvents())
@section('title')
{{ trans('eventsdata.Events Dashboard') }}
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
      <h3 class="panel-title">{{ trans('eventsdata.Events Dashboard') }}</h3>
      <p class="panel-subtitle">Oct 14, 2020</p>
  </div>
  <div class="panel-body">
      <div class="row">

      </div>
  </div>
</div>

@endsection