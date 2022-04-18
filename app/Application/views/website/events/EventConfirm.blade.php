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
      </style>
   </head>
   <body style="padding:0; margin:0">
      <table border="0" cellspacing="0" cellpadding="0" height="100%" width="650" style="color:#000000; background:#ffffff; font-family: Arial, Calibri, sans-serif; font-size:13px; padding: 0;  margin: 0 auto;">
       <tr>
          <td>
             <table border="0" cellspacing="0" cellpadding="0" height="100%" width="650" style="color:#000000; background:#ffffff; font-family: Arial, Calibri, sans-serif; font-size:13px; padding: 0;  margin: 0 auto;">
               <tr style="height: 100px;">
                  <td valign="middle" style="width: 150 ;">
                    <a href="https://meduo.net"><img src="https://stage.meduo.net/public/meduo/mail/logo.png" alt="MEDU" ></a>
                  </td>
                  <td valign="middle" style="width: 500; text-align: right;">
                     <a href="#"><img src="https://stage.meduo.net/public/meduo/mail/img_0.png" alt="MEDU" ></a>
                     <a href="#"><img src="https://stage.meduo.net/public/meduo/mail/img_1.png" alt="MEDU" ></a>
                     <a href="#"><img src="https://stage.meduo.net/public/meduo/mail/img_2.png" alt="MEDU" ></a>
                     <a href="#"><img src="https://stage.meduo.net/public/meduo/mail/img_3.png" alt="MEDU" ></a>
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
                     <h1 style="color:#3fa46a; font-weight: 700;">Thanks for your order, {{$user->fullname_lang}}.</h1>
                     
                       
                     <h1 style="font-size: 40px; margin: 0;">
                        Order Number: {{$order->id}}
                     </h1>
                     
                    
                        <br><br><br>
                       
                   </td>
                </tr>               
             </table>
          </td>
       </tr>


       <tr>
         <td>
           <table cellspacing="0" cellpadding="0" border="0" style="table-layout:fixed; width:650px; border-collapse:collapse">
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
                                    <a href="#" style="color: #2882b6;">
                                       @if($ordersposition->type == 1)
                                          {{$ordersposition['courses']['title_lang']}}
                                       @else($ordersposition->type == 2)
                                          {{$ordersposition['events']['title_lang']}}
                                       @endif
                                       
                                       
                                    </a>
                                </div>
                                <br>
                                
                            </td>
                            
                            <td align="center"
                                style="padding-top:6px; border-collapse:collapse; border-left:1px solid #cccccc; border-bottom:1px solid #cccccc; width:70px; vertical-align:top">
                                <div
                                    style="width: 100%; height: 100%; overflow: hidden; font-family: Arial, sans-serif, serif, EmojiFont; font-size: 14px;">
                                       @if($ordersposition->type == 1)
                                          {{ trans('courses.courses') }}
                                       @else($ordersposition->type == 2)
                                          {{ trans('events.events') }}
                                       @endif   
                                    
                                    </div>
                            </td>
                            <td
                                style="padding-left:10px; padding-right:10px; padding-top:6px; padding-bottom:2px; text-align:right; vertical-align:top; border-collapse:collapse; border-left:1px solid #cccccc; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; width:90px">
                                <div
                                    style="width: 100%; height: 100%; overflow: hidden; font-family: Arial, sans-serif, serif, EmojiFont; font-size: 14px;">
                                    {{$ordersposition['amount']}} </div>
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
                                 face="Arial, sans-serif, serif, EmojiFont">{{$amount}} 
                              </font>
                           </div>
                     </td>
                    </tr>

                    
                </tbody>
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
                     <h1 style="color:#3fa46a; font-weight: 700;">Ticket Number, {{$ticket->id}}.</h1>
                     
                     <img src="https://chart.googleapis.com/chart?chs=400x400&cht=qr&chl={{ $ticket->code }}&choe=UTF-8" title="{{ $ticket->code }}" />
                                  
                     
                    
                        <br><br><br>
                       
                   </td>
               </tr>               
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
                      For more information, please see our <a href="https://meduo.net/privacyPolicy" style="text-decoration: underline;color: #ffffff;">privacy policy.</a>
                      <br>
                      © 2020 <a href="https://meduo.net" style="text-decoration: underline;color: #ffffff;">MEDU</a>. All rights reserved. 
                      
                     </p>
                  </td>
                 </tr>
              </table>
           </td>
        </tr>
       
      </table>
   </body>
</html>