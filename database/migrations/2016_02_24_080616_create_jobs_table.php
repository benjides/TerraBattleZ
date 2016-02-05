<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('jobs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('character_id')->unsigned();
			$table->integer('number')->unsigned();
			$table->string('name')->unique();
			$table->string('weapon');
			$table->string('element');
			$table->integer('minHP')->unsigned();
			$table->integer('maxHP')->unisgned();
			$table->integer('minATK')->unsigned();
			$table->integer('maxATK')->unsigned();
			$table->integer('minDEF')->unsigned();
			$table->integer('maxDEF')->unsigned();
			$table->integer('minMATK')->unsigned();
			$table->integer('maxMATK')->unsigned();
			$table->integer('minMDEF')->unsigned();
			$table->integer('maxMDEF')->unsigned();
			$table->integer('coins')->nullable()->unsigned();
			$table->timestamps();
		});

		Schema::table('jobs', function(Blueprint $table) {
       $table->foreign('character_id')->references('id')->on('characters');
    });

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('jobs');
	}

}
