<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablesCreate extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('content_entity', function(Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('type');
            $table->smallInteger('is_published')->default(0);
            $table->integer('author');
            $table->timestamps();
        });

        Schema::create('content_entity_translation', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('entity_id');
            $table->string('language', 2);
            $table->string('title', 512)->nullable();
            $table->string('html_title', 512)->nullable();
            $table->text('content');
            $table->string('url', 255)->nullable();

            $table->index('entity_id');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('content_entity');
        Schema::dropIfExists('content_entity_translation');
	}

}
