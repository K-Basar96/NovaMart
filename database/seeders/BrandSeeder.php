<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder {
    /**
    * Run the database seeds.
    */

    public function run(): void {
        $brands = [
            // Sportswear Brands
            [
                'name' => 'Nike',
                'logo' => 'brands/nike.png',
            ],
            [
                'name' => 'Adidas',
                'logo' => 'brands/adidas.png',
            ],
            [
                'name' => 'Puma',
                'logo' => 'brands/puma.png',
            ],
            [
                'name' => 'Under Armour',
                'logo' => 'brands/underarmour.png',
            ],
            [
                'name' => 'Reebok',
                'logo' => 'brands/reebok.png',
            ],

            // Electronics Brands
            [
                'name' => 'Apple',
                'logo' => 'brands/apple.png',
            ],
            [
                'name' => 'Samsung',
                'logo' => 'brands/samsung.png',
            ],
            [
                'name' => 'Sony',
                'logo' => 'brands/sony.png',
            ],
            [
                'name' => 'LG',
                'logo' => 'brands/lg.png',
            ],
            [
                'name' => 'Dell',
                'logo' => 'brands/dell.png',
            ],
            [
                'name' => 'HP',
                'logo' => 'brands/hp.png',
            ],
            [
                'name' => 'Lenovo',
                'logo' => 'brands/lenovo.png',
            ],

            // Fashion Brands
            [
                'name' => 'Gucci',
                'logo' => 'brands/gucci.png',
            ],
            [
                'name' => 'Louis Vuitton',
                'logo' => 'brands/louisvuitton.png',
            ],
            [
                'name' => 'Zara',
                'logo' => 'brands/zara.png',
            ],
            [
                'name' => 'H&M',
                'logo' => 'brands/hm.png',
            ],
            [
                'name' => 'Versace',
                'logo' => 'brands/versace.png',
            ],

            // Furniture Brands
            [
                'name' => 'IKEA',
                'logo' => 'brands/ikea.png',
            ],
            [
                'name' => 'Ashley Furniture',
                'logo' => 'brands/ashleyfurniture.png',
            ],
            [
                'name' => 'Supreme',
                'logo' => 'brands/supreme.png',
            ],
        ];

        Brand::insert( $brands );
    }
}