@extends(layoutExtend())

@section('title')
    {{ trans('institution.institution') }} {{ trans('home.view') }}
@endsection

@section('content')
    @component(layoutForm() , ['title' => trans('institution.institution') , 'model' => 'institution' , 'action' => trans('home.view')  ])
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

        @include('admin.institution.buttons.delete' , ['id' => $item->id])
        @include('admin.institution.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
