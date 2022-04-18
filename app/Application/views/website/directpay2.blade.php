@extends(layoutExtend('website'))
@section('title')
    {{  trans('home.HomeTitle') }}
@endsection
@section('description')
    {{ trans('website.Footer IGTS') }}
@endsection
@section('keywords')
    
@endsection
@section('content')

@include('website.theme.bootstrap.layout.igts.shared.innerPagesHead', ['title' => trans('page.home.direct pay')]) 

<section class="sec sec_pad_top sec_pad_bottom">
<div class="wrapper row d-flex justify-content-center">

    @if($error)
        <section class="sec sec_pad_top sec_pad_bottom">
            <div class="wrapper row d-flex justify-content-center">
                <p>{{$error}}</p>
            </div>

            @if(!Auth::check())
                <div class="wrapper row d-flex justify-content-center">
                    <button type="button"  data-dismiss="modal" data-remote="/login" data-toggle="modal" data-target="#loginModal" class="button button_primary_reverse text_capitalize">{{trans('home.signin')}}</button>
                </div>
            @endif
        </section>

    @else

        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

        <div class="page-content container">
            <div class="page-header text-blue-d2">
                <h1 class="page-title text-secondary-d1">
                    {{trans('orders.Invoice')}}
                    <small class="page-info">
                        <i class="fa fa-angle-double-right text-80"></i>
                        {{trans('orders.ID')}}{{$order->id}}
                    </small>
                </h1>
            </div>

            <div class="container px-0">
                <div class="row mt-4">
                    <div class="col-12 col-lg-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center text-150">
                                    <span class="text-default-d3">{{trans('orders.Order Details')}}</span>
                                </div>
                            </div>
                        </div>
                        <!-- .row -->

                        <hr class="row brc-default-l1 mx-n1 mb-4" />

                        <div class="row">
                            <div class="col-sm-6">
                                <div>
                                    <span class="text-sm text-grey-m2 align-middle">{{trans('orders.To')}}</span>
                                    <span class="text-600 text-110 text-blue align-middle">{{$order->user->email}}</span>
                                </div>
                                <div class="text-grey-m2">
                                    <div class="my-1">
                                        {{$order->user->name}}
                                    </div>
                                    <div class="my-1">
                                        {{$order->user->mobile}}
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->

                            <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                                <hr class="d-sm-none" />
                                <div class="text-grey-m2">
                                    <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                        {{trans('orders.Invoice')}}
                                    </div>

                                    <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">{{trans('orders.ID')}}</span>{{$order->id}}</div>

                                    <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">{{trans('orders.Issue Date')}}</span>{{$order->created_at}}</div>

                                    <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">{{trans('orders.Status')}}</span><span class="badge badge-warning badge-pill px-25">{{trans('orders.Unpaid')}}</span></div>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>

                        <div class="mt-4">
                            <div class="row text-600 text-white bgc-default-tp1 py-25">
                                <div class="d-none d-sm-block col-1">#</div>
                                <div class="col-9 col-sm-5">{{trans('orders.Item')}}</div>
                                <div class="d-none d-sm-block col-4 col-sm-2">{{trans('orders.Qty')}}</div>
                                <div class="d-none d-sm-block col-sm-2">{{trans('orders.Unit Price')}}</div>
                                <div class="col-2">{{trans('orders.Amount')}}</div>
                            </div>

                            <div class="text-95 text-secondary-d3">
                                @php $counter = 1; $sum=0;@endphp
                                @foreach($order->ordersposition as $item)
                                    @php $sum += $item->amount; @endphp
                                    <div class="row mb-2 mb-sm-0 py-25">
                                        <div class="d-none d-sm-block col-1">{{$counter++}}</div>
                                        <div class="col-9 col-sm-5">{{ ($item->certificate_id && $item->certificates) ? $item->certificates->title_lang : (($item->courses_id) && $item->courses ? ($item->courses->title_lang) : ('DIRECT PAY'))  }}</div>
                                        <div class="d-none d-sm-block col-2">--</div>
                                        <div class="d-none d-sm-block col-2 text-95">{{$item->amount}}
                                            @if(isset($order->payments))
                                                {{ ($order->payments->currency_id == '34') ? 'EGP' : '$' }}
                                            @else
                                                {{ getCurrency() }}
                                            @endif
                                        </div>
                                        <div class="col-2 text-secondary-d2">{{$item->amount}}
                                            @if(isset($order->payments))
                                                {{ ($order->payments->currency_id == '34') ? 'EGP' : '$' }}
                                            @else
                                                {{ getCurrency() }}
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="row border-b-2 brc-default-l2"></div>

                            <div class="row mt-3">

                                <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">

                                    <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                        <div class="col-7 text-right">
                                            {{trans('orders.Total Amount')}}
                                        </div>
                                        <div class="col-5">
                                            <span class="text-150 text-success-d3 opacity-2">
                                                @if(isset($order->payments))
                                                    {{$order->payments->amount}} {{ ($order->payments->currency_id == '34') ? 'EGP' : '$' }}
                                                @else
                                                    {{$sum}} {{ getCurrency() }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr />

                            <div>
                                <a href="javascript:void(0)" data-dismiss="modal" data-toggle="modal" data-target="#directBuyModal" class="btn btn-info btn-bold px-4 float-right mt-3 mt-lg-0">{{trans('courses.pay now')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endif

    <div class="modal fade" id="directBuyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header flexRight">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:black; font-weight: bold; font-size: 35px;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0 p-0">
                <div>

                    {{-- // payments methods --}}
                    <div id="PaymentsMethods">
                        <div class="spinner-border" id="loading-spinner" style="margin-left: 50%;display:none;" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="section_title_1 mt-3 direct-buy-modal-title">
                            <h4><i class="fa fa-lock" aria-hidden="true" style="font-size: 33px; margin-right:10px; color: #1f8ebb;"></i> <span style="font-size: 33px;"> {{ trans('website.secure checkout') }} </h4>
                        </div>
                        <div class="row" style="width: 100%;">

                        @foreach($paymentMethods as $paymentMethod)
                            <div class="col-md-5 item-card rounded-2 payment-method-card-modal paymentmethod {{ isset($paymentMethod->class) ? $paymentMethod->class : '' }}">
                                <a class="paymentmethod {{ isset($paymentMethod->class) ? $paymentMethod->class : '' }}" href="{{ !strpos($paymentMethod->action, '(') ? '/' . $paymentMethod->action . '/' . $order->id : 'javascript: void(0)' }}" onclick="{{$paymentMethod->action}}">
                                    <div class="d-flex justify-content-center paymentmethod {{ isset($paymentMethod->class) ? $paymentMethod->class : '' }}">
                                        <img class="payment-method-image-modal paymentmethod {{ isset($paymentMethod->class) ? $paymentMethod->class : '' }}" src="{{$paymentMethod->logo}}">
                                    </div>
                                    <span class="d-flex justify-content-center mt-2 paymentmethod {{ isset($paymentMethod->class) ? $paymentMethod->class : '' }}"><strong style="color: #4f4f4f;">{{$paymentMethod->title_lang}}</strong></span>
                                </a>
                            </div>
                        @endforeach

                        </div>
                    </div>

                    {{-- //Change Payments Div --}}

                    <div class="row ml-4 mt-4 mb-4" id="ChangePaymentsDiv" style="display: none;">

                        <div class="col-md-3">
                            <strong style="color: black;">{{ trans('website.payment method') }}</strong>
                        </div>

                        <div class="col-md-9">
                            <a href="javascript: void(0)" onclick="changeMethod()">{{ trans('website.choose another payment method') }}</a>
                        </div>


                    </div>
                    {{-- //Visa Div --}}
                    <div id="VisaDiv" style="display: none;">
                        <iframe style="height: 585px; width:-webkit-fill-available;" name="iframe1" id="visaiframe" webkitAllowFullScreen mozallowfullscreen allowfullscreen src="" title="0" byline="0" portrait="0" width="640" height="360" frameborder="0" allow="autoplay" oncontextmenu="return false"></iframe>
                    </div>

                </div>
            </div>
            <div class="modal-footer p-0 p-0 flexRight" style="border: none;">
                <br>
            </div>
        </div>
    </div>
</div>

</div>

</section>

@endsection