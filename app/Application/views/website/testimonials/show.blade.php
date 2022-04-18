@extends(layoutExtend('website'))

@section('title')
    {{ trans('testimonials.testimonials') }} {{ trans('home.view') }}
@endsection

@section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('testimonials') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
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

        @include('website.testimonials.buttons.delete' , ['id' => $item->id])
        @include('website.testimonials.buttons.edit' , ['id' => $item->id])
</div>
@endsection
