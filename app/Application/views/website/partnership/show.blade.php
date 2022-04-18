@extends(layoutExtend('website'))

@section('title')
    {{ trans('partnership.partnership') }} {{ trans('home.view') }}
@endsection

@section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('partnership') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
		 <table class="table table-bordered  table-striped" > 
				<tr>
				<th width="200">{{ trans("partnership.setting") }}</th>
					<td>{{ nl2br($item->setting) }}</td>
				</tr>
		</table>

        @include('website.partnership.buttons.delete' , ['id' => $item->id])
        @include('website.partnership.buttons.edit' , ['id' => $item->id])
</div>
@endsection
