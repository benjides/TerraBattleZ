<?php

use Illuminate\Database\Seeder;

use App\CharClass;
use App\Race;
use Faker\Factory as Faker;

class XtraSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker::create();
		$data = array(
			array('class'=>'D', 'order_key'=>1),
			array('class'=>'C', 'order_key'=>2),
			array('class'=>'B', 'order_key'=>3),
			array('class'=>'A', 'order_key'=>4),
			array('class'=>'S', 'order_key'=>5),
			array('class'=>'SS', 'order_key'=>6),
			array('class'=>'Z', 'order_key'=>7),
		);
		CharClass::insert($data);
		$data = array(
			array("race" => "Beastfolk"),
			array("race" => "Celestial"),
			array("race" => "Cell"),
			array("race" => "Dragon"),
			array("race" => "Eidolon"),
			array("race" => "Human"),
			array("race" => "Lizardfolk"),
			array("race" => "Machine"),
			array("race" => "Metal"),
			array("race" => "Oxsecian"),
			array("race" => "Spirit"),
			array("race" => "Stonefolk"),
			array("race" => "Wild Beast"),
		);
		Race::insert($data);

		
	}

}
