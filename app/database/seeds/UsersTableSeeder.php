<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		$emails = [];
		while(sizeof($emails) < 10)
		{
			$generatedEmail = $faker->email();
			if (in_array($generatedEmail, $emails)) {
				continue;
			}

			array_push($emails, $generatedEmail);

			User::create([
				'username' => $faker->username(),
				'email' => $generatedEmail,
				'password' => $faker->sha256()
			]);
		}

		User::create([
				'username' => 'admin',
				'email' => 'admin@admin.com',
				'password' => Hash::make('123456')
			]);
	}

}