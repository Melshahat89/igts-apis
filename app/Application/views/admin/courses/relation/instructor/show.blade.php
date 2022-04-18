		<tr>
			<th>
			{{ trans( "instructors.instructors") }}
			</th>
			<td>
				@php $instructors = App\Application\Model\Categories::find($item->instructor_id);  @endphp
				{{ is_json($instructors->name) ? getDefaultValueKey($instructors->name) :  $instructors->name}}
			</td>
		</tr>
