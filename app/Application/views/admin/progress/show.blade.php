@extends(layoutExtend())
  @section('title')
    {{ trans('progress.progress') }} {{ trans('home.view') }}
@endsection
  @section('content')
    @component(layoutForm() , ['title' => trans('progress.progress') , 'model' => 'progress' , 'action' => trans('home.view')  ])
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("progress.percentage") }}</th>
     <td>{{ nl2br($item->percentage) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("progress.note") }}</th>
     <td>{{ nl2br($item->note) }}</td>
    </tr>
  </table>
          @include('admin.progress.buttons.delete' , ['id' => $item->id])
        @include('admin.progress.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
