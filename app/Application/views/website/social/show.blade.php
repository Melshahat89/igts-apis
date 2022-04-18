@extends(layoutExtend('website'))

@section('title')
    {{ trans('social.social') }} {{ trans('home.view') }}
@endsection

@section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('social') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
		 <table class="table table-bordered  table-striped" > 
				<tr>
				<th width="200">{{ trans("social.user_id") }}</th>
					<td>{{ nl2br($item->user_id) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("social.provider") }}</th>
					<td>{{ nl2br($item->provider) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("social.identifier") }}</th>
					<td>{{ nl2br($item->identifier) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("social.profile_cache") }}</th>
					<td>{{ nl2br($item->profile_cache) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("social.session_data") }}</th>
					<td>{{ nl2br($item->session_data) }}</td>
				</tr>
		</table>

        @include('website.social.buttons.delete' , ['id' => $item->id])
        @include('website.social.buttons.edit' , ['id' => $item->id])
</div>
@endsection
