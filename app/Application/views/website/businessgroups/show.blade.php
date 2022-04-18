@extends(layoutExtend('website'))
  @section('title')
    {{ trans('businessgroups.businessgroups') }} {{ trans('home.view') }}
@endsection
  @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('businessgroups') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
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
          @include('website.businessgroups.buttons.delete' , ['id' => $item->id])
        @include('website.businessgroups.buttons.edit' , ['id' => $item->id])
</div>
@endsection
