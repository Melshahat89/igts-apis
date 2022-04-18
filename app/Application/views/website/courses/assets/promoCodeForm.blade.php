@if (auth()->check())
<div class="container">
<div class="row">
    <div class="col-md-12">
    <form class="coupon" action="{{ concatenateLangToUrl('site/insertCoupon') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
    @if(getCurrentPromoCode())
        <div class="text-right">
            <label> {{ trans('website.Coupon Applied, Click to remove') }} </label>
            <br>
            <a href="{{ url('/removePromo') }}" class="add-to-cart">
             "   <b>{{ getCurrentPromoCode()['promotions']['code'] }}</b> "
                {{ trans('website.Applied Now')  }}
            </a>
        </div>
    @else
        <div class="input-group mb-20">
            <label style="font-weight: bold;color:black;">
            {{ trans('website.Do you have a discount coupon?') }}
            </label>
            <br>
            <div style="display: contents;">
                <input class="form-control input-item" required name="code" aria-label='coupon' placeholder='{{ trans('website.Add Coupon Code') }}'>
            </div>
        </div>
        <div class="text-left">
            <button type="submit" class="add-to-cart" style="background: #244092 !important;">
                {{ trans('website.Add') }}
            </button>
        </div>
    @endif
    </form>
    <div id="promotionAlert"></div>
    </div>
</div>
</div>
@endif
