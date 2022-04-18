@switch($type)
    @case(1)
        <label class="btn btn-warning">ONLINE</label>
        @break
    @case(2)
        <label class="btn btn-success">OFFLINE</label>
        @break
    @default
        <label class="btn btn-warning">ONLINE</label>
@endswitch
