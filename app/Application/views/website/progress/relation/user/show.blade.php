		<tr>
			<th>
			{{ trans( "user.user") }}
			</th>
			<td>
				@php $user = App\Application\Model\User::find($item->user_id);  @endphp
				{{ is_json($user->email) ? getDefaultValueKey($user->email) :  $user->email}}
			</td>
		</tr>
