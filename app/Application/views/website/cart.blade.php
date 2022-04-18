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

<main class="main_content">
    <?php // var_dump(Yii::app()->shoppingCart);die;

use App\Application\Model\Certificates;
use App\Application\Model\Ordersposition;
?>
    <section class="sec sec_pad_top sec_pad_bottom">
        <div class="wrapper">

            <div class="with_aside_flex aside_sm">
<aside class="component_aside bg_lightergray" data-sticky="nav" data-plugin-option='{"offset_top":80}' style="{{(getDir() == 'ltr') ? 'margin-left: 18px;' : ''}}">
                    <div class="cupon" style="padding:18px;border-bottom:5px solid white;">
                        @include('website.courses.assets.promoCodeForm')
                        <!--// Coupon Code-->
                        

                        <div>
                            
                        </div>
                    </div>

                    <table class="table">
                        <tbody>
                        <tr>
                            <div><td align="center"><span class="text_muted">{{trans('courses.courses count')}} {{ isset(getShoppingCartDetailsCount()['courses']) ?  getShoppingCartDetailsCount()['courses'] : '0'}}</span></td></div>
                            <div><td align="center"><span class="text_muted">{{trans('courses.certificates count')}} {{ isset(getShoppingCartDetailsCount()['certificates']) ? getShoppingCartDetailsCount()['certificates'] : '0'}}</span></td></div>
                        </tr>
                        <tr>
                            <td align="center"><strong>{{trans('courses.total')}}</strong></td>
                            <td align="center"><strong>{{ getShoppingCartCost() }} {{ getCurrency() }}</strong></td>
                        </tr>
                        <?php if(getShoppingCartCost() > 0){?>
                            <tr>
                                <td align="center" colspan="2">
                                    <div class="checkbox ">
                                        {{trans('courses.terms accept payment')}}  <a  target="_blank" href="/termsOfUse">{{trans('home.terms and conditions')}}</a> 



                                    </div>


                                    <?php if(getShoppingCartCost() <= 0){ ?>

                                        <a href="site/enrollNow"class="button button_large button_shadow button_primary button_wide pay">{{trans('courses.enroll now')}}</a>

                                    <?php }else{ ?>

                                        <a href="javascript:void(0)" data-dismiss="modal" data-toggle="modal" data-target="#directBuyModal" class="button button_large button_shadow button_primary button_wide pay">{{trans('courses.pay now')}}</a>

                                    <?php } ?>
                                </td>
                            </tr>
                        <?php }?>
                        </tbody>
                    </table>
                </aside>
                <div class="component_main bg_lightergray">
                    <div class="component_main_header flex flex-content-sb flex-items-cneter">
                        <h3>{{trans('courses.cart')}}</h3>
                        <?php if(count(getShoppingCart())){?>
                            <div class="actions">
                                <a href="/courses/clearCart" class="button button_white button_small text_capitalize" type="button" role="button">{{trans('courses.remove all from cart')}}</a>
                            </div>
                        <?php }?>
                    </div>
                    <div class="component_main_body">
                        <div class="course_card_list cart_list">

                            <!--////////////////////////////////////-->

                            <?php if(getShoppingCart()){?>
                                <?php foreach (getShoppingCart() as $key => $cartItem) { ?>

                                 
                                    <?php if($cartItem->type == Ordersposition::TYPE_Course){?>
                                        
                                        <div class="course_card_item">
                                            <div class="">
                                                <div><a href="/courses/removeFromCart/id/{{$cartItem->id}}" class="button button_link"><i class="fas fa-times"></i> {{trans('courses.Remove from cart')}}</a></div>
                                                <div><a href="/courses/bookmarkItemInCart/id/{{$cartItem->courses->id}}" class="button button_link d-none"><i class="far fa-heart"></i> انقل إلي الامنيات</a></div>
                                            </div>
                                            <a href="/courses/view/{{$cartItem->courses->slug}}" class="course_card_link">
                                                    <span class="course_card_img">
                                                        <?php if ($cartItem->courses->image) { ?>
                                                            <img src="{{ large1($cartItem->courses->image) }}" style="height: 111px;">
                                                        <?php } ?>
                                                    </span>
                                                <div class="course_card_detail">
                                                <div class="course_card_detail_name">{{ $cartItem->courses->title_lang }}</div>

                                                {{--<p>{!! strip_tags($cartItem->courses->description_lang, 200) !!}</p>
                                                    <div class="mtmd text_accent">{{trans('courses.viewed more than')}} {{ $cartItem->courses->visits }} {{trans('courses.times')}}</div>--}}
                                                </div>
                                                <div class="course_card_price">

                                                {!! $cartItem->courses->PriceText !!}
                                                   {{--
                                                        <div class="course_card_rating">
                                                            <div class="jq_rating jq-stars" data-options='{"initialRating":{{round($cartItem->courses->CourseRating, 1)}}, "readOnly":true, "starSize":17}'></div>
                                                            <div class="text_muted">{{round($cartItem->courses->CourseRating, 1)}}</div>
                                                        </div>

                                                        <div class="text_muted"><small>( {{ $cartItem->courses->CourseCountRating}} {{trans('courses.ratings')}} )</small></div>
                                                     --}}
                                                </div>
                                            </a>
                                        </div>

                                    <?php }?>

                                    <?php if($cartItem->type == Ordersposition::TYPE_CERTIFICATE){?>

                                        <div class="course_card_item">
                                            <div class="">
                                                <div><a href="/courses/removeFromCart/id/{{$cartItem->id}}" class="button button_link"><i class="fas fa-times"></i> {{trans('courses.Remove from cart')}}</a></div>
                                            </div>
                                            <a href="/courses/view/{{$cartItem->courses->slug}}" class="course_card_link">
                                                    <span class="course_card_img">
                                                        
                                                    </span>
                                                <div class="course_card_detail">
                                                    <div class="course_card_detail_name">{{ $cartItem->certificates->title_lang }} ( {{ $cartItem->courses->title_lang }} )</div>

                                                </div>
                                                <div class="course_card_price">

                                                {{ $cartItem->certificates->Price }} {{ getCurrency() }}
                                                   
                                                </div>
                                            </a>
                                        </div>

                                    <?php }?>
                         
                                    <?php }?>


                                <?php }else{ ?>
                            
                                السلة فارغة الآن
                            <?php } ?>
                        </div>
                        <?php if(count(getShoppingCart())){?>

                            <table class="table mtmd bt">
                                <tbody>
                                <tr>
                                    <div><td align="center"><span class="text_muted">{{trans('courses.courses count')}}{{ isset(getShoppingCartDetailsCount()['courses']) ?  getShoppingCartDetailsCount()['courses'] : '0'}}</span></td></div>
                                    <div><td align="center"><span class="text_muted">{{trans('courses.certificates count')}}{{ isset(getShoppingCartDetailsCount()['certificates']) ? getShoppingCartDetailsCount()['certificates'] : '0'}}</span></td></div>

                                </tr>
                                <tr>
                                    <td align="center"><strong>{{trans('courses.total')}}</strong></td>
                                    <td align="center"><strong>{{ getShoppingCartCost() }} {{ getCurrency() }}</strong></td>
                                </tr>
                                
                                <tr style="display:none;">
                                    <td align="center" colspan="2">


                                        <a href="/payments/deposit" class="button button_large button_shadow button_primary button_wide">{{trans('courses.pay now')}}</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        <?php }?>
                    </div>
                </div>

            </div>

        </div>
    </section>


</main>

@if(Auth::check() && count(getShoppingCart()) > 0)
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
                                <a class="paymentmethod {{ isset($paymentMethod->class) ? $paymentMethod->class : '' }}" href="{{ !strpos($paymentMethod->action, '(') ? $paymentMethod->action : 'javascript: void(0)' }}" onclick="{{$paymentMethod->action}}">
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
@endif
@endsection