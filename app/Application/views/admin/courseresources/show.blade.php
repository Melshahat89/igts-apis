@extends(layoutExtend())
  @section('title')
    {{ trans('courseresources.courseresources') }} {{ trans('home.view') }}
@endsection
  @section('content')
    @component(layoutForm() , ['title' => trans('courseresources.courseresources') , 'model' => 'courseresources' , 'action' => trans('home.view')  ])
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("courseresources.title") }}</th>
     <td>{{ nl2br($item->title_lang) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("courseresources.file") }}</th>
     <td>
     <a href="{{ url(env("UPLOAD_PATH")."/".$item->file) }}">{{ $item->file }}</a>
     </td>
    </tr>
  </table>
          @include('admin.courseresources.buttons.delete' , ['id' => $item->id])
        @include('admin.courseresources.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
