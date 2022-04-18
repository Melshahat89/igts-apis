@extends(layoutExtend('website'))
  @section('title')
    {{ trans('promotionactive.promotionactive') }} {{ trans('home.view') }}
@endsection
  @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('promotionactive') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("promotionactive.status") }}</th>
     <td>
    {{ $item->status == 1 ? trans("promotionactive.Yes") : trans("promotionactive.No")  }}
     </td>
    </tr>
  </table>
          @include('website.promotionactive.buttons.delete' , ['id' => $item->id])
        @include('website.promotionactive.buttons.edit' , ['id' => $item->id])
</div>
@endsection
