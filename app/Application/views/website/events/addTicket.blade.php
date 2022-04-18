@extends(layoutEvents())
@section('title')
    {{ trans('eventsdata.Events Dashboard') }} | {{ trans('eventsdata.Add Ticket') }}
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
            <h3 class="panel-title">{{ trans('eventsdata.Add Ticket') }}</h3>
        </div>
        <div class="panel-body">
          @include(layoutMessage('website'))
          <form action="{{ concatenateLangToUrl('eventstickets/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("website.eventstickets.relation.events.edit")
                <div class="form-group {{ $errors->has("name") ? "has-error" : "" }}" > 
                <label for="name">{{ trans("eventstickets.name")}}</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ isset($item->name) ? $item->name : old("name") }}"  placeholder="{{ trans("eventstickets.name")}}">
                </div>
                @if ($errors->has("name"))
                    <div class="alert alert-danger">
                    <span class='help-block'>
                    <strong>{{ $errors->first("name") }}</strong>
                    </span>
                    </div>
                @endif
                <div class="form-group {{ $errors->has("email") ? "has-error" : "" }}" > 
                <label for="email">{{ trans("eventstickets.email")}}</label>
                    <input type="text" name="email" class="form-control" id="email" value="{{ isset($item->email) ? $item->email : old("email") }}"  placeholder="{{ trans("eventstickets.email")}}">
                </div>
                @if ($errors->has("email"))
                    <div class="alert alert-danger">
                    <span class='help-block'>
                    <strong>{{ $errors->first("email") }}</strong>
                    </span>
                    </div>
                @endif
              
             <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="fa fa-save"></i>
                    {{ trans('website.Update') }}  {{ trans('website.eventstickets') }}
                </button>
            </div>
        </form>

        </div>
    </div>

@endsection
@push('js')
<script>
  $(document).ready(function(){
    $("#type").change(function(){
          if($( "option:selected", this ).attr("value") =="1"){
              $("#live").show();
              $("#recorded").hide();
              $("#offline").hide();
          }
          if($( "option:selected", this ).attr("value") =="2"){
              $("#live").hide();
              $("#recorded").show();
              $("#offline").hide();
          }
          if($( "option:selected", this ).attr("value") =="3"){
              $("#live").hide();
              $("#recorded").hide();
              $("#offline").show();
          }
  });
});
</script>
@endpush