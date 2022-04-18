@extends(layoutExtend('website'))
  @section('title')
    {{ trans('progress.progress') }} {{ trans('home.view') }}
@endsection
  @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('progress') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
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
          @include('website.progress.buttons.delete' , ['id' => $item->id])
        @include('website.progress.buttons.edit' , ['id' => $item->id])
</div>
@endsection
