@extends(layoutExtend())
  @section('title')
    {{ trans('coursewishlist.coursewishlist') }} {{ trans('home.view') }}
@endsection
  @section('content')
    @component(layoutForm() , ['title' => trans('coursewishlist.coursewishlist') , 'model' => 'coursewishlist' , 'action' => trans('home.view')  ])
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("coursewishlist.note") }}</th>
     <td>{{ nl2br($item->note) }}</td>
    </tr>
  </table>
          @include('admin.coursewishlist.buttons.delete' , ['id' => $item->id])
        @include('admin.coursewishlist.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
