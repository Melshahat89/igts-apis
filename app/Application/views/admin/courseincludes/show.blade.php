@extends(layoutExtend())
  @section('title')
    {{ trans('courseincludes.courseincludes') }} {{ trans('home.view') }}
@endsection
  @section('content')
    @component(layoutForm() , ['title' => trans('courseincludes.courseincludes') , 'model' => 'courseincludes' , 'action' => trans('home.view')  ])
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("courseincludes.position") }}</th>
     <td>{{ nl2br($item->position) }}</td>
    </tr>
  </table>
          @include('admin.courseincludes.buttons.delete' , ['id' => $item->id])
        @include('admin.courseincludes.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
