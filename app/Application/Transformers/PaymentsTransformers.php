<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class PaymentsTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"operation" => $modelOrCollection->operation,
			"amount" => $modelOrCollection->amount,
			"currency_id" => $modelOrCollection->currency_id,
			"receiver_id" => $modelOrCollection->receiver_id,
			"token" => $modelOrCollection->token,
			"token_date" => $modelOrCollection->token_date,
			"status" => $modelOrCollection->status,
			"accept_source_data_type" => $modelOrCollection->accept_source_data_type,
			"accept_id" => $modelOrCollection->accept_id,
			"accept_pending" => $modelOrCollection->accept_pending,
			"accept_order" => $modelOrCollection->accept_order,
			"accept_amount_cents" => $modelOrCollection->accept_amount_cents,
			"accept_success" => $modelOrCollection->accept_success,
			"accept_data_message" => $modelOrCollection->accept_data_message,
			"accept_profile_id" => $modelOrCollection->accept_profile_id,
			"accept_source_data_sub_type" => $modelOrCollection->accept_source_data_sub_type,
			"accept_hmac" => $modelOrCollection->accept_hmac,
			"txn_response_code" => $modelOrCollection->txn_response_code,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"operation" => $modelOrCollection->operation,
			"amount" => $modelOrCollection->amount,
			"currency_id" => $modelOrCollection->currency_id,
			"receiver_id" => $modelOrCollection->receiver_id,
			"token" => $modelOrCollection->token,
			"token_date" => $modelOrCollection->token_date,
			"status" => $modelOrCollection->status,
			"accept_source_data_type" => $modelOrCollection->accept_source_data_type,
			"accept_id" => $modelOrCollection->accept_id,
			"accept_pending" => $modelOrCollection->accept_pending,
			"accept_order" => $modelOrCollection->accept_order,
			"accept_amount_cents" => $modelOrCollection->accept_amount_cents,
			"accept_success" => $modelOrCollection->accept_success,
			"accept_data_message" => $modelOrCollection->accept_data_message,
			"accept_profile_id" => $modelOrCollection->accept_profile_id,
			"accept_source_data_sub_type" => $modelOrCollection->accept_source_data_sub_type,
			"accept_hmac" => $modelOrCollection->accept_hmac,
			"txn_response_code" => $modelOrCollection->txn_response_code,

        ];
    }

}