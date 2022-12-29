<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCareerscareersresponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("careersresponses", "careers_id"))
		{
	Schema::table("careersresponses", function (Blueprint $table)  {
		$table->integer("careers_id")->unsigned();

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
		if (Schema::hasColumn("careersresponses", "careers_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("careersresponses");
			Schema::table("careersresponses", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("careersresponses_careers_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("careersresponses_careers_id_foreign");
					$table->dropColumn("careers_id");
				}else{
					$table->dropColumn("careers_id");
				}
			Schema::enableForeignKeyConstraints();
			});
		}
		Schema::enableForeignKeyConstraints();

    }
}
