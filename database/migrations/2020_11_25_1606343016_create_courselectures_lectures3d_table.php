<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourselectureslectures3dTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("lectures3d", "courselectures_id"))
		{
	Schema::table("lectures3d", function (Blueprint $table)  {
		$table->integer("courselectures_id")->unsigned();

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
		if (Schema::hasColumn("lectures3d", "courselectures_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("lectures3d");
			Schema::table("lectures3d", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("lectures3d_courselectures_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("lectures3d_courselectures_id_foreign");
					$table->dropColumn("courselectures_id");
				}else{
					$table->dropColumn("courselectures_id");
				}
			Schema::enableForeignKeyConstraints();
			});
		}
		Schema::enableForeignKeyConstraints();

    }
}
