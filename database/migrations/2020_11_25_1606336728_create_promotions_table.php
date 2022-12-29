<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->increments('id');
            $table->string("title")->nullable();
			$table->text("description")->nullable();
			$table->integer("type")->nullable();
			$table->string("value_for_egp")->nullable();
			$table->string("value_for_other_currencies")->nullable();
			$table->string("code")->nullable();
			$table->date("start_date")->nullable();
			$table->string("expiration_date")->nullable();
			$table->boolean("active")->nullable();
			$table->string("promotion_limit")->nullable();
			$table->string("promotion_usage")->nullable();
			$table->boolean("publish_as_notification")->nullable();
			$table->text("notification_message")->nullable();
			$table->boolean("include_courses")->nullable();
			
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
        Schema::dropIfExists('promotions');
    }
}
