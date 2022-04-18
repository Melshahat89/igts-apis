@extends(layoutExtend())
  @section('title')
    {{ trans('businessgroupsusers.businessgroupsusers') }} {{ trans('home.view') }}
@endsection
  @section('content')
    @component(layoutForm() , ['title' => trans('businessgroupsusers.businessgroupsusers') , 'model' => 'businessgroupsusers' , 'action' => trans('home.view')  ])
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
          @include('admin.businessgroupsusers.buttons.delete' , ['id' => $item->id])
        @include('admin.businessgroupsusers.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
