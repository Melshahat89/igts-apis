<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTalksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('talks', function (Blueprint $table) {
            $table->increments('id');
            $table->string("title")->nullable();
			$table->string("slug")->nullable();
			$table->string("subtitle")->nullable();
			$table->text("description")->nullable();
			$table->integer("language_id")->nullable();
			$table->integer("length")->nullable();
			$table->boolean("featured")->nullable();
			$table->boolean("published")->nullable();
			$table->integer("visits")->nullable();
			$table->string("video_file")->nullable();
			$table->integer("sort")->nullable();
			$table->string("doctor_name")->nullable();
			$table->text("seo_desc")->nullable();
			$table->text("seo_keys")->nullable();
			$table->text("search_keys")->nullable();
			$table->string("image")->nullable();
			$table->string("promoPoster")->nullable();
			$table->string("cover")->nullable();
			
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
        Schema::dropIfExists('talks');
    }
}
