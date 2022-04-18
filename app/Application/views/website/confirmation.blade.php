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



<div class="bread-crumb">
    <div class="wrapper">
        <a href="/"> {{trans('website.home')}} </a> > <span>{{trans('website.Payments')}}</span>
    </div>
</div>

<div class="page-title general-gred">
    <div class="container">
        <h1><{{trans('website.Payments')}}</h1>
    </div>
</div>

<?php if($txnResponseCode == "true"){?>

    <section class="mycart-container"  id="steps">
        <div class="container">
            <div class="my-items mt-40">
                <div class="row">
                    <div class="col-md-12">
                        <div class="Summary">
                            <h4><strong class="successfully"> {{ trans('website.Thank you! Your request was successfully submitted!') }} </strong></h4>
                            <div class="total">
                                <h5><strong> {{ trans('website.Your order number is') }} <span><?php echo $orderId; ?></span></strong></h5>
                                <h5><strong>{{ trans('website.Your request information will be sent to your e-mail') }}  <span><?php echo Auth::user()->email;?></strong></h5>
                            </div>
                            <div class="coupon">
                                <p>
                                {!! trans('website.Do you need help?') !!}
                                </p>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-40 next-step">
                        <div class="flexLeft">
                            <a class="view-more-section" href="{{ url('/account/myCourses') }}"><i class="flaticon-left-arrow"></i>
                                <span> {{ trans('website.mycourses') }} </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
    </section>

<?php }else{?>
    <section class="mycart-container"  id="steps">
        <div class="container">
            <div class="my-items mt-40">
                <div class="row">
                    <div class="col-md-12">
                        <div class="Summary">
                            <h4><strong style="color: red" class="successfully">
                            {{ trans('website.A payment error has occurred') }}
                            </strong></h4>
                            <div class="total">
                                <h5><strong>{{ trans('website.Error Message') }} : {{$data_message}}</strong></h5>
                                <br>
                            </div>
                            <div class="coupon">
                                <p>
                                {!! trans('website.Do you need help?') !!}
                                </p>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-40 next-step">
                        <div class="flexLeft">
                            <a class="view-more-section" href="{{ url('/cart') }}"><i class="flaticon-left-arrow"></i>
                                <span>{{ trans('website.Back to cart') }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
    </section>

<?php }?>



@endsection
