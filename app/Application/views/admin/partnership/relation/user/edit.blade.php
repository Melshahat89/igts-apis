<?php
//dd($item);
?>

<div class="form-group {{ $errors->has("user_id") ? "has-error" : "" }}">
    <label for="user_id">{{ trans( "user.user") }}</label>
    @php $users = App\Application\Model\User::where(function ($query) {
    $query->where('group_id', App\Application\Model\User::TYPE_INSTITUTION)
    ->orWhere('group_id', App\Application\Model\User::TYPE_INDIVIDUAL)
    ;
    })->pluck("email" ,"id")->all() @endphp
    @php $user_id = (isset($item) && $item->user_id) ? $item->user_id : null @endphp
    <select name="user_id" class="form-control">
        @foreach( $users as $key => $relatedItem)
        <option value="{{ $key }}" {{ $key == $user_id  ? "selected" : "" }}> {{ is_json($relatedItem) ? getDefaultValueKey($relatedItem) :  $relatedItem}}</option>
        @endforeach
    </select>
    @if ($errors->has("user_id"))
    <div class="alert alert-danger">
        <span class="help-block">
            <strong>{{ $errors->first("user_id") }}</strong>
        </span>
    </div>
    @endif
</div>