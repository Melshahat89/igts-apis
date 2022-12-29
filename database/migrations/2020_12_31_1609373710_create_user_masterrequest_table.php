<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsermasterrequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("masterrequest", "user_id"))
		{
	Schema::table("masterrequest", function (Blueprint $table)  {
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
		if (Schema::hasColumn("masterrequest", "user_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("masterrequest");
			Schema::table("masterrequest", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("masterrequest_user_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("masterrequest_user_id_foreign");
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
