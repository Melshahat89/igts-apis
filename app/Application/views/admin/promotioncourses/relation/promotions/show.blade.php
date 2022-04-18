		<tr>
			<th>
			{{ trans( "promotions.promotions") }}
			</th>
			<td>
				@php $promotions = App\Application\Model\Promotions::find($item->promotions_id);  @endphp
				{{ is_json($promotions->code) ? getDefaultValueKey($promotions->code) :  $promotions->code}}
			</td>
		</tr>
