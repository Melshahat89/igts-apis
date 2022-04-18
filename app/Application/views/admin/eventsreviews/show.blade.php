@extends(layoutExtend())
  @section('title')
    {{ trans('eventsreviews.eventsreviews') }} {{ trans('home.view') }}
@endsection
  @section('content')
    @component(layoutForm() , ['title' => trans('eventsreviews.eventsreviews') , 'model' => 'eventsreviews' , 'action' => trans('home.view')  ])
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("eventsreviews.review") }}</th>
     <td>{{ nl2br($item->review) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("eventsreviews.rating") }}</th>
     <td>{{ nl2br($item->rating) }}</td>
    </tr>
  </table>
          @include('admin.eventsreviews.buttons.delete' , ['id' => $item->id])
        @include('admin.eventsreviews.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
