@php $user = App\Application\Model\User::find($emp_id);  @endphp
{{ isset($user->email) ? (is_json($user->email) ? getDefaultValueKey($user->email) :  $user->email) : ''}}