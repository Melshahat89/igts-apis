@extends(layoutExtend('website'))
  @section('title')
    {{ trans('careersresponses.careersresponses') }} {{ trans('home.view') }}
@endsection
  @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('careersresponses') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("careersresponses.name") }}</th>
     <td>{{ nl2br($item->name) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("careersresponses.email") }}</th>
     <td>{{ nl2br($item->email) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("careersresponses.mobile") }}</th>
     <td>{{ nl2br($item->mobile) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("careersresponses.file") }}</th>
     <td>
     <a href="{{ url(env("UPLOAD_PATH")."/".$item->file) }}">{{ $item->file }}</a>
     </td>
    </tr>
  </table>
          @include('website.careersresponses.buttons.delete' , ['id' => $item->id])
        @include('website.careersresponses.buttons.edit' , ['id' => $item->id])
</div>
@endsection
