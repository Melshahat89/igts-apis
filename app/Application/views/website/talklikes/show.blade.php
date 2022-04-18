@extends(layoutExtend('website'))
  @section('title')
    {{ trans('talklikes.talklikes') }} {{ trans('home.view') }}
@endsection
  @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('talklikes') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("talklikes.comment") }}</th>
     <td>{{ nl2br($item->comment) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("talklikes.status") }}</th>
     <td>
    {{ $item->status == 1 ? trans("talklikes.Yes") : trans("talklikes.No")  }}
     </td>
    </tr>
  </table>
          @include('website.talklikes.buttons.delete' , ['id' => $item->id])
        @include('website.talklikes.buttons.edit' , ['id' => $item->id])
</div>
@endsection
