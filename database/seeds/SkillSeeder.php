<?php

use Illuminate\Database\Seeder;

use App\Skill;
use Faker\Factory as Faker;

class SkillSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker::create();
		for ($i=0; $i<300; $i++)
		{
			Skill::create(
				[
					'name'=>$faker->shuffle($faker->name()),
          'description'=>$faker->text(),
					'icon'=>$faker->imageUrl(100, 100, 'abstract'),
				]
			);
		}

	}

}
