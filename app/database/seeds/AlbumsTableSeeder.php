<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class AlbumsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();
		$usersId = DB::table('users')->lists('id');

		for($i = 0; $i < rand(10, 20); $i++)
		{
			Album::create([
				'name' => $faker->word(),
				'owner_id' => $usersId[rand(0, sizeof($usersId) - 1)]
			]);
		}
	}

}