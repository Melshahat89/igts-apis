@extends(layoutExtend())
  @section('title')
    {{ trans('coursereviews.coursereviews') }} {{ trans('home.view') }}
@endsection
  @section('content')
    @component(layoutForm() , ['title' => trans('coursereviews.coursereviews') , 'model' => 'coursereviews' , 'action' => trans('home.view')  ])
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("coursereviews.review") }}</th>
     <td>{{ nl2br($item->review) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("coursereviews.rating") }}</th>
     <td>{{ nl2br($item->rating) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("coursereviews.type") }}</th>
     <td>
    {{ $item->type == 1 ? trans("coursereviews.Yes") : trans("coursereviews.No")  }}
     </td>
    </tr>
    <tr>
    <th width="200">{{ trans("coursereviews.manual_name") }}</th>
     <td>{{ nl2br($item->manual_name) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("coursereviews.manual_image") }}</th>
     <td>{{ nl2br($item->manual_image) }}</td>
    </tr>
  </table>
          @include('admin.coursereviews.buttons.delete' , ['id' => $item->id])
        @include('admin.coursereviews.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
