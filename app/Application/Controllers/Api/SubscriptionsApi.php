<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Requests\Website\Subscriptions\VerifyRequestSubscriptions;
use Imdhemy\Purchases\Facades\Subscription;


class SubscriptionsApi extends Controller
{
    use ApiTrait;


    public function verify(VerifyRequestSubscriptions $validation) {
        $request = $this->validateRequest($validation);
        if (!is_array($request)) {
            return $request;
        }

        $receipt = $request['receipt'];

        if (!base64_decode($receipt, true)) {
            return response(['status' => false, 'message' => 'Invalid receipt format'], 400);
        }

        try {
            // Verifiy the receipt on App Store servers.
            $receiptResponse = Subscription::appStore()->receiptData($receipt)->verifyReceipt();

            // Get the receipt status
            $receiptStatus = $receiptResponse->getStatus();

            if ($receiptStatus->isValid()) {
                $latestReceiptInfo = $receiptResponse->getLatestReceiptInfo();
                // You can loop all of them or either get the first one (recently purchased).
                $receiptInfo = $latestReceiptInfo[0];

                $data['productId'] = $receiptInfo->getProductId();
                $data['transactionId'] = $receiptInfo->getTransactionId();
                $data['originalTransactionId'] = $receiptInfo->getOriginalTransactionId();
                $data['expiresDate'] = $receiptInfo->getExpiresDate();
                // And so on...
                return response(apiReturn($data), 200);
            } else {
                return response(['status' => false, 'message' => 'Receipt is not valid'], 400);
            }
        } catch (\Exception $e) {
            return response(['status' => false, 'message' => 'Verification failed. Please try again later.'], 500);
        }
    }


    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(TicketsTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(TicketsTransformers::transform($data) + $paginate), $status_code);
    }

}
