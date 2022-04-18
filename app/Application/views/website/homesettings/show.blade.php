@extends(layoutExtend('website'))

@section('title')
    {{ trans('homesettings.homesettings') }} {{ trans('home.view') }}
@endsection

@section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('homesettings') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
		 <table class="table table-bordered  table-striped" > 
				<tr>
				<th width="200">{{ trans("homesettings.bundles") }}</th>
					<td>
				{{ $item->bundles == 1 ? trans("homesettings.Yes") : trans("homesettings.No")  }}
					</td>
				</tr>
				<tr>
				<th width="200">{{ trans("homesettings.featured_courses") }}</th>
					<td>
				{{ $item->featured_courses == 1 ? trans("homesettings.Yes") : trans("homesettings.No")  }}
					</td>
				</tr>
				<tr>
				<th width="200">{{ trans("homesettings.events") }}</th>
					<td>
				{{ $item->events == 1 ? trans("homesettings.Yes") : trans("homesettings.No")  }}
					</td>
				</tr>
				<tr>
				<th width="200">{{ trans("homesettings.talks") }}</th>
					<td>
				{{ $item->talks == 1 ? trans("homesettings.Yes") : trans("homesettings.No")  }}
					</td>
				</tr>
		</table>

        @include('website.homesettings.buttons.delete' , ['id' => $item->id])
        @include('website.homesettings.buttons.edit' , ['id' => $item->id])
</div>
@endsection
