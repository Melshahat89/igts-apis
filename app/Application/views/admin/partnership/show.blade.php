@extends(layoutExtend())

@section('title')
    {{ trans('partnership.partnership') }} {{ trans('home.view') }}
@endsection

@section('content')
    @component(layoutForm() , ['title' => trans('partnership.partnership') , 'model' => 'partnership' , 'action' => trans('home.view')  ])
		 <table class="table table-bordered  table-striped" > 
				<tr>
				<th width="200">{{ trans("partnership.setting") }}</th>
					<td>{{ nl2br($item->setting) }}</td>
				</tr>
		</table>

        @include('admin.partnership.buttons.delete' , ['id' => $item->id])
        @include('admin.partnership.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
