@extends(layoutExtend())

@section('title')
    {{ trans('homesettings.homesettings') }} {{ trans('home.view') }}
@endsection

@section('content')
    @component(layoutForm() , ['title' => trans('homesettings.homesettings') , 'model' => 'homesettings' , 'action' => trans('home.view')  ])
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

        @include('admin.homesettings.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
