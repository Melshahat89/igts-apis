@extends(layoutExtend('website'))

@section('title')
    {{ trans('becomeinstructor.becomeinstructor') }} {{ trans('home.view') }}
@endsection

@section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('becomeinstructor') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
		 <table class="table table-bordered  table-striped" > 
				<tr>
				<th width="200">{{ trans("becomeinstructor.name") }}</th>
					<td>{{ nl2br($item->name) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("becomeinstructor.email") }}</th>
					<td>{{ nl2br($item->email) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("becomeinstructor.phone") }}</th>
					<td>{{ nl2br($item->phone) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("becomeinstructor.title") }}</th>
					<td>{{ nl2br($item->title) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("becomeinstructor.specialist") }}</th>
					<td>{{ nl2br($item->specialist) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("becomeinstructor.yourCourses") }}</th>
					<td>{{ nl2br($item->yourCourses) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("becomeinstructor.cv") }}</th>
					<td>
					<a href="{{ url(env("UPLOAD_PATH")."/".$item->cv) }}">{{ $item->cv }}</a>
					</td>
				</tr>
				<tr>
				<th width="200">{{ trans("becomeinstructor.socialAccount") }}</th>
					<td>{{ nl2br($item->socialAccount) }}</td>
				</tr>
		</table>

        @include('website.becomeinstructor.buttons.delete' , ['id' => $item->id])
        @include('website.becomeinstructor.buttons.edit' , ['id' => $item->id])
</div>
@endsection
