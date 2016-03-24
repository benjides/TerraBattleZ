<?php

use Illuminate\Database\Seeder;

use App\Character;
use App\Iteration;
use App\Affection;
use App\Race;
use App\Job;
use App\Item;
use App\Skill;
use App\JobItem;
use App\JobSkill;
use Faker\Factory as Faker;

class CharacterSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker::create();
		for ($i=1; $i<200; $i++)
		{
			$name = $faker->shuffle($faker->word()).$faker->shuffle($faker->word());
			$recodeID = $faker->boolean(50) ? rand (0,$i) : NULL ;
			$race = Race::orderByRaw("RAND()")->first();
			Character::create(
				[
					'name'=>$name,
          'savename'=>$name,
					'class'=>$faker->randomElement($array = array ('A','B','C','D','S','SS','Z')),
          'race'=> $race->race,
          'pot'=>$faker->boolean(50),
          'pof'=>$faker->boolean(50),
          'adventurer'=>$faker->boolean(50),
				]
			);
			for ($t=1; $t < 4 ; $t++) {
				Job::create(
					[
						'name' => $faker->shuffle($faker->name()),
	          'number' => $t,
	          'element' => $faker->randomElement($array = array ('None','Fire','Ice','Darkness','Lightning','Heal','Remedy')),
	          'weapon' => $faker->randomElement($array = array ('Sword','Bow','Spear','Staff')),
	          'minHP' => $faker->numberBetween(0, 130),
	          'maxHP' => $faker->numberBetween(200, 900),
	          'minATK' => $faker->numberBetween(0, 130),
	          'maxATK'=> $faker->numberBetween(200, 900),
	          'minDEF' => $faker->numberBetween(0, 130),
	          'maxDEF'=> $faker->numberBetween(200, 900),
	          'minMATK' => $faker->numberBetween(0, 130),
	          'maxMATK'=> $faker->numberBetween(200, 900),
	          'minMDEF' => $faker->numberBetween(0, 130),
	          'maxMDEF'=> $faker->numberBetween(200, 900),
	          'character_id'=> $i,
					]
				);
				for ($s=1; $s < 5 ; $s++) {
					$skill = Skill::orderByRaw("RAND()")->first();
					$affection = Affection::orderByRaw("RAND()")->first();
					JobSkill::create(
						[
							'lvl' => rand(0,15*$s),
							'skill_name' => $skill->name,
							'affection'=> $affection->affection,
							'frequency' => rand(0,101),
							'job_id' => $t*$i,
						]
					);
					$item = Item::orderByRaw("RAND()")->first();;
					JobItem::create(
						[
							'quantity' => rand(0,51),
							'item_name' => $item->name,
							'job_id' => $t*$i,
						]
					);
				}

			}

			for ($j=0; $j < rand(1,8) ; $j++) {
				Iteration::create(
				[
					'trigger'=> $faker->word(),
					'content'=> $faker->text(),
					'character_id'=> $i,
					'trigger_id' => NULL
				]
			);
			}
		}

	}

}
