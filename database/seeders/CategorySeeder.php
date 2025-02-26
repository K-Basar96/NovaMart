<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder {
    /**
    * Run the database seeds.
    */

    public function run(): void {
        $categories = [
            [
                'name' => 'Sportswear',
                'description' => 'Find the latest athletic clothing and footwear for all sports. Stay comfortable and stylish while training or competing.',
                'image' => 'categories/sportswear.jpg',
            ],
            [
                'name' => 'Electronics',
                'description' => 'Discover the newest gadgets and tech essentials. From smartphones to smart home devices, we have it all.',
                'image' => 'categories/electronics.jpg',
            ],
            [
                'name' => 'Fashion',
                'description' => 'Explore trendy clothing, footwear, and accessories for all seasons. Stay ahead in style with the latest fashion collections.',
                'image' => 'categories/fashion.jpg',
            ],
            [
                'name' => 'Furniture',
                'description' => 'Upgrade your home with stylish and functional furniture. Find pieces that suit your space, from modern to classic designs.',
                'image' => 'categories/furniture.jpg',
            ],
            [
                'name' => 'Beauty & Personal Care',
                'description' => 'Enhance your beauty routine with top skincare and makeup products. Discover grooming essentials for a fresh and confident look.',
                'image' => 'categories/beauty-personal-care.png',
            ],
            [
                'name' => 'Sports & Outdoors',
                'description' => 'Get the best gear for your favorite sports and outdoor adventures. Shop equipment, apparel, and accessories for an active lifestyle.',
                'image' => 'categories/sports-outdoors.jpg',
            ],
            [
                'name' => 'Baby',
                'description' => 'Shop baby essentials, clothing, and accessories. Find everything you need for newborns and growing toddlers.',
                'image' => 'categories/baby.jpg',
            ],
            [
                'name' => 'Books & Stationery',
                'description' => 'Discover a wide range of books, office supplies, and stationery. From bestsellers to study materials, we have it all.',
                'image' => 'categories/books-stationery.jpg',
            ],
            [
                'name' => 'Audio',
                'description' => 'Find the latest athletic clothing and footwear for all sports. Stay comfortable and stylish while training or competing.',
                'image' => 'categories/audio.jpg',
            ],
            [
                'name' => 'Gaming',
                'description' => 'Explore the latest gaming consoles, accessories, and video games. Level up your gaming experience with top-rated gear.',
                'image' => 'categories/gaming.png',
            ],

        ];

        Category::insert( $categories );
    }
}
