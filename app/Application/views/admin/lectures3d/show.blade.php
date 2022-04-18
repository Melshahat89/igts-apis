@extends(layoutExtend())
  @section('title')
    {{ trans('lectures3d.lectures3d') }} {{ trans('home.view') }}
@endsection
  @section('content')
    @component(layoutForm() , ['title' => trans('lectures3d.lectures3d') , 'model' => 'lectures3d' , 'action' => trans('home.view')  ])
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("lectures3d.title") }}</th>
     <td>{{ nl2br($item->title) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("lectures3d.link") }}</th>
     <td>{{ nl2br($item->link) }}</td>
    </tr>
  </table>
          @include('admin.lectures3d.buttons.delete' , ['id' => $item->id])
        @include('admin.lectures3d.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
