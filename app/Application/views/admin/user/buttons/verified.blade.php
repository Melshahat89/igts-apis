
@switch($verified)
    @case(0)
        <label class="btn btn-danger">Not Verified </label>
        @break
    @case(1)
        <label class="btn btn-success">Verified</label>
        @break

    @default
        <label class="btn btn-warning">Pending</label>
@endswitch
