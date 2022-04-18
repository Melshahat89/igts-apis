@extends(layoutExtend('website'))
  @section('title')
    {{ trans('businessdata.businessdata') }} {{ trans('home.view') }}
@endsection
  @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('businessdata') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("businessdata.name") }}</th>
     <td>{{ nl2br($item->name_lang) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("businessdata.discount_type") }}</th>
     <td>{{ nl2br($item->discount_type) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("businessdata.discount_value") }}</th>
     <td>{{ nl2br($item->discount_value) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("businessdata.automatically_license") }}</th>
     <td>
    {{ $item->automatically_license == 1 ? trans("businessdata.Yes") : trans("businessdata.No")  }}
     </td>
    </tr>
    <tr>
    <th width="200">{{ trans("businessdata.logo") }}</th>
     <td>
     <img src="{{ small($item->logo) }}" width="100" />
     </td>
    </tr>
    <tr>
    <th width="200">{{ trans("businessdata.status") }}</th>
     <td>{{ nl2br($item->status) }}</td>
    </tr>
  </table>
          @include('website.businessdata.buttons.delete' , ['id' => $item->id])
        @include('website.businessdata.buttons.edit' , ['id' => $item->id])
</div>
@endsection
