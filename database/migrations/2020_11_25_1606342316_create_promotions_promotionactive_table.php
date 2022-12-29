<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionspromotionactiveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("promotionactive", "promotions_id"))
		{
	Schema::table("promotionactive", function (Blueprint $table)  {
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
		if (Schema::hasColumn("promotionactive", "promotions_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("promotionactive");
			Schema::table("promotionactive", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("promotionactive_promotions_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("promotionactive_promotions_id_foreign");
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
