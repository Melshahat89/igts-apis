@extends(layoutExtend())
  @section('title')
    {{ trans('careersresponses.careersresponses') }} {{ trans('home.view') }}
@endsection
  @section('content')
    @component(layoutForm() , ['title' => trans('careersresponses.careersresponses') , 'model' => 'careersresponses' , 'action' => trans('home.view')  ])
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("careersresponses.name") }}</th>
     <td>{{ nl2br($item->name) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("careersresponses.email") }}</th>
     <td>{{ nl2br($item->email) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("careersresponses.mobile") }}</th>
     <td>{{ nl2br($item->mobile) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("careersresponses.file") }}</th>
     <td>
     <a href="{{ url(env("UPLOAD_PATH")."/".$item->file) }}">{{ $item->file }}</a>
     </td>
    </tr>
  </table>
          @include('admin.careersresponses.buttons.delete' , ['id' => $item->id])
        @include('admin.careersresponses.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
