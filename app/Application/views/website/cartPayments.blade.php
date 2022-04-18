@extends(layoutExtend('website'))
@section('title')
    {{ trans('website.My Cart') }} | {{ trans('home.MeduoHomeTitle') }}
@endsection
@section('description')
    {{ trans('home.MeduoHomeDescription') }}
@endsection
@section('keywords')
    {{ trans('home.MeduoHomeKeywords') }}
@endsection
@section('content')

    <div class="bread-crumb">
        <div class="container">
            <a href="/"> {{ trans('website.home') }} </a> > <span>{{ trans('website.My Cart') }}</span>
        </div>
    </div>

    <div class="page-title general-gred">
        <div class="container">
            <h1>{{ trans('website.My Cart') }}</h1>
            <p class="mt-15">
            </p>
        </div>
    </div>

    <section class="mycart-container" id="steps">

        <div class="container">
            <div class="steps">
                <div class="row">
                    <div class="col-md-4 ">
                        <div class="step-label">
                            <span>1</span>
                            {{ trans('website.Cart Items') }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="step-label active">
                            <span>2</span>
                            {{ trans('website.Payment Methods') }}
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <div class="step-label">
                            <span>3</span>
                            {{ trans('website.Order Confirmation') }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-items mt-40">
                <div class="row">
                @if (getShoppingCart()) 
                    <div class="col-md-6 mb-10">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <a class="" href="{{ url('/site/cartFinish') }}">

                                    <img alt="" class="w-100" style="height:100px"
                                        src="{{ asset('public/meduo') }}/images/visamaster.png">

                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <a class="" href="{{ url('/site/cartFinishKiosk/masary') }}">
                                    <img alt="" class="w-100" style="height:100px"
                                        src="{{ asset('public/meduo') }}/images/masary-logo.png">

                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <a class="" href="{{ url('/site/cartFinishKiosk/aman') }}">

                                    <img alt="" class="w-100" style="height:100px"
                                        src="{{ asset('public/meduo') }}/images/aman-logo.png">

                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <a class="" href="{{ url('/site/cartFinishVodafone') }}">
                                    <img alt="" class="w-100" style="height:100px"
                                        src="{{ asset('public/meduo') }}/images/vodafone-cash.jpeg">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <a class="" href="{{ url('/site/cartFinishFawry') }}">
                                    <img alt="" class="w-100" style="height:100px" src="{{ asset('public/meduo') }}/images/fawry.png">
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <a class="" href="{{ url('/site/cartFinishMobileWallet') }}">
                                    <img alt="" class="w-100" style="height:100px" src="{{ asset('public/meduo') }}/images/paymob.png">
                                </a>
                            </div>
                        </div>
                    </div>

                
                @else
                <div class="col-md-12">
                    {{ trans('website.Cart empty') }}
                </div>
                @endif
                <div class="col-md-12 mt-40 next-step">

                    <div class="text-left">
                        <a class="view-more-section pay" href="{{ url('/cart') }}">
                            <i class="flaticon-left-arrow"></i>
                            <span>
                                {{ trans('website.Back') }}
                            </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>



@endsection
