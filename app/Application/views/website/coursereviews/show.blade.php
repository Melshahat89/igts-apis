@extends(layoutExtend('website'))
  @section('title')
    {{ trans('coursereviews.coursereviews') }} {{ trans('home.view') }}
@endsection
  @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('coursereviews') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
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
          @include('website.coursereviews.buttons.delete' , ['id' => $item->id])
        @include('website.coursereviews.buttons.edit' , ['id' => $item->id])
</div>
@endsection
