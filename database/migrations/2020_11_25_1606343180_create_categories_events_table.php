<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategorieseventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("events", "categories_id"))
		{
	Schema::table("events", function (Blueprint $table)  {
		$table->integer("categories_id")->unsigned();

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
		if (Schema::hasColumn("events", "categories_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("events");
			Schema::table("events", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("events_categories_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("events_categories_id_foreign");
					$table->dropColumn("categories_id");
				}else{
					$table->dropColumn("categories_id");
				}
			Schema::enableForeignKeyConstraints();
			});
		}
		Schema::enableForeignKeyConstraints();

    }
}
