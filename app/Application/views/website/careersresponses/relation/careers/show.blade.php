		<tr>
			<th>
			{{ trans( "careers.careers") }}
			</th>
			<td>
				@php $careers = App\Application\Model\Careers::find($item->careers_id);  @endphp
				{{ is_json($careers->title) ? getDefaultValueKey($careers->title) :  $careers->title}}
			</td>
		</tr>
