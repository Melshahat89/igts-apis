@extends(layoutExtend('website'))
  @section('title')
    {{ trans('courselectures.courselectures') }} {{ trans('home.view') }}
@endsection
  @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('courselectures') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("courselectures.title") }}</th>
     <td>{{ nl2br($item->title_lang) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("courselectures.slug") }}</th>
     <td>{{ nl2br($item->slug) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("courselectures.description") }}</th>
     <td>{{ nl2br($item->description_lang) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("courselectures.video_file") }}</th>
     <td>{{ nl2br($item->video_file) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("courselectures.length") }}</th>
     <td>{{ nl2br($item->length) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("courselectures.is_free") }}</th>
     <td>
    {{ $item->is_free == 1 ? trans("courselectures.Yes") : trans("courselectures.No")  }}
     </td>
    </tr>
    <tr>
    <th width="200">{{ trans("courselectures.position") }}</th>
     <td>{{ nl2br($item->position) }}</td>
    </tr>
  </table>
          @include('website.courselectures.buttons.delete' , ['id' => $item->id])
        @include('website.courselectures.buttons.edit' , ['id' => $item->id])
</div>
@endsection
