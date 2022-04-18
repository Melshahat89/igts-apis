@extends(layoutExtend('website'))
  @section('title')
    {{ trans('searchkeys.searchkeys') }} {{ trans('home.view') }}
@endsection
  @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('searchkeys') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("searchkeys.word") }}</th>
     <td>{{ nl2br($item->word) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("searchkeys.ip") }}</th>
     <td>{{ nl2br($item->ip) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("searchkeys.country") }}</th>
     <td>{{ nl2br($item->country) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("searchkeys.city") }}</th>
     <td>{{ nl2br($item->city) }}</td>
    </tr>
  </table>
          @include('website.searchkeys.buttons.delete' , ['id' => $item->id])
        @include('website.searchkeys.buttons.edit' , ['id' => $item->id])
</div>
@endsection
