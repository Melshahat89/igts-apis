@extends(layoutExtend())
  @section('title')
    {{ trans('talklikes.talklikes') }} {{ trans('home.view') }}
@endsection
  @section('content')
    @component(layoutForm() , ['title' => trans('talklikes.talklikes') , 'model' => 'talklikes' , 'action' => trans('home.view')  ])
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
          @include('admin.talklikes.buttons.delete' , ['id' => $item->id])
        @include('admin.talklikes.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
