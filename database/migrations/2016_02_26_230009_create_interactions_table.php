<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInteractionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('interactions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('trigger');
			$table->string('content');
			$table->integer('character_id')->unsigned();
			$table->integer('trigger_id')->nullable()->unsigned();
			$table->timestamps();
		});

		Schema::table('interactions', function(Blueprint $table) {
			$table->foreign('character_id')
						->references('id')->on('characters')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('trigger_id')
						->references('id')->on('characters')
						->onDelete('cascade')
						->onUpdate('cascade');
    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('iterations');
	}

}
