@php $user = App\Application\Model\User::find($user_id);  @endphp
{{ is_json($user->name) ? getDefaultValueKey($user->name) :  $user->name}}