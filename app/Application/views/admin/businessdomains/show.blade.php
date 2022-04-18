@extends(layoutExtend())
  @section('title')
    {{ trans('businessdomains.businessdomains') }} {{ trans('home.view') }}
@endsection
  @section('content')
    @component(layoutForm() , ['title' => trans('businessdomains.businessdomains') , 'model' => 'businessdomains' , 'action' => trans('home.view')  ])
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
          @include('admin.businessdomains.buttons.delete' , ['id' => $item->id])
        @include('admin.businessdomains.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
