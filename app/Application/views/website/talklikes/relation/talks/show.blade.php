		<tr>
			<th>
			{{ trans( "talks.talks") }}
			</th>
			<td>
				@php $talks = App\Application\Model\Talks::find($item->talks_id);  @endphp
				{{ is_json($talks->title) ? getDefaultValueKey($talks->title) :  $talks->title}}
			</td>
		</tr>
