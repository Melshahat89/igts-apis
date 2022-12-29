<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTalkstalksreviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("talksreviews", "talks_id"))
		{
	Schema::table("talksreviews", function (Blueprint $table)  {
		$table->integer("talks_id")->unsigned();

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
		if (Schema::hasColumn("talksreviews", "talks_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("talksreviews");
			Schema::table("talksreviews", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("talksreviews_talks_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("talksreviews_talks_id_foreign");
					$table->dropColumn("talks_id");
				}else{
					$table->dropColumn("talks_id");
				}
			Schema::enableForeignKeyConstraints();
			});
		}
		Schema::enableForeignKeyConstraints();

    }
}
