@extends(layoutExtend('website'))
  @section('title')
    {{ trans('businessgroupsusers.businessgroupsusers') }} {{ trans('home.view') }}
@endsection
  @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('businessgroupsusers') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("businessgroupsusers.status") }}</th>
     <td>
    {{ $item->status == 1 ? trans("businessgroupsusers.Yes") : trans("businessgroupsusers.No")  }}
     </td>
    </tr>
    <tr>
    <th width="200">{{ trans("businessgroupsusers.note") }}</th>
     <td>{{ nl2br($item->note) }}</td>
    </tr>
  </table>
          @include('website.businessgroupsusers.buttons.delete' , ['id' => $item->id])
        @include('website.businessgroupsusers.buttons.edit' , ['id' => $item->id])
</div>
@endsection
