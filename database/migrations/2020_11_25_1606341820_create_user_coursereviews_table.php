<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsercoursereviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("coursereviews", "user_id"))
		{
	Schema::table("coursereviews", function (Blueprint $table)  {
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
		if (Schema::hasColumn("coursereviews", "user_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("coursereviews");
			Schema::table("coursereviews", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("coursereviews_user_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("coursereviews_user_id_foreign");
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
