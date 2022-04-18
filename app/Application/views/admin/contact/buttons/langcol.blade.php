@if($user_id == 0)
    {{ trans('contact.Visitor') }}
@else
    <a href="{{ url('lazyadmin/user/item/'.$user_id) }}"><i class="fa fa-user"></i></a>
@endif