<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Do NOT truncate because of foreign keys
        Product::query()->delete();

        // Fetch categories safely
        $clothing     = Category::where('name', 'Clothing')->first();
        $accessories  = Category::where('name', 'Accessories')->first();
        $electronics  = Category::where('name', 'Electronics')->first();

        // Products
        Product::create([
            'name'        => 'Laptop',
            'price'       => 1200,
            'is_active'   => true,
            'category_id' => $electronics?->id,
        ]);

        Product::create([
            'name'        => 'Phone',
            'price'       => 800,
            'is_active'   => true,
            'category_id' => $electronics?->id,
        ]);

        Product::create([
            'name'        => 'Headphones',
            'price'       => 150,
            'is_active'   => false,
            'category_id' => $accessories?->id,
        ]);

        Product::create([
            'name'        => 'Dress',
            'price'       => 50,
            'is_active'   => true,
            'category_id' => $clothing?->id,
        ]);

        Product::create([
            'name'        => 'Pant',
            'price'       => 50,
            'is_active'   => false,
            'category_id' => $clothing?->id,
        ]);
    }
}
