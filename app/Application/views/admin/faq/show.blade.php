@extends(layoutExtend())

@section('title')
    {{ trans('faq.faq') }} {{ trans('home.view') }}
@endsection

@section('content')
    @component(layoutForm() , ['title' => trans('faq.faq') , 'model' => 'faq' , 'action' => trans('home.view')  ])
		 <table class="table table-bordered  table-striped" > 
				<tr>
				<th width="200">{{ trans("faq.group_id") }}</th>
					<td>{{ nl2br($item->group_id) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("faq.question") }}</th>
					<td>{{ nl2br($item->question_lang) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("faq.answer") }}</th>
					<td>{{ nl2br($item->answer_lang) }}</td>
				</tr>
		</table>

        @include('admin.faq.buttons.delete' , ['id' => $item->id])
        @include('admin.faq.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
