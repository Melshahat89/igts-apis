@extends(layoutExtend('website'))
  @section('title')
    {{ trans('eventsreviews.eventsreviews') }} {{ trans('home.view') }}
@endsection
  @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('eventsreviews') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("eventsreviews.review") }}</th>
     <td>{{ nl2br($item->review) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("eventsreviews.rating") }}</th>
     <td>{{ nl2br($item->rating) }}</td>
    </tr>
  </table>
          @include('website.eventsreviews.buttons.delete' , ['id' => $item->id])
        @include('website.eventsreviews.buttons.edit' , ['id' => $item->id])
</div>
@endsection
