@extends(layoutExtend())
  @section('title')
    {{ trans('talksreviews.talksreviews') }} {{ trans('home.view') }}
@endsection
  @section('content')
    @component(layoutForm() , ['title' => trans('talksreviews.talksreviews') , 'model' => 'talksreviews' , 'action' => trans('home.view')  ])
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("talksreviews.review") }}</th>
     <td>{{ nl2br($item->review) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("talksreviews.rating") }}</th>
     <td>{{ nl2br($item->rating) }}</td>
    </tr>
  </table>
          @include('admin.talksreviews.buttons.delete' , ['id' => $item->id])
        @include('admin.talksreviews.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
