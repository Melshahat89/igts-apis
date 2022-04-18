		<tr>
			<th>
			{{ trans( "courses.courses") }}
			</th>
			<td>
				@php $courses = App\Application\Model\Courses::find($item->courses_id);  @endphp
				{{ is_json($courses->title) ? getDefaultValueKey($courses->title) :  $courses->title}}
			</td>
		</tr>
