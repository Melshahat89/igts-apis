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

<section class="sec sec_pad_top sec_pad_bottom bg_gradient" id="">
    <div class="wrapper">
        <section class="title mblg">
            <h2 class="text_white text_capitalize">{{ trans('website.My Cart') }}</h2>
        </section>
    </div>
</section>


<section class="mycart-container" id="steps">

    <div class="container">
        <div class="steps" >
            <div class="row">
                <div class="col-md-6 ">
                    <div class="step-label">
                        <span>1</span>
                        {{ trans('website.Cart Items') }}
                    </div>
                </div>
                {{-- <div class="col-md-4">
                    <div class="step-label ">
                        <span>2</span>
                        {{ trans('website.Payment Methods') }}
                    </div>
                </div> --}}
                <div class="col-md-6 " >
                    <div class="step-label active">
                        <span>2</span>
                        {{ trans('website.Order Confirmation') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="my-items mt-40">
            <div class="row">
                <div class="col-md-12" style="height: 600px">
                    @if(getDir() == 'rtl')
                        <iframe name="iframe1" id="myVideo" style="position: absolute; top: 0; left: 0; width: 100%; height: 120%;" webkitAllowFullScreen mozallowfullscreen allowfullscreen src="https://accept.paymobsolutions.com/api/acceptance/iframes/9377?payment_token=<?= $payment_token ?>" title="0" byline="0" portrait="0" width="640" height="360" frameborder="0" allow="autoplay" oncontextmenu="return false"></iframe>
                    @else
                        <iframe name="iframe1" id="myVideo" style="position: absolute; top: 0; left: 0; width: 100%; height: 120%;" webkitAllowFullScreen mozallowfullscreen allowfullscreen src="https://accept.paymobsolutions.com/api/acceptance/iframes/9377?payment_token=<?= $payment_token ?>" title="0" byline="0" portrait="0" width="640" height="360" frameborder="0" allow="autoplay" oncontextmenu="return false"></iframe>
                    @endif
                </div>
                <div class="col-md-12">

                    <p style="font-size: 20px; margin: 0;">
                        Order : {{$order->id}} 
                     </p>

                    <table cellspacing="0" cellpadding="0" border="0" style="    width: 100%;; border-collapse:collapse">
                        <tbody>


                            <tr>
                                <td bgcolor="#c0c0c0" align="center" valign="middle"
                                    style="padding-top:6px; padding-bottom:6px; border-collapse:collapse; border-left:1px solid #cccccc; border-top:1px solid #cccccc; border-bottom:1px solid #cccccc; width:250px">
                                    <div
                                        style="width: 100%; height: 100%; overflow: hidden; font-family: Arial, sans-serif, serif, EmojiFont; font-size: 14px; color: rgb(255, 255, 255);">
                                        Course </div>
                                </td>
                                
                                <td bgcolor="#c0c0c0" align="center" valign="middle"
                                    style="border-collapse:collapse; border-left:1px solid #cccccc; border-top:1px solid #cccccc; border-bottom:1px solid #cccccc; width:250px">
                                    <div
                                        style="width: 100%; height: 100%; overflow: hidden; font-size: 14px; font-family: Arial, sans-serif, serif, EmojiFont; color: rgb(255, 255, 255);">
                                        Type </div>
                                </td>
                                <td bgcolor="#c0c0c0" align="center" valign="middle"
                                    style="border-collapse:collapse; border:1px solid #cccccc; width:150px">
                                    <div
                                        style="width: 100%; height: 100%; overflow: hidden; font-size: 14px; font-family: Arial, sans-serif, serif, EmojiFont; color: rgb(255, 255, 255);">
                                        Price </div>
                                </td>
                            </tr>
                            @foreach($order->ordersposition as $key => $ordersposition)
                            <tr style="width:100%">
                                <td
                                    style="padding:6px 6px 6px 18px; border-collapse:collapse; border-left:1px solid #cccccc; border-bottom:1px solid #cccccc; width:250px; vertical-align:top">
                                    <div
                                        style="width: 100%; height: 100%; overflow: hidden; font-family: Arial, sans-serif, serif, EmojiFont; font-size: 14px;">
                                        <a href="#" style="color: #2882b6;">{{ ($ordersposition->certificate_id) ?  $ordersposition['certificates']['title_lang'] : $ordersposition['courses']['title_lang']}}</a>
                                    </div>
                                    <br>
                                    
                                </td>
                                
                                <td align="center"
                                    style="padding-top:6px; border-collapse:collapse; border-left:1px solid #cccccc; border-bottom:1px solid #cccccc; width:70px; vertical-align:top">
                                    <div
                                        style="width: 100%; height: 100%; overflow: hidden; font-family: Arial, sans-serif, serif, EmojiFont; font-size: 14px;">
                                        {{ trans('courses.courses') }}</div>
                                </td>
                                <td
                                    style="padding-left:10px; padding-right:10px; padding-top:6px; padding-bottom:2px; text-align:right; vertical-align:top; border-collapse:collapse; border-left:1px solid #cccccc; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; width:90px">
                                    <div
                                        style="width: 100%; height: 100%; overflow: hidden; font-family: Arial, sans-serif, serif, EmojiFont; font-size: 14px;">
                                        {{$ordersposition['amount'] . $ordersposition['currency'] }} </div>
                                </td>
                            </tr>
                            @endforeach
                            <tr style="width:520px">
                                <td colspan="2" bgcolor="#f5f5f5"
                                    style="padding-top:6px; padding-bottom:6px; border-collapse:collapse; border-top:1px solid #cccccc; border-left:1px solid #cccccc; border-bottom:1px solid #cccccc; text-align:right; vertical-align:top; height:40px">
                                    <div style="height:100%; overflow:hidden">
                                        <font style="font-family:Arial,sans-serif; font-size:14px; color:#666666"
                                            face="Arial, sans-serif, serif, EmojiFont">Total:
                                        </font>
                                    </div>
                                </td>
                                <td bgcolor="#f5f5f5" colspan="2"
                                    style="padding-top:6px; padding-right:10px; padding-bottom:6px; border-collapse:collapse; border-top:1px solid #cccccc; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; text-align:right; vertical-align:top; height:40px">
                                    <div style="height:100%; overflow:hidden">
                                        <font style="font-family:Arial,sans-serif; font-size:18px; color:#00A63F"
                                            face="Arial, sans-serif, serif, EmojiFont">{{$amount }}  {{ getCurrency() }}
                                        </font>
                                    </div>
                                </td>
                                </tr>
                        </tbody>
                    </table>
                </div>


                <div class="col-md-12 mt-40 next-step">
                    <div class="text-right">
                        <a class="view-more-section" href="{{ url('/cart') }}">
                            <i class="flaticon-left-arrow"></i> <span>
                                {{ trans('website.Back') }}
                            </span></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>



@endsection
