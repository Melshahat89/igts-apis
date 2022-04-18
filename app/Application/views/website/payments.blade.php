@extends(layoutExtend('website'))
@section('title')
    {{  trans('home.HomeTitle') }} - {{ trans('website.My Cart') }}
@endsection
@section('description')
    {{ trans('website.Footer IGTS') }}
@endsection
@section('keywords')
    
@endsection
@section('content')

@include('website.theme.bootstrap.layout.igts.shared.innerPagesHead', ['title' => trans('page.home.choose payment method')]) 

<section class="sec sec_pad_top sec_pad_bottom">
    <div class="wrapper row d-flex justify-content-center">

    @foreach($paymentMethods as $paymentMethod)

        <div class="col-md-6 text-center mb-4">
        <a href="/{{$paymentMethod->action}}">
            <div class="card bg-main-color text-white">
                <div class="">
                    <h5 class="card-title" style="padding-top: 20px;">{{$paymentMethod->title_lang}}</h5>

                    <img class="card-img payment-method-image" src="{{ $paymentMethod->logo }}" alt="{{$paymentMethod->title_lang}}">

                </div>
            </div>
        </a>
        </div>

    @endforeach

        <div class="col-md-12 mt-40 next-step">
            <div class="flexLeft">
                <a class="view-more-section" href="{{ url('/cart') }}"><i class="flaticon-left-arrow"></i>
                    <span>{{ trans('website.Back to cart') }}</span>
                </a>
            </div>
        </div>
        
    </div>

    
</section>

@endsection