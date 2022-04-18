@php $user = App\Application\Model\User::find($user_id);  @endphp
{{ isset($user->mobile) ? (is_json($user->mobile) ? getDefaultValueKey($user->mobile) :  $user->mobile) : ''}}