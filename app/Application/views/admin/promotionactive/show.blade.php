@extends(layoutExtend())
  @section('title')
    {{ trans('promotionactive.promotionactive') }} {{ trans('home.view') }}
@endsection
  @section('content')
    @component(layoutForm() , ['title' => trans('promotionactive.promotionactive') , 'model' => 'promotionactive' , 'action' => trans('home.view')  ])
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("promotionactive.status") }}</th>
     <td>
    {{ $item->status == 1 ? trans("promotionactive.Yes") : trans("promotionactive.No")  }}
     </td>
    </tr>
  </table>
          @include('admin.promotionactive.buttons.delete' , ['id' => $item->id])
        @include('admin.promotionactive.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
