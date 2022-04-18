@extends(layoutExtend('website'))
@section('title')
    {{ trans('home.MeduoHomeTitle') }}
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
                <div class="col-md-9" style="height: 300px">
                    <div class="flowplayer-embed-container" style="position: relative; padding-bottom: 56.25%; height: 0; max-width:100%;">
                        <div class="total" >

                            <form class="login-form form-vertical" onsubmit="return validateForm(this)" action="{{ concatenateLangToUrl('site/cartFinishMobileWallet') }}" name="contactform"
                        method="post">
                            {{ csrf_field() }}

                            <div class="input-group">
                                <input class="form-control input-item user-login-ico" label="Username" placeholder="ex: 010 xxxxxxxx " name="mobile" id="mobile" required type="tel">
                            </div>
                            <span class="help-block error" id="LoginForm_username_em_" style="display: none"></span>

                            <div class="text-center">

                                <button type="submit" class="add-to-cart sign-in">
                             
                                    {{ trans('website.Buy Now') }}
                                </button>


                                <p class="pt-20">* Enter Mobile Wallet Number</p>

                            </div>

                            </form> 

                        </div>
                    </div>
                </div>

                <div class="col-md-12">

                    <h1 style="font-size: 40px; margin: 0;">
                        Order :
                        {{--  Number: {{$order->id}}  --}}
                     </h1>
                     
                    
                        <br><br><br>

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
                                        <a href="#" style="color: #2882b6;">{{$ordersposition['courses']['title_lang']}}</a>
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
                            <i class="flaticon-left-arrow"></i> 
                            <span> {{ trans('website.Back') }} </span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
        
    </div>
</section>



@endsection
@push('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css
"></script>
<script>
    function validatePhoneNumber(input_str) {
    var re = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;

    return re.test(input_str);
}

function validateForm(event) {
    var phone = document.getElementById('myform_phone').value;
    if (!validatePhoneNumber(phone)) {
        document.getElementById('phone_error').classList.remove('hidden');
    } else {
        document.getElementById('phone_error').classList.add('hidden');
        alert("validation success")
    }
    event.preventDefault();
}

document.getElementById('myform').addEventListener('submit', validateForm);
</script>
@endpush