@extends(layoutExtend('website'))
  @section('title')
    {{ trans('coursewishlist.coursewishlist') }} {{ trans('home.view') }}
@endsection
  @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('coursewishlist') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("coursewishlist.note") }}</th>
     <td>{{ nl2br($item->note) }}</td>
    </tr>
  </table>
          @include('website.coursewishlist.buttons.delete' , ['id' => $item->id])
        @include('website.coursewishlist.buttons.edit' , ['id' => $item->id])
</div>
@endsection
