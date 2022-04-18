<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionspromotionusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("promotionusers", "promotions_id"))
		{
	Schema::table("promotionusers", function (Blueprint $table)  {
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
		if (Schema::hasColumn("promotionusers", "promotions_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("promotionusers");
			Schema::table("promotionusers", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("promotionusers_promotions_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("promotionusers_promotions_id_foreign");
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
