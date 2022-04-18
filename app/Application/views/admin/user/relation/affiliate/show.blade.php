		<tr>
			<th>
			{{ trans( "user.affiliate") }}
			</th>
			<td>
				@php $user = App\Application\Model\User::find($item->affiliate_id);  @endphp
				{{ is_json($user->email) ? getDefaultValueKey($user->email) :  $user->email}}
			</td>
		</tr>
