@extends(layoutExtend())
  @section('title')
    {{ trans('promotionusers.promotionusers') }} {{ trans('home.view') }}
@endsection
  @section('content')
    @component(layoutForm() , ['title' => trans('promotionusers.promotionusers') , 'model' => 'promotionusers' , 'action' => trans('home.view')  ])
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("promotionusers.used") }}</th>
     <td>
    {{ $item->used == 1 ? trans("promotionusers.Yes") : trans("promotionusers.No")  }}
     </td>
    </tr>
  </table>
          @include('admin.promotionusers.buttons.delete' , ['id' => $item->id])
        @include('admin.promotionusers.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
