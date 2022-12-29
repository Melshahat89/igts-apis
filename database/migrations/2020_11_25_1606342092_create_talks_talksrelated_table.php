<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTalkstalksrelatedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("talksrelated", "talks_id"))
		{
	Schema::table("talksrelated", function (Blueprint $table)  {
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
		if (Schema::hasColumn("talksrelated", "talks_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("talksrelated");
			Schema::table("talksrelated", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("talksrelated_talks_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("talksrelated_talks_id_foreign");
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
