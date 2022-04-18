@extends(layoutExtend())
  @section('title')
    {{ trans('searchkeys.searchkeys') }} {{ trans('home.view') }}
@endsection
  @section('content')
    @component(layoutForm() , ['title' => trans('searchkeys.searchkeys') , 'model' => 'searchkeys' , 'action' => trans('home.view')  ])
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("searchkeys.word") }}</th>
     <td>{{ nl2br($item->word) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("searchkeys.ip") }}</th>
     <td>{{ nl2br($item->ip) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("searchkeys.country") }}</th>
     <td>{{ nl2br($item->country) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("searchkeys.city") }}</th>
     <td>{{ nl2br($item->city) }}</td>
    </tr>
  </table>
          @include('admin.searchkeys.buttons.delete' , ['id' => $item->id])
        @include('admin.searchkeys.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
