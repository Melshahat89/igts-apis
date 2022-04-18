@extends(layoutExtend())

@section('title')
    {{ trans('categories.categories') }} {{ trans('home.view') }}
@endsection

@section('content')
    @component(layoutForm() , ['title' => trans('categories.categories') , 'model' => 'categories' , 'action' => trans('home.view')  ])
		 <table class="table table-bordered  table-striped" > 
				<tr>
				<th width="200">{{ trans("categories.name") }}</th>
					<td>{{ nl2br($item->name_lang) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("categories.slug") }}</th>
					<td>{{ nl2br($item->slug) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("categories.desc") }}</th>
					<td>{{ nl2br($item->desc_lang) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("categories.parent_id") }}</th>
					<td>{{ nl2br($item->parent_id) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("categories.sort") }}</th>
					<td>{{ nl2br($item->sort) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("categories.status") }}</th>
					<td>
				{{ $item->status == 1 ? trans("categories.Yes") : trans("categories.No")  }}
					</td>
				</tr>
				<tr>
				<th width="200">{{ trans("categories.show_home") }}</th>
					<td>
				{{ $item->show_home == 1 ? trans("categories.Yes") : trans("categories.No")  }}
					</td>
				</tr>
				<tr>
				<th width="200">{{ trans("categories.show_menu") }}</th>
					<td>
				{{ $item->show_menu == 1 ? trans("categories.Yes") : trans("categories.No")  }}
					</td>
				</tr>
{{--				<tr>--}}
{{--				<th width="200">{{ trans("categories.m_image") }}</th>--}}
{{--					<td>--}}
{{--					<img src="{{ small($item->m_image) }}" width="100" />--}}
{{--					</td>--}}
{{--				</tr>--}}
{{--				<tr>--}}
{{--				<th width="200">{{ trans("categories.d_image") }}</th>--}}
{{--					<td>--}}
{{--					<img src="{{ small($item->d_image) }}" width="100" />--}}
{{--					</td>--}}
{{--				</tr>--}}
				<tr>
				<th width="200">{{ trans("categories.image") }}</th>
					<td>
					<img src="{{ small($item->image) }}" width="100" />
					</td>
				</tr>
			 <tr>
			 <th width="200">{{ trans("categories.class") }}</th>
			 <td>{{ nl2br($item->class) }}</td>
			 </tr>
		</table>

        @include('admin.categories.buttons.delete' , ['id' => $item->id])
        @include('admin.categories.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
