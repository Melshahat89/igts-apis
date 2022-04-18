
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" dir="ltr" />
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width = device-width, initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no">
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
    <title>MEDU</title>
    <style type="text/css">
        /* Some resets and issue fixes */
        body {
            width: 100% !important;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            margin: 0;
            padding: 0;
        }
        table td {
            border-collapse: collapse;
            padding: 0;
        }
        /* End reset */

        @media only screen and (max-width: 600px) {
            .inner-body {
                width: 100% !important;
            }

            .footer {
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
    </style>
</head>
<body style="padding:0; margin:0">
    <table border="0" cellspacing="0" cellpadding="0" height="100%" width="650" style="color:#000000; background:#ffffff; font-family: Arial, Calibri, sans-serif; font-size:13px; padding: 0;  margin: 0 auto;">
        <tr>
            <td>
                <table border="0" cellspacing="0" cellpadding="0" height="100%" width="650" style="color:#000000; background:#ffffff; font-family: Arial, Calibri, sans-serif; font-size:13px; padding: 0;  margin: 0 auto;">
                    <tr style="height: 100px;">
                        <td valign="middle" style="width: 150 ;">
                            <a href="https://igtsservice.com"><img src="https://igtsservice.com/public/website/logo.png" alt="IGTS" ></a>
                        </td>
                        <td valign="middle" style="width: 500; text-align: right;">
                            <a href="https://www.facebook.com/igtsgroup"><img src="https://stage.meduo.net/public/meduo/mail/img_0.png" alt="IGTS" ></a>
                            <a href="https://twitter.com/igtsgroup"><img src="https://stage.meduo.net/public/meduo/mail/img_2.png" alt="IGTS" ></a>
                            <a href="https://www.linkedin.com/company/igtsgroup"><img src="https://stage.meduo.net/public/meduo/mail/img_3.png" alt="IGTS" ></a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table border="0" cellspacing="0" cellpadding="0" height="100%" width="650" style="color:#000000; background:#ffffff; font-family: Arial, Calibri, sans-serif; font-size:13px; padding: 0;  margin: 0 auto;">
                    <tr>
                        <td style="text-align: center;">
                            <hr>
                            <br><br>
                    

                        </td>
                    </tr>
                </table>
            </td>
        </tr>




        <tr>
            <td align="center">
                <table class="content" width="100%" cellpadding="0" cellspacing="0">
                    {{ $header or '' }}

                    <!-- Email Body -->
                    <tr>
                        <td class="body" width="100%" cellpadding="0" cellspacing="0">
                            <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0">
                                <!-- Body content -->
                                <tr>
                                    <td class="content-cell">
                                        {{ Illuminate\Mail\Markdown::parse($slot) }}

                                        {{ $subcopy or '' }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{ $footer or '' }}
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table border="0" cellspacing="0" cellpadding="0" height="100%" width="650" style="color:#000000; background:#ffffff; font-family: Arial, Calibri, sans-serif; font-size:13px; padding: 0;  margin: 0 auto;">
                    <tr style="background-color: #3c3c3c; height: 200px;">
                        <td valign="middle">
                            <p style="text-align: center; color: #ffffff;">
    
                                If you believe this has been sent to you in error, please safely <a href="#" style="text-decoration: underline; color: #ffffff;">unsubscribe</a>.
                                <br>
                                For more information, please see our <a href="https://igtsservice.com/page/privacyPolicy" style="text-decoration: underline;color: #ffffff;">privacy policy.</a>
                                <br>
                                © 2021 <a href="https://igtsservice.com" style="text-decoration: underline;color: #ffffff;">IGTS</a>. All rights reserved.
    
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    
    </table>
    </body>
    </html>
