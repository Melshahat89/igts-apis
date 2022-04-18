@extends(layoutExtend())
  @section('title')
    {{ trans('businesscourses.businesscourses') }} {{ trans('home.view') }}
@endsection
  @section('content')
    @component(layoutForm() , ['title' => trans('businesscourses.businesscourses') , 'model' => 'businesscourses' , 'action' => trans('home.view')  ])
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("businesscourses.comment") }}</th>
     <td>{{ nl2br($item->comment) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("businesscourses.status") }}</th>
     <td>{{ nl2br($item->status) }}</td>
    </tr>
  </table>
          @include('admin.businesscourses.buttons.delete' , ['id' => $item->id])
        @include('admin.businesscourses.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
