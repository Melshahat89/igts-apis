@extends(layoutExtend('website'))
  @section('title')
    {{ trans('eventsdata.eventsdata') }} {{ trans('home.view') }}
@endsection
  @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('eventsdata') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("eventsdata.name") }}</th>
     <td>{{ nl2br($item->name_lang) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("eventsdata.email") }}</th>
     <td>{{ nl2br($item->email) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("eventsdata.logo") }}</th>
     <td>
     <img src="{{ small($item->logo) }}" width="100" />
     </td>
    </tr>
    <tr>
    <th width="200">{{ trans("eventsdata.website") }}</th>
     <td>{{ nl2br($item->website) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("eventsdata.about") }}</th>
     <td>{{ nl2br($item->about_lang) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("eventsdata.status") }}</th>
     <td>
    {{ $item->status == 1 ? trans("eventsdata.Yes") : trans("eventsdata.No")  }}
     </td>
    </tr>
  </table>
          @include('website.eventsdata.buttons.delete' , ['id' => $item->id])
        @include('website.eventsdata.buttons.edit' , ['id' => $item->id])
</div>
@endsection
