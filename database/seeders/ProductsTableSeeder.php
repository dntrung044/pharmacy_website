<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Cà phê đen',
                'description' => 'Một ly cà phê đen đậm đà và mạnh mẽ',
                'content' => 'Chi tiết về cà phê đen',
                'category_id' => 1, // ID của danh mục tương ứng
                'price' => 20000,
                'price_sale' => 18000,
                'active' => 1,
                'image' => 'images/cafe-den.jpg',
                'total_number' => 100,
                'total_rating' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cà phê sữa',
                'description' => 'Một ly cà phê sữa ngọt ngào và thơm ngon',
                'content' => 'Chi tiết về cà phê sữa',
                'category_id' => 1, // ID của danh mục tương ứng
                'price' => 25000,
                'price_sale' => 22000,
                'active' => 1,
                'image' => 'images/cafe-sua.jpg',
                'total_number' => 100,
                'total_rating' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
