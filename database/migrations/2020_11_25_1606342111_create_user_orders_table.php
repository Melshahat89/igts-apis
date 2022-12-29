<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("orders", "user_id"))
		{
	Schema::table("orders", function (Blueprint $table)  {
		$table->integer("user_id")->unsigned();

	});		}

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::disableForeignKeyConstraints();
		if (Schema::hasColumn("orders", "user_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("orders");
			Schema::table("orders", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("orders_user_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("orders_user_id_foreign");
					$table->dropColumn("user_id");
				}else{
					$table->dropColumn("user_id");
				}
			Schema::enableForeignKeyConstraints();
			});
		}
		Schema::enableForeignKeyConstraints();

    }
}
