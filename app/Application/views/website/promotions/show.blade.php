@extends(layoutExtend('website'))

@section('title')
    {{ trans('promotions.promotions') }} {{ trans('home.view') }}
@endsection

@section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('promotions') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
		 <table class="table table-bordered  table-striped" > 
				<tr>
				<th width="200">{{ trans("promotions.title") }}</th>
					<td>{{ nl2br($item->title) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("promotions.description") }}</th>
					<td>{{ nl2br($item->description) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("promotions.type") }}</th>
					<td>{{ nl2br($item->type) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("promotions.value_for_egp") }}</th>
					<td>{{ nl2br($item->value_for_egp) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("promotions.value_for_other_currencies") }}</th>
					<td>{{ nl2br($item->value_for_other_currencies) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("promotions.code") }}</th>
					<td>{{ nl2br($item->code) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("promotions.start_date") }}</th>
					<td>{{ nl2br($item->start_date) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("promotions.expiration_date") }}</th>
					<td>{{ nl2br($item->expiration_date) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("promotions.active") }}</th>
					<td>
				{{ $item->active == 1 ? trans("promotions.Yes") : trans("promotions.No")  }}
					</td>
				</tr>
				<tr>
				<th width="200">{{ trans("promotions.promotion_limit") }}</th>
					<td>{{ nl2br($item->promotion_limit) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("promotions.promotion_usage") }}</th>
					<td>{{ nl2br($item->promotion_usage) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("promotions.publish_as_notification") }}</th>
					<td>
				{{ $item->publish_as_notification == 1 ? trans("promotions.Yes") : trans("promotions.No")  }}
					</td>
				</tr>
				<tr>
				<th width="200">{{ trans("promotions.notification_message") }}</th>
					<td>{{ nl2br($item->notification_message) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("promotions.include_courses") }}</th>
					<td>
				{{ $item->include_courses == 1 ? trans("promotions.Yes") : trans("promotions.No")  }}
					</td>
				</tr>
		</table>

        @include('website.promotions.buttons.delete' , ['id' => $item->id])
        @include('website.promotions.buttons.edit' , ['id' => $item->id])
</div>
@endsection
