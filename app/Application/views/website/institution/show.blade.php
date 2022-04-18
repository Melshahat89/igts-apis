@extends(layoutExtend('website'))

@section('title')
    {{ trans('institution.institution') }} {{ trans('home.view') }}
@endsection

@section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('institution') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
		 <table class="table table-bordered  table-striped" > 
				<tr>
				<th width="200">{{ trans("institution.temp1") }}</th>
					<td>{{ nl2br($item->temp1) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("institution.temp2") }}</th>
					<td>{{ nl2br($item->temp2) }}</td>
				</tr>
		</table>

        @include('website.institution.buttons.delete' , ['id' => $item->id])
        @include('website.institution.buttons.edit' , ['id' => $item->id])
</div>
@endsection
