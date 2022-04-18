		<tr>
			<th>
			{{ trans( "promotions.promotions") }}
			</th>
			<td>
				@php $promotions = App\Application\Model\Promotions::find($item->promotions_id);  @endphp
				{{ is_json($promotions->title) ? getDefaultValueKey($promotions->title) :  $promotions->title}}
			</td>
		</tr>
