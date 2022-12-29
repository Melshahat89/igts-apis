<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursescoursewishlistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("coursewishlist", "courses_id"))
		{
	Schema::table("coursewishlist", function (Blueprint $table)  {
		$table->integer("courses_id")->unsigned();
		$table->foreign("courses_id")->references("id")->on("courses")->onDelete("cascade");

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
		if (Schema::hasColumn("coursewishlist", "courses_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("coursewishlist");
			Schema::table("coursewishlist", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("coursewishlist_courses_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("coursewishlist_courses_id_foreign");
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
