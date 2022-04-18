@extends(layoutExtend('website'))

@section('title')
    {{ trans('faq.faq') }} {{ trans('home.view') }}
@endsection

@section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('faq') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
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

        @include('website.faq.buttons.delete' , ['id' => $item->id])
        @include('website.faq.buttons.edit' , ['id' => $item->id])
</div>
@endsection
