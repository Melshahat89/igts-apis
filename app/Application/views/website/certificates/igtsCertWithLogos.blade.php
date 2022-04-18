@php
use Carbon\Carbon;
@endphp
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Beau+Rivage&family=Lobster&family=Poppins:wght@600&display=swap" rel="stylesheet">


<div class="content">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    html,body{
        margin:0;
        padding:0;
    }
    .content {
        
        width:100%;
        height:100%;
        background:transparent url('https://igtsservice.com/certificate-with-logos.jpg') no-repeat 0 0;
        background-size:cover;
        font-family: sans-serif;
        position:relative;
        overflow: hidden;
    }
    .certificate_meta {
        width:18em;
        position:absolute;
        bottom: 2.2em;
        right: 50%;
        margin-right: -10em;
    }
    .certificate_meta .country , .certificate_meta .serial_number {
        text-align:center;
        padding:.7em 0;
        margin-bottom:1em;
        
    }
    .certificate_meta h2 {
        margin:0;
    }
    .director {
        text-align:center;
        width:8em;
        position:absolute;
        bottom: 11em;
        right: 6.5em;
    }
    .director h2 {
        margin:0;
        padding:.2em 0 0 0;
        font-weight: 400;
        border-top:3px solid black;
    }
    .director .signature {
        max-width: 8em;
    }
    .content_text {
        padding:310px 0 0 0;
        text-align:center;
    }
    .content_text h3 {
        font-weight:300;
        font-size:2em;
        margin:0 0 1.5em 0;
    }
    .content_text h1 {
        font-weight:500;
        font-size:2.6em;
        margin:0 0 .8em 0;
    }
    .content_text h2 {
        font-weight:500;
        font-size:2.2em;
        margin:0 0 .8em 0;
    }
    .metaData h2 {
        margin:0 0 .8em 0;
    }   
    </style>
    <div class="content_text">
        <p style="position: absolute; left: 0; right: 0; font-family: 'Beau Rivage', cursive; font-size: 66px; top: 330px; color: #244092;"><?php echo $name; ?></p>
        <p style="font-family: 'Poppins'; text-transform:uppercase;font-size: 20px; font-weight: 700;color: #6c6c67;position: absolute; right: 0; left: 0; top: 487px;">For successfully completing the</p>
        <p style="direction: rtl; margin-bottom: 0;text-transform:uppercase; font-family: 'Poppins'; font-size: 28px;font-weight: 700; position: absolute; right: 0; left: 0; top: 515px; color: #244092;"><?php echo  $course->title_en;?></p>
        <p style="position: absolute; left: 410px; bottom: -295px;">{{Carbon::now()->format('Y-m-d')}}</p>
        <p style="position: absolute; right: 400px; bottom: -280px;font-family: 'Beau Rivage', cursive;font-size: 25px;">Ahmed Sabah</p>
    </div>
    <div class="extra-logos" style="position: absolute;left:0;right:0;top:620px;text-align:center;">
        @foreach($logos as $logo)
            <img src="https://igtsservice.com/public/uploads/files/{{$logo}}" 
                style="
                height: 120px;
                margin-right: 18px;
                border-radius: 67px;
                ">
        @endforeach
    </div>
    @if(isset($certificateId))
    <img src="https://igtsservice.com/igts-verify-certificate-qr.png" style="position: absolute;height: 90px;top: 695px;left: 860px;">
    <p style="margin:0;padding:0;position: absolute;height: 90px;top: 678px;left: 860px;font-size: 14px;">#{{$certificateId}}</p>
    <p style="margin:0;padding:0;position: absolute;height: 90px;top: 785px;left: 860px;font-size: 14px;">Scan to verify</p>
    @endif
</div>