<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder {
    /**
    * Run the database seeds.
    */

    public function run(): void {
        $products = [
            [
                'name' => 'Adidas UltraBoost Shoes',
                'description' => 'Comfortable running shoes by Adidas',
                'price' => 180.00,
                'stock' => 50,
                'category_id' => 1, // Assuming category_id 1 corresponds to Sportswear
                'brand_id' => 1, // Assuming brand_id 1 corresponds to Adidas
                'image' => 'https://example.com/images/adidas-ultraboost.png',
            ],
            [
                'name' => 'Apple iPhone 14',
                'description' => 'Latest model of Apple iPhone',
                'price' => 999.00,
                'stock' => 30,
                'category_id' => 3, // Assuming category_id 3 corresponds to Mobile Phones
                'brand_id' => 2, // Assuming brand_id 2 corresponds to Apple
                'image' => 'https://example.com/images/iphone-14.png',
            ],
            [
                'name' => 'Samsung Galaxy S22',
                'description' => 'Flagship phone from Samsung',
                'price' => 849.00,
                'stock' => 25,
                'category_id' => 3, // Assuming category_id 3 corresponds to Mobile Phones
                'brand_id' => 3, // Assuming brand_id 3 corresponds to Samsung
                'image' => 'https://example.com/images/samsung-galaxy-s22.png',
            ],
            [
                'name' => 'Sony WH-1000XM5 Headphones',
                'description' => 'Noise-cancelling headphones from Sony',
                'price' => 350.00,
                'stock' => 40,
                'category_id' => 5, // Assuming category_id 5 corresponds to Audio
                'brand_id' => 4, // Assuming brand_id 4 corresponds to Sony
                'image' => 'https://example.com/images/sony-wh-1000xm5.png',
            ],
            [
                'name' => 'LG OLED TV',
                'description' => '55-inch OLED TV from LG',
                'price' => 1200.00,
                'stock' => 15,
                'category_id' => 6, // Assuming category_id 6 corresponds to Home Appliances
                'brand_id' => 5, // Assuming brand_id 5 corresponds to LG
                'image' => 'https://example.com/images/lg-oled-tv.png',
            ],
            [
                'name' => 'HP Spectre x360',
                'description' => 'High-performance laptop from HP',
                'price' => 1499.00,
                'stock' => 20,
                'category_id' => 4, // Assuming category_id 4 corresponds to Laptops
                'brand_id' => 6, // Assuming brand_id 6 corresponds to HP
                'image' => 'https://example.com/images/hp-spectre-x360.png',
            ],
        ];

        Product::insert( $products );
    }
}
