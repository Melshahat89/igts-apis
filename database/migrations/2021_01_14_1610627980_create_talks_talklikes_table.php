<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTalkstalklikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("talklikes", "talks_id"))
		{
	Schema::table("talklikes", function (Blueprint $table)  {
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
		if (Schema::hasColumn("talklikes", "talks_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("talklikes");
			Schema::table("talklikes", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("talklikes_talks_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("talklikes_talks_id_foreign");
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
