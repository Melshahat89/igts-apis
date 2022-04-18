		<tr>
			<th>
			{{ trans( "eventsdata.eventsdata") }}
			</th>
			<td>
				@php $eventsdata = App\Application\Model\Eventsdata::find($item->eventsdata_id);  @endphp
				{{ is_json($eventsdata->name) ? getDefaultValueKey($eventsdata->name) :  $eventsdata->name}}
			</td>
		</tr>
