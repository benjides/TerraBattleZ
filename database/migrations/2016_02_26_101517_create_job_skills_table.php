<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobSkillsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('job_skills', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('job_id')->unsigned();
			$table->integer('lvl')->unsigned();
			$table->string('skill_name');
			$table->string('affection');
			$table->integer('frequency')->unsigned();
			$table->timestamps();
		});
		Schema::table('job_skills', function(Blueprint $table) {
      $table->foreign('job_id')
						->references('id')->on('jobs')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('skill_name')
						->references('name')->on('skills')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('affection')
						->references('affection')->on('affections')
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
		Schema::drop('job_skills');
	}

}
