@extends(layoutExtend('website'))
  @section('title')
    {{ trans('talksreviews.talksreviews') }} {{ trans('home.view') }}
@endsection
  @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('talksreviews') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
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
          @include('website.talksreviews.buttons.delete' , ['id' => $item->id])
        @include('website.talksreviews.buttons.edit' , ['id' => $item->id])
</div>
@endsection
