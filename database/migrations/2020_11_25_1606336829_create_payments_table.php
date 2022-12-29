<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string("operation")->nullable();
			$table->double("amount")->nullable();
			$table->integer("currency_id")->nullable();
			$table->string("receiver_id")->nullable();
			$table->string("token")->nullable();
			$table->string("token_date")->nullable();
			$table->integer("status")->nullable();
			$table->string("accept_source_data_type")->nullable();
			$table->string("accept_id")->nullable();
			$table->string("accept_pending")->nullable();
			$table->string("accept_order")->nullable();
			$table->string("accept_amount_cents")->nullable();
			$table->string("accept_success")->nullable();
			$table->string("accept_data_message")->nullable();
			$table->string("accept_profile_id")->nullable();
			$table->string("accept_source_data_sub_type")->nullable();
			$table->string("accept_hmac")->nullable();
			$table->string("txn_response_code")->nullable();
			
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
