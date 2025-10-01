<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Homesettings;
use App\Application\Model\Orders;
use App\Application\Model\Subscriptionuser;
use App\Application\Requests\Website\Subscriptions\VerifyRequestSubscriptions;
use Carbon\Carbon;
use Firebase\JWT\JWT;
//use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Auth;
use Imdhemy\AppStore\ClientFactory;
use Imdhemy\AppStore\Jws\JwsGenerator;
use Imdhemy\AppStore\ServerNotifications\TestNotificationService;
use Imdhemy\Purchases\Facades\Subscription;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Imdhemy\AppStore\ServerNotifications\ServerNotification;

use Imdhemy\Purchases\Product;


class SubscriptionsApi extends Controller
{
    use ApiTrait;


    public function verify(VerifyRequestSubscriptions $validation)
    {
        $request = $this->validateRequest($validation);
        if (!is_array($request)) {
            return $request;
        }

        $receipt = $request['receipt'];

        if (!base64_decode($receipt, true)) {
            return response(['status' => false, 'message' => 'Invalid receipt format'], 400);
        }

        try {
            // تحقق أولًا من بيئة الإنتاج
            $receiptResponse = Subscription::appStore()->receiptData($receipt)->verifyReceipt();
            $status = $receiptResponse->getStatus()->getCode();

            // لو الإيصال من بيئة Sandbox داخل تطبيق إنتاجي
            if ($status === 21007) {
                $sandboxClient = ClientFactory::createSandbox(); // ✅ الطريقة الرسمية
                $receiptResponse = Subscription::appStore()->receiptData($receipt)->verifyReceipt($sandboxClient);
                $status = $receiptResponse->getStatus()->getCode();
            }

            if ($status === 0) {
                $latestReceiptInfo = $receiptResponse->getLatestReceiptInfo();
                $receiptInfo = $latestReceiptInfo[0];

                $data['productId'] = $receiptInfo->getProductId();
                $data['transactionId'] = $receiptInfo->getTransactionId();
                $data['originalTransactionId'] = $receiptInfo->getOriginalTransactionId();
                $data['purchaseDate'] = $receiptInfo->getPurchaseDate()?->toDateTime()->format('Y-m-d');

                Log::info('Verified iOS Receipt', $data);

                // إنشاء الطلب وتفعيل الاشتراك حسب نوع المنتج
                $order = new Orders();
                $order->subscription_type = ($data['productId'] == 'monthly_subscription') ? Orders::SUBSCRIPTON_MONTHLY : Orders::SUBSCRIPTION_ANNUAL;
                $order->type = Orders::TYPE_B2C;
                $order->status = Orders::STATUS_PENDING;
                $order->user_id = auth()->guard('api')->user()->id;
                $order->currency = "USD";
                $order->save();

                $subscriptionuser = new Subscriptionuser();
                $subscriptionuser->user_id = auth()->guard('api')->user()->id;
                $subscriptionuser->subscription_id = 1;
                $subscriptionuser->start_date = now()->format('Y-m-d');
                $subscriptionuser->end_date = ($data['productId'] == 'monthly_subscription')
                    ? now()->addMonth()->format('Y-m-d')
                    : now()->addYear()->format('Y-m-d');
                $subscriptionuser->amount = null;
                $subscriptionuser->b_type = 4;
                $subscriptionuser->is_active = 1;
                $subscriptionuser->orders_id = $order->id;
                $subscriptionuser->save();

                return response(apiReturn($data), 200);
            } else {
                Log::warning('Invalid iOS Receipt', ['receipt' => $receipt, 'status' => $status]);
                return response(['status' => false, 'message' => 'Receipt is not valid'], 400);
            }
        } catch (\Exception $e) {
            Log::error('Receipt verification failed', ['error' => $e->getMessage()]);
            return response(['status' => false, 'message' => 'Verification failed. Please try again later.'], 500);
        }
    }

    public function notifications(Request $request)
    {
        try {
            // استقبال البيانات الخام من Apple
            $rawBody = $request->getContent();

            // تحليل الإشعار باستخدام مكتبة Imdhemy
//            $notification = ServerNotification::toArray();

            // استخراج نوع الإشعار
//            $type = $notification->getNotificationType(); // مثال: INITIAL_BUY, CANCEL, DID_RENEW, etc.

            // استخراج بيانات الاشتراك
//            $latestReceiptInfo = $notification->getLatestReceiptInfo();

            // مثال: استخراج transactionId و productId
//            $transactionId = $latestReceiptInfo?->getTransactionId();
//            $productId = $latestReceiptInfo?->getProductId();

            // تسجيل الإشعار في اللوج
            Log::info('Apple Notification Received', [
//                'type' => $type,
//                'transaction_id' => $transactionId,
//                'product_id' => $productId,
                'notification' => $rawBody,
            ]);

            // هنا تقدر تضيف لوجيك التحديث في قاعدة البيانات حسب نوع الإشعار
            // مثل: إلغاء اشتراك، تجديد، ترقية، إلخ

            return response()->json(['status' => true], 200);
        } catch (\Exception $e) {
            Log::error('Apple Notification Error', ['error' => $e->getMessage()]);
            return response()->json(['status' => false, 'message' => 'Invalid notification'], 400);
        }
    }



    public function test_example(): void
    {


        // Create the expected body
        $responseBody = [
            'environment' => 'Sandbox',
            'status' => 0,
            'latest_receipt_info' => [
                [
                    'product_id' => 'fake_product_id',
                    'quantity' => '1',
                    'transaction_id' => 'fake_transaction_id',
                    'original_transaction_id' => 'original_transaction_id',
                    // other fields omitted
                ],
            ],
            // other fields omitted
        ];

        // Create the response instance. It requires to JSON encode the body.
        $responseMock = new Response(200, [], json_encode($responseBody, JSON_THROW_ON_ERROR));

        // Use the client factory to mock the response.
        $client = ClientFactory::mock($responseMock);

        // --------------------------------------------------------------
        // The created client could be injected into a service
        // --------------------------------------------------------------
        // The part is up to you as a developer.
        //
        // Inside that service you can use the client as follows
        $verifyResponse = Subscription::appStore($client)->receiptData('fake_receipt_data')->verifyReceipt();

        $latestReceiptInfo = $verifyResponse->getLatestReceiptInfo();


        dd($latestReceiptInfo);

        // The returned response will contain the data from the response body you provided in the first line.
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(TicketsTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(TicketsTransformers::transform($data) + $paginate), $status_code);
    }

}
