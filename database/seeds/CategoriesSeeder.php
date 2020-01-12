<?php

use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for($i = 0; $i < 10; $i++)
        {
            $category = new Category();
            $category->title = $faker->domainWord;
            //$category->slug = Str::slug($category->title);
            //$category->image = $category->title;
            $category->save();
        }
    }
}
