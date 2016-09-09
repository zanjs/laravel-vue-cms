<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $categoryIds = \App\Category::lists('id')->toArray();
        $tagIds = \App\Tag::lists('id')->toArray();

        foreach (range(1, 30) as $index) {

            $post = \App\Post::create([
                'title' => $faker->title(),
                'description' => $faker->sentence(),
                'status' => 1,
                'latitude' => $faker->latitude($min = -90, $max = 90),
                'longitude' => $faker->longitude($min = -180, $max = 180),
                'address' => $faker->address(),
                'category_id' => $faker->randomElement($categoryIds),
                'content' => $faker->paragraph()
            ]);

            $tags = $faker->randomElements($tagIds, 3);

            $post->tags()->sync($tags);

        }
    }
}
