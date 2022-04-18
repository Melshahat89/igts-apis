@extends(layoutExtend('website'))
  @section('title')
    {{ trans('promotionusers.promotionusers') }} {{ trans('home.view') }}
@endsection
  @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('promotionusers') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("promotionusers.used") }}</th>
     <td>
    {{ $item->used == 1 ? trans("promotionusers.Yes") : trans("promotionusers.No")  }}
     </td>
    </tr>
  </table>
          @include('website.promotionusers.buttons.delete' , ['id' => $item->id])
        @include('website.promotionusers.buttons.edit' , ['id' => $item->id])
</div>
@endsection
