<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharactersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('characters', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->unique();
			$table->string('savename')->unique();
			$table->string('icon');
			$table->integer('class')->unsigned();
			$table->boolean('pot');
			$table->boolean('pof');
			$table->string('race');
			$table->string('gender');
			$table->boolean('adventurer');
			$table->timestamps();
		});

		Schema::table('characters', function(Blueprint $table) {
			$table->foreign('race')
						->references('race')->on('races')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('class')
						->references('order_key')->on('char_classes')
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
		Schema::drop('characters');
	}

}
