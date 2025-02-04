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
                'description' => 'Clothing and gear for sports and fitness.',
            ],
            [
                'name' => 'Electronics',
                'description' => 'Devices and gadgets for everyday use.',
            ],
            [
                'name' => 'Mobile Phones',
                'description' => 'Smartphones and accessories.',
            ],
            [
                'name' => 'Laptops',
                'description' => 'Portable computers for work and play.',
            ],
            [
                'name' => 'Audio',
                'description' => 'Headphones, speakers, and audio equipment.',
            ],
            [
                'name' => 'Home Appliances',
                'description' => 'Appliances for home use, including kitchen and cleaning.',
            ],
        ];
        Category::insert( $categories );
    }
}
