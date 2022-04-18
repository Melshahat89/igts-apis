@switch($status)
    @case(0)
        <label class="btn btn-danger">FAILED</label>
        @break
    @case(1)
        <label class="btn btn-warning">PENDING</label>
        @break
    @case(2)
        <label class="btn btn-success">SUCCEEDED</label>
        @break
    @case(3)
        <label class="btn btn-primary">DIRECTBUY</label>
        @break
    @case(4)
        <label class="btn btn-primary">KIOSK</label>
        @break
    @case(5)
        <label class="btn btn-primary">VODAFONE</label>
        <a href="{{url('lazyadmin/orders/enrollnow/'.$id)}}" class="btn btn-success"> Enroll Now </a>
        @break
    @case(6)
        <label class="btn btn-primary">FAWRY</label>
        @break
    @case(7)
        <label class="btn btn-primary">MOBILEWALLET</label>
        @break
    @case(8)
        <label class="btn btn-primary">OFFLINE - DIRECT</label>
        @break
    @default
        <label class="btn btn-warning">default</label>
@endswitch
