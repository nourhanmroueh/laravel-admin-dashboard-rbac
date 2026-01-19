<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
          Category::firstOrCreate(['name' => 'Clothing'], ['is_active' => true]);
        Category::firstOrCreate(['name' => 'Accessories'], ['is_active' => true]);
        Category::firstOrCreate(['name' => 'Electronics'], ['is_active' => true]);
        Category::firstOrCreate(['name' => 'Books'], ['is_active' => false]);

    }
}
