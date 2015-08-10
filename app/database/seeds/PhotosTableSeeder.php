<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PhotosTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();
		$usersId = DB::table('users')->lists('id');
		$albumsId = DB::table('albums')->lists('id');
		$imgNames = [
			'test.png',
			'sample.jpg',
			'default.jpg',
			'preview.png'
		];

		for($i = 0; $i < 100; $i++)
		{
			Photo::create([
				'title' => $faker->word(),
				'img_name' => $imgNames[rand(0, sizeof($imgNames) -1)],
				'author_id' => $usersId[rand(0, sizeof($usersId) - 1)],
				'album_id' => $albumsId[rand(0, sizeof($albumsId) - 1)]
			]);
		}
	}

}