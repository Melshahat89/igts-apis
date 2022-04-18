@extends(layoutExtend('website'))
  @section('title')
    {{ trans('courseresources.courseresources') }} {{ trans('home.view') }}
@endsection
  @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('courseresources') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
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
          @include('website.courseresources.buttons.delete' , ['id' => $item->id])
        @include('website.courseresources.buttons.edit' , ['id' => $item->id])
</div>
@endsection
