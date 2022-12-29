<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventseventsenrollmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("eventsenrollment", "events_id"))
		{
	Schema::table("eventsenrollment", function (Blueprint $table)  {
		$table->integer("events_id")->unsigned();

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
		if (Schema::hasColumn("eventsenrollment", "events_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("eventsenrollment");
			Schema::table("eventsenrollment", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("eventsenrollment_events_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("eventsenrollment_events_id_foreign");
					$table->dropColumn("events_id");
				}else{
					$table->dropColumn("events_id");
				}
			Schema::enableForeignKeyConstraints();
			});
		}
		Schema::enableForeignKeyConstraints();

    }
}
