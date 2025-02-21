<?php

namespace Database\Seeders\Master;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::truncate();

        $categories = [
            ['name' => 'Food'],
            ['name' => 'Drink' , 'parent_id' => 1],
            ['name' => 'Meal' , 'parent_id' => 1],
            ['name' => 'Snack' , 'parent_id' => 1],
            ['name' => 'Dessert' , 'parent_id' => 1],
            ['name' => 'Fruit' , 'parent_id' => 1],
            ['name' => 'Vegetable' , 'parent_id' => 1],
            ['name' => 'Meat' , 'parent_id' => 1],
            ['name' => 'Fish' , 'parent_id' => 1],
            ['name' => 'Seafood' , 'parent_id' => 1],
            ['name' => 'Beverage' , 'parent_id' => 2],
            ['name' => 'Alcohol' , 'parent_id' => 2],
            ['name' => 'Non-alcohol' , 'parent_id' => 2],
            ['name' => 'Hot' , 'parent_id' => 3],
            ['name' => 'Cold' , 'parent_id' => 3],
            ['name' => 'Sweet' , 'parent_id' => 4],
            ['name' => 'Sour' , 'parent_id' => 4],
            ['name' => 'Spicy' , 'parent_id' => 4],
            ['name' => 'Salty' , 'parent_id' => 4],
            ['name' => 'Bitter' , 'parent_id' => 4],
            ['name' => 'Savory' , 'parent_id' => 4],
            ['name' => 'Snack'],
            ['name' => 'Dessert' , 'parent_id' => 1],
            ['name' => 'Fruit'],
            ['name' => 'Vegetable'],
            ['name' => 'Meat'],
            ['name' => 'Fish'],
            ['name' => 'Seafood'],
            ['name' => 'Beverage'],
            ['name' => 'Alcohol'],
            ['name' => 'Non-alcohol'],
            ['name' => 'Hot'],
            ['name' => 'Cold'],
            ['name' => 'Sweet'],
            ['name' => 'Sour'],
            ['name' => 'Spicy'],
            ['name' => 'Salty'],
            ['name' => 'Bitter'],
            ['name' => 'Savory'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
