<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsercoursewishlistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("coursewishlist", "user_id"))
		{
	Schema::table("coursewishlist", function (Blueprint $table)  {
		$table->integer("user_id")->unsigned();
		$table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");

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
		if (Schema::hasColumn("coursewishlist", "user_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("coursewishlist");
			Schema::table("coursewishlist", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("coursewishlist_user_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("coursewishlist_user_id_foreign");
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
