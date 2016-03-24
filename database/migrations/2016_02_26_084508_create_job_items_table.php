<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('job_items', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('job_id')->unsigned();
			$table->string('item_name');
			$table->integer('quantity');
			$table->timestamps();
		});
		Schema::table('job_items', function(Blueprint $table) {
      $table->foreign('job_id')
						->references('id')->on('jobs')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('item_name')
						->references('name')->on('items')
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
		Schema::drop('job_items');
	}

}
