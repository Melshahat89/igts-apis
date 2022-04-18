		<tr>
			<th>
			{{ trans( "events.events") }}
			</th>
			<td>
				@php $events = App\Application\Model\Events::find($item->events_id);  @endphp
				{{ is_json($events->title) ? getDefaultValueKey($events->title) :  $events->title}}
			</td>
		</tr>
