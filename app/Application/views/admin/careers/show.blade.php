@extends(layoutExtend())

@section('title')
    {{ trans('careers.careers') }} {{ trans('home.view') }}
@endsection

@section('content')
    @component(layoutForm() , ['title' => trans('careers.careers') , 'model' => 'careers' , 'action' => trans('home.view')  ])
		 <table class="table table-bordered  table-striped" > 
				<tr>
				<th width="200">{{ trans("careers.title") }}</th>
					<td>{{ nl2br($item->title_lang) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("careers.description") }}</th>
					<td>{{ nl2br($item->description_lang) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("careers.image") }}</th>
					<td>
					<img src="{{ small($item->image) }}" width="100" />
					</td>
				</tr>
		</table>

        @include('admin.careers.buttons.delete' , ['id' => $item->id])
        @include('admin.careers.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
