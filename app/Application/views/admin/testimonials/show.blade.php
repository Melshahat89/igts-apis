@extends(layoutExtend())

@section('title')
    {{ trans('testimonials.testimonials') }} {{ trans('home.view') }}
@endsection

@section('content')
    @component(layoutForm() , ['title' => trans('testimonials.testimonials') , 'model' => 'testimonials' , 'action' => trans('home.view')  ])
		 <table class="table table-bordered  table-striped" > 
				<tr>
				<th width="200">{{ trans("testimonials.name") }}</th>
					<td>{{ nl2br($item->name_lang) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("testimonials.title") }}</th>
					<td>{{ nl2br($item->title_lang) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("testimonials.message") }}</th>
					<td>{{ nl2br($item->message_lang) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("testimonials.image") }}</th>
					<td>
					<img src="{{ small($item->image) }}" width="100" />
					</td>
				</tr>
		</table>

        @include('admin.testimonials.buttons.delete' , ['id' => $item->id])
        @include('admin.testimonials.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
