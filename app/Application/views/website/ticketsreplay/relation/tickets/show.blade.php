		<tr>
			<th>
			{{ trans( "tickets.tickets") }}
			</th>
			<td>
				@php $tickets = App\Application\Model\Tickets::find($item->tickets_id);  @endphp
				{{ is_json($tickets->title) ? getDefaultValueKey($tickets->title) :  $tickets->title}}
			</td>
		</tr>
