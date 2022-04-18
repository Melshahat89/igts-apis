@extends(layoutExtend('website'))
  @section('title')
    {{ trans('businessdomains.businessdomains') }} {{ trans('home.view') }}
@endsection
  @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('businessdomains') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("businessdomains.domainname") }}</th>
     <td>{{ nl2br($item->domainname) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("businessdomains.status") }}</th>
     <td>
    {{ $item->status == 1 ? trans("businessdomains.Yes") : trans("businessdomains.No")  }}
     </td>
    </tr>
  </table>
          @include('website.businessdomains.buttons.delete' , ['id' => $item->id])
        @include('website.businessdomains.buttons.edit' , ['id' => $item->id])
</div>
@endsection
