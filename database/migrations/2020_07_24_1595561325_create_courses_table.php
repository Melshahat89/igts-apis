<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string("title")->nullable();
			$table->string("slug")->nullable();
			$table->text("description")->nullable();
			$table->string("welcome_message")->nullable();
			$table->string("congratulation_message")->nullable();
			$table->integer("type")->nullable();
			$table->integer("skill_level")->nullable();
			$table->integer("language_id")->nullable();
			$table->boolean("has_captions")->nullable();
			$table->boolean("has_certificate")->nullable();
			$table->integer("length")->nullable();
			$table->double("price")->nullable();
			$table->double("price_in_dollar")->nullable();
			$table->integer("affiliate1_per")->nullable();
			$table->integer("affiliate2_per")->nullable();
			$table->integer("affiliate3_per")->nullable();
			$table->integer("affiliate4_per")->nullable();
			$table->integer("instructor_per")->nullable();
			$table->double("discount_egp")->nullable();
			$table->double("discount_usd")->nullable();
			$table->boolean("featured")->nullable();
			$table->string("image")->nullable();
			$table->string("promo_video")->nullable();
			$table->string("visits")->nullable();
			$table->boolean("published")->nullable();
			$table->integer("position")->nullable();
			$table->integer("sort")->nullable();
			$table->string("doctor_name")->nullable();
			$table->boolean("full_access")->nullable();
			$table->integer("access_time")->nullable();
			$table->boolean("soon")->nullable();
			$table->text("seo_desc")->nullable();
			$table->text("seo_keys")->nullable();
			$table->text("search_keys")->nullable();
			$table->string("poster")->nullable();
			
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
