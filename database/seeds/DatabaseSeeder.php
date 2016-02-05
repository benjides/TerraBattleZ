<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		//$this->call('ItemSeeder');
		//$this->call('SkillSeeder');
		$this->call('BaseSeeder');
		//$this->call('CharacterSeeder');
		// $this->call('UserTableSeeder');
	}

}
