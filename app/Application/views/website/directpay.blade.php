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

@include('website.theme.bootstrap.layout.igts.shared.innerPagesHead', ['title' => trans('home.direct pay')]) 

<section class="sec sec_pad_top sec_pad_bottom">
<div class="wrapper row d-flex justify-content-center">

@if($payment_token)
    <div class="col-md-12" style="height: 600px">
    @if(getDir() == 'rtl')
        <iframe name="iframe1" id="myVideo" style="position: absolute; top: 0; left: 0; width: 100%; height: 120%;" webkitAllowFullScreen mozallowfullscreen allowfullscreen src="https://accept.paymobsolutions.com/api/acceptance/iframes/9377?payment_token=<?= $payment_token ?>" title="0" byline="0" portrait="0" width="640" height="360" frameborder="0" allow="autoplay" oncontextmenu="return false"></iframe>
    @else
        <iframe name="iframe1" id="myVideo" style="position: absolute; top: 0; left: 0; width: 100%; height: 120%;" webkitAllowFullScreen mozallowfullscreen allowfullscreen src="https://accept.paymobsolutions.com/api/acceptance/iframes/9377?payment_token=<?= $payment_token ?>" title="0" byline="0" portrait="0" width="640" height="360" frameborder="0" allow="autoplay" oncontextmenu="return false"></iframe>
    @endif
    </div>
    <div class="col-md-12">

<p style="font-size: 20px; margin: 0;">
    Order : {{$orderPosition->orders->id}} 
 </p>

<table cellspacing="0" cellpadding="0" border="0" style="    width: 100%;; border-collapse:collapse">
    <tbody>


        <tr>
            <td bgcolor="#c0c0c0" align="center" valign="middle"
                style="padding-top:6px; padding-bottom:6px; border-collapse:collapse; border-left:1px solid #cccccc; border-top:1px solid #cccccc; border-bottom:1px solid #cccccc; width:250px">
                <div
                    style="width: 100%; height: 100%; overflow: hidden; font-family: Arial, sans-serif, serif, EmojiFont; font-size: 14px; color: rgb(255, 255, 255);">
                    Type </div>
            </td>
            
            <td bgcolor="#c0c0c0" align="center" valign="middle"
                style="border-collapse:collapse; border-left:1px solid #cccccc; border-top:1px solid #cccccc; border-bottom:1px solid #cccccc; width:250px">
                <div
                    style="width: 100%; height: 100%; overflow: hidden; font-size: 14px; font-family: Arial, sans-serif, serif, EmojiFont; color: rgb(255, 255, 255);">
                    Amount </div>
            </td>
            <td bgcolor="#c0c0c0" align="center" valign="middle"
                style="border-collapse:collapse; border-left:1px solid #cccccc; border-top:1px solid #cccccc; border-bottom:1px solid #cccccc; width:250px">
                <div
                    style="width: 100%; height: 100%; overflow: hidden; font-size: 14px; font-family: Arial, sans-serif, serif, EmojiFont; color: rgb(255, 255, 255);">
                     </div>
            </td>
        </tr>
        <tr style="width:100%">
            <td
                style="padding:6px 6px 6px 18px; border-collapse:collapse; border-left:1px solid #cccccc; border-bottom:1px solid #cccccc; width:250px; vertical-align:top">
                <div
                    style="width: 100%; height: 100%; overflow: hidden; font-family: Arial, sans-serif, serif, EmojiFont; font-size: 14px;">
                    <a href="#" style="color: #2882b6;">Direct Payment</a>
                </div>
                <br>
                
            </td>
            
            <td align="center"
                style="padding-top:6px; border-collapse:collapse; border-left:1px solid #cccccc; border-bottom:1px solid #cccccc; width:70px; vertical-align:top">
                <div
                    style="width: 100%; height: 100%; overflow: hidden; font-family: Arial, sans-serif, serif, EmojiFont; font-size: 14px;">
                    {{$orderPosition->amount . $orderPosition->currency}}</div>
            </td>
        </tr>
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
                        face="Arial, sans-serif, serif, EmojiFont">{{$orderPosition->amount }}  {{ getCurrency() }}
                    </font>
                </div>
            </td>
            </tr>
    </tbody>
</table>

<a type="button" href="/directpay" class="btn btn-secondary mt-4">Back</a>

</div>

@else
    <form action="" method="GET" style="width: 60%">
        <div class="form-group">
            <label for="currency">{{trans('home.currency')}}</label>
                <select class="form-control input-item user-login-ico" id="currency" name="currency" required="required">
                    <option value="">{{trans('home.select currency')}}</option>
                    <option value="USD">{{trans('home.usd')}}</option>
                    <option value="EGP">{{trans('home.egp')}}</option>
                </select>
        </div>
        <div class="form-group">
            <label for="amount">{{trans('home.amount')}}</label>
            <input type="number" class="form-control" id="amount" name="amount" placeholder="{{trans('home.amount')}}" required="required">
        </div>

        @if(!Auth::check())
            <a href="javascript:void(0)" data-dismiss="modal" data-remote="/login" data-toggle="modal" data-target="#loginModal" class="button button_primary">
            {{trans('home.pay now')}}
            </a>
        @else
            <button type="submit" class="btn btn-primary">{{trans('home.pay now')}}</button>
        @endif
        
    </form>

         
    </div>
@endif
</div>

</section>

@endsection