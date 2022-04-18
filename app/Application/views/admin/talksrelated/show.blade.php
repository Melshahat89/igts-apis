@extends(layoutExtend())
  @section('title')
    {{ trans('talksrelated.talksrelated') }} {{ trans('home.view') }}
@endsection
  @section('content')
    @component(layoutForm() , ['title' => trans('talksrelated.talksrelated') , 'model' => 'talksrelated' , 'action' => trans('home.view')  ])
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("talksrelated.position") }}</th>
     <td>{{ nl2br($item->position) }}</td>
    </tr>
  </table>
          @include('admin.talksrelated.buttons.delete' , ['id' => $item->id])
        @include('admin.talksrelated.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
