		<tr>
			<th>
			{{ trans( "categories.categories") }}
			</th>
			<td>
				@php $categories = App\Application\Model\Categories::find($item->categories_id);  @endphp
				{{ is_json($categories->name) ? getDefaultValueKey($categories->name) :  $categories->name}}
			</td>
		</tr>
