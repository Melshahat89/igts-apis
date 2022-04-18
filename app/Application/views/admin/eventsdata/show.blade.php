@extends(layoutExtend())
  @section('title')
    {{ trans('eventsdata.eventsdata') }} {{ trans('home.view') }}
@endsection
  @section('content')
    @component(layoutForm() , ['title' => trans('eventsdata.eventsdata') , 'model' => 'eventsdata' , 'action' => trans('home.view')  ])
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
          @include('admin.eventsdata.buttons.delete' , ['id' => $item->id])
        @include('admin.eventsdata.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
