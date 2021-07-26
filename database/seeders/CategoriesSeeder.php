<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = ['Action', 'Drama', 'Romantic', 'Fiction', 'Adventure'];
        foreach($category as $c)
        {
            Category::create([
                'name' => $c
            ]);
        }
    }
}
