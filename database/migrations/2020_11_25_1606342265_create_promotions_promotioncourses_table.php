<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionspromotioncoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("promotioncourses", "promotions_id"))
		{
	Schema::table("promotioncourses", function (Blueprint $table)  {
		$table->integer("promotions_id")->unsigned();

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
		if (Schema::hasColumn("promotioncourses", "promotions_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("promotioncourses");
			Schema::table("promotioncourses", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("promotioncourses_promotions_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("promotioncourses_promotions_id_foreign");
					$table->dropColumn("promotions_id");
				}else{
					$table->dropColumn("promotions_id");
				}
			Schema::enableForeignKeyConstraints();
			});
		}
		Schema::enableForeignKeyConstraints();

    }
}
