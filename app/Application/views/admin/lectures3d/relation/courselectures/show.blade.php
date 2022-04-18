		<tr>
			<th>
			{{ trans( "courselectures.courselectures") }}
			</th>
			<td>
				@php $courselectures = App\Application\Model\Courselectures::find($item->courselectures_id);  @endphp
				{{ is_json($courselectures->title) ? getDefaultValueKey($courselectures->title) :  $courselectures->title}}
			</td>
		</tr>
