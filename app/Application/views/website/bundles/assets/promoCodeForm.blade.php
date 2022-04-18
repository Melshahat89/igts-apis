@if (auth()->check())
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
            <label>
            {{ trans('website.Do you have a discount coupon?') }}
            </label>
            <br>
            <div>
                <input class="form-control input-item" required name="code" aria-label='coupon' placeholder='{{ trans('website.Add Coupon Code') }}'>
            </div>
        </div>
        <div class="text-left">
            <button type="submit" class="add-to-cart">
                {{ trans('website.Add') }}
            </button>
        </div>
    @endif
    </form>
    <div id="promotionAlert"></div>
@endif