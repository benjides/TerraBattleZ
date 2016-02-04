<?php

use Illuminate\Database\Seeder;

use App\Item;
use Faker\Factory as Faker;

class ItemSeeder extends Seeder {

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
			Item::create(
				[
					'name'=>$faker->shuffle($faker->name()),
          'description'=>$faker->text(),
					'icon'=>$faker->imageUrl(100, 100, 'abstract'),
				]
			);
		}

	}

}
