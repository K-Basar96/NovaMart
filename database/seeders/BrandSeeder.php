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
            [
                'name' => 'Adidas',
                'logo' => 'https://example.com/logos/adidas.png', // Example logo URL
            ],
            [
                'name' => 'Apple',
                'logo' => 'https://example.com/logos/apple.png',
            ],
            [
                'name' => 'Samsung',
                'logo' => 'https://example.com/logos/samsung.png',
            ],
            [
                'name' => 'Sony',
                'logo' => 'https://example.com/logos/sony.png',
            ],
            [
                'name' => 'LG',
                'logo' => 'https://example.com/logos/lg.png',
            ],
            [
                'name' => 'HP',
                'logo' => 'https://example.com/logos/hp.png',
            ],
        ];
        Brand::insert( $brands );
    }
}
