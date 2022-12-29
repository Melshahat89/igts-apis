<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriescoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("courses", "categories_id"))
		{
	Schema::table("courses", function (Blueprint $table)  {
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
		if (Schema::hasColumn("courses", "categories_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("courses");
			Schema::table("courses", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("courses_categories_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("courses_categories_id_foreign");
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
