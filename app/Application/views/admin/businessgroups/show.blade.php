@extends(layoutExtend())
  @section('title')
    {{ trans('businessgroups.businessgroups') }} {{ trans('home.view') }}
@endsection
  @section('content')
    @component(layoutForm() , ['title' => trans('businessgroups.businessgroups') , 'model' => 'businessgroups' , 'action' => trans('home.view')  ])
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("businessgroups.name") }}</th>
     <td>{{ nl2br($item->name) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("businessgroups.parent_id") }}</th>
     <td>{{ nl2br($item->parent_id) }}</td>
    </tr>
  </table>
          @include('admin.businessgroups.buttons.delete' , ['id' => $item->id])
        @include('admin.businessgroups.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
