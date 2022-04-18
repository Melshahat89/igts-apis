@extends(layoutExtend())

@section('title')
    {{ trans('paymentmethods.paymentmethods') }} {{ trans('home.view') }}
@endsection

@section('content')
    @component(layoutForm() , ['title' => trans('paymentmethods.paymentmethods') , 'model' => 'paymentmethods' , 'action' => trans('home.view')  ])
		 <table class="table table-bordered  table-striped" > 
				<tr>
				<th width="200">{{ trans("paymentmethods.group_id") }}</th>
					<td>{{ nl2br($item->group_id) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("paymentmethods.question") }}</th>
					<td>{{ nl2br($item->question_lang) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("paymentmethods.answer") }}</th>
					<td>{{ nl2br($item->answer_lang) }}</td>
				</tr>
		</table>

        @include('admin.paymentmethods.buttons.delete' , ['id' => $item->id])
        @include('admin.paymentmethods.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
