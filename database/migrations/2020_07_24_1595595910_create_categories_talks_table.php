<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriestalksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("talks", "categories_id"))
		{
	Schema::table("talks", function (Blueprint $table)  {
		$table->integer("categories_id")->unsigned();
		$table->foreign("categories_id")->references("id")->on("categories")->onDelete("cascade");

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
		if (Schema::hasColumn("talks", "categories_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("talks");
			Schema::table("talks", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("talks_categories_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("talks_categories_id_foreign");
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
