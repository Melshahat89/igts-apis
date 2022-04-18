		<tr>
			<th>
			{{ trans( "coursesections.coursesections") }}
			</th>
			<td>
				@php $coursesections = App\Application\Model\Coursesections::find($item->coursesections_id);  @endphp
				{{ is_json($coursesections->title) ? getDefaultValueKey($coursesections->title) :  $coursesections->title}}
			</td>
		</tr>
