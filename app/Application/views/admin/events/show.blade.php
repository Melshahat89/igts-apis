@extends(layoutExtend())
  @section('title')
    {{ trans('events.events') }} {{ trans('home.view') }}
@endsection
  @section('content')
    @component(layoutForm() , ['title' => trans('events.events') , 'model' => 'events' , 'action' => trans('home.view')  ])
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("events.title") }}</th>
     <td>{{ nl2br($item->title_lang) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("events.description") }}</th>
     <td>{{ nl2br($item->description_lang) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("events.image") }}</th>
     <td>
     <img src="{{ small($item->image) }}" width="100" />
     </td>
    </tr>
    <tr>
    <th width="200">{{ trans("events.is_free") }}</th>
     <td>
    {{ $item->is_free == 1 ? trans("events.Yes") : trans("events.No")  }}
     </td>
    </tr>
    <tr>
    <th width="200">{{ trans("events.price_egp") }}</th>
     <td>{{ nl2br($item->price_egp) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("events.price_usd") }}</th>
     <td>{{ nl2br($item->price_usd) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("events.type") }}</th>
     <td>{{ nl2br($item->type) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("events.status") }}</th>
     <td>
    {{ $item->status == 1 ? trans("events.Yes") : trans("events.No")  }}
     </td>
    </tr>
    <tr>
    <th width="200">{{ trans("events.location") }}</th>
     <td>{{ nl2br($item->location) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("events.live_link") }}</th>
     <td>{{ nl2br($item->live_link) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("events.recorded_link") }}</th>
     <td>{{ nl2br($item->recorded_link) }}</td>
    </tr>
  </table>
          @include('admin.events.buttons.delete' , ['id' => $item->id])
        @include('admin.events.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
