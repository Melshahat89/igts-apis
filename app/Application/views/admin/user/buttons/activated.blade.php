@switch($activated)
    @case(0)
        <label class="btn btn-danger">Not activated </label>
        @break
    @case(1)
        <label class="btn btn-success">Activated</label>
        @break

    @default
        <label class="btn btn-warning">Pending</label>
@endswitch
