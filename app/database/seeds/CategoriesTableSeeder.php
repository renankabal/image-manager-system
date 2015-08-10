<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CategoriesTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		$categoriesNames = [];
		while(sizeof($categoriesNames) < 10)
		{
			$name = $faker->word();

			if (in_array($name, $categoriesNames)) {
				continue;
			}

			array_push($categoriesNames, $name);
			Category::create([
				'name' => $name
			]);
		}
	}

}