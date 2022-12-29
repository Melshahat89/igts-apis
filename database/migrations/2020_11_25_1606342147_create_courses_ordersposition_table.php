<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesorderspositionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("ordersposition", "courses_id"))
		{
	Schema::table("ordersposition", function (Blueprint $table)  {
		$table->integer("courses_id")->unsigned();

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
		if (Schema::hasColumn("ordersposition", "courses_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("ordersposition");
			Schema::table("ordersposition", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("ordersposition_courses_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("ordersposition_courses_id_foreign");
					$table->dropColumn("courses_id");
				}else{
					$table->dropColumn("courses_id");
				}
			Schema::enableForeignKeyConstraints();
			});
		}
		Schema::enableForeignKeyConstraints();

    }
}
