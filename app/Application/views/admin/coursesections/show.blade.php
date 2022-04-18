@extends(layoutExtend())
  @section('title')
    {{ trans('coursesections.coursesections') }} {{ trans('home.view') }}
@endsection
  @section('content')
    @component(layoutForm() , ['title' => trans('coursesections.coursesections') , 'model' => 'coursesections' , 'action' => trans('home.view')  ])
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("coursesections.title") }}</th>
     <td>{{ nl2br($item->title_lang) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("coursesections.will_do_at_the_end") }}</th>
     <td>{{ nl2br($item->will_do_at_the_end_lang) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("coursesections.position") }}</th>
     <td>{{ nl2br($item->position) }}</td>
    </tr>
  </table>
          @include('admin.coursesections.buttons.delete' , ['id' => $item->id])
        @include('admin.coursesections.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
