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
                'name' => 'Adidas Ultraboost',
                'description' => 'Comfortable running shoes from Adidas',
                'price' => 180.00,
                'stock' => 50,
                'category_id' => 9, // Sportswear
                'brand_id' => 1, // Adidas
                'image' => 'products/adidas_ultraboost.png',
            ],
            [
                'name' => 'Apple iPhone 14',
                'description' => 'Latest smartphone from Apple',
                'price' => 999.00,
                'stock' => 30,
                'category_id' => 5, // Electronics
                'brand_id' => 2, // Apple
                'image' => 'products/apple_iphone14.png',
            ],
            [
                'name' => 'Ashley Furniture Sofa',
                'description' => 'Stylish and comfortable sofa',
                'price' => 799.00,
                'stock' => 15,
                'category_id' => 6, // Furniture
                'brand_id' => 3, // Ashley Furniture
                'image' => 'products/ashley_sofa.png',
            ],
            [
                'name' => 'Dell XPS 13',
                'description' => 'Premium laptop from Dell',
                'price' => 1299.00,
                'stock' => 25,
                'category_id' => 4, // Electronics
                'brand_id' => 4, // Dell
                'image' => 'products/dell_xps13.png',
            ],
            [
                'name' => 'Gucci Handbag',
                'description' => 'Luxury handbag from Gucci',
                'price' => 2500.00,
                'stock' => 10,
                'category_id' => 5, // Fashion
                'brand_id' => 5, // Gucci
                'image' => 'products/gucci_handbag.png',
            ],
            [
                'name' => 'H&M T-Shirt',
                'description' => 'Casual t-shirt from H&M',
                'price' => 25.00,
                'stock' => 100,
                'category_id' => 9, // Sportswear
                'brand_id' => 6, // H&M
                'image' => 'products/hm_tshirt.png',
            ],
            [
                'name' => 'HP Envy 15',
                'description' => 'High-performance laptop from HP',
                'price' => 1499.00,
                'stock' => 20,
                'category_id' => 4, // Electronics
                'brand_id' => 7, // HP
                'image' => 'products/hp_envy15.png',
            ],
            [
                'name' => 'IKEA Billy Bookcase',
                'description' => 'Classic bookcase from IKEA',
                'price' => 79.00,
                'stock' => 40,
                'category_id' => 4, // Furniture
                'brand_id' => 8, // IKEA
                'image' => 'products/ikea_billy.png',
            ],
            [
                'name' => 'Lenovo ThinkPad X1',
                'description' => 'Business laptop from Lenovo',
                'price' => 1399.00,
                'stock' => 15,
                'category_id' => 4, // Electronics
                'brand_id' => 9, // Lenovo
                'image' => 'products/lenovo_thinkpad.png',
            ],
            [
                'name' => 'LG OLED TV',
                'description' => 'High-definition OLED TV from LG',
                'price' => 2499.00,
                'stock' => 5,
                'category_id' => 5, // Electronics
                'brand_id' => 10, // LG
                'image' => 'products/lg_oledtv.png',
            ],
            [
                'name' => 'Louis Vuitton Wallet',
                'description' => 'Luxury wallet from Louis Vuitton',
                'price' => 800.00,
                'stock' => 20,
                'category_id' => 5, // Fashion
                'brand_id' => 11, // Louis Vuitton
                'image' => 'products/lv_wallet.png',
            ],
            [
                'name' => 'Nike Air Max',
                'description' => 'Stylish sneakers from Nike',
                'price' => 120.00,
                'stock' => 60,
                'category_id' => 9, // Sportswear
                'brand_id' => 12, // Nike
                'image' => 'products/nike_airmax .png',
            ],
            [
                'name' => 'Puma Running Shoes',
                'description' => 'Lightweight running shoes from Puma',
                'price' => 90.00,
                'stock' => 45,
                'category_id' => 9, // Sportswear
                'brand_id' => 13, // Puma
                'image' => 'products/puma_running_shoes.png',
            ],
            [
                'name' => 'Reebok Classic Sneakers',
                'description' => 'Timeless sneakers from Reebok',
                'price' => 75.00,
                'stock' => 50,
                'category_id' => 9, // Sportswear
                'brand_id' => 14, // Reebok
                'image' => 'products/reebok_classic.png',
            ],
            [
                'name' => 'Samsung Galaxy S21',
                'description' => 'Latest smartphone from Samsung',
                'price' => 799.00,
                'stock' => 30,
                'category_id' => 5, // Electronics
                'brand_id' => 15, // Samsung
                'image' => 'products/samsung_galaxy_s21.png',
            ],
            [
                'name' => 'Sony WH-1000XM4',
                'description' => 'Noise-canceling headphones from Sony',
                'price' => 349.00,
                'stock' => 25,
                'category_id' => 1, // Audio
                'brand_id' => 16, // Sony
                'image' => 'products/sony_wh1000xm4.png',
            ],
            [
                'name' => 'Supreme Hoodie',
                'description' => 'Trendy hoodie from Supreme',
                'price' => 150.00,
                'stock' => 20,
                'category_id' => 9, // Sportswear
                'brand_id' => 17, // Supreme
                'image' => 'products/supreme_hoodie.png',
            ],
            [
                'name' => 'Under Armour Sports Bra',
                'description' => 'Comfortable sports bra from Under Armour',
                'price' => 40.00,
                'stock' => 70,
                'category_id' => 9, // Sportswear
                'brand_id' => 18, // Under Armour
                'image' => 'products/under_armour_bra.png',
            ],
            [
                'name' => 'Versace Sunglasses',
                'description' => 'Stylish sunglasses from Versace',
                'price' => 300.00,
                'stock' => 15,
                'category_id' => 5, // Fashion
                'brand_id' => 19, // Versace
                'image' => 'products/versace_sunglasses.png',
            ],
            [
                'name' => 'Zara Dress',
                'description' => 'Elegant dress from Zara',
                'price' => 80.00,
                'stock' => 40,
                'category_id' => 5, // Fashion
                'brand_id' => 20, // Zara
                'image' => 'products/zara_dress.png',
            ],
            [
                'name' => 'Adidas Soccer Ball',
                'description' => 'Official match ball from Adidas',
                'price' => 30.00,
                'stock' => 100,
                'category_id' => 8, // Sports & Outdoors
                'brand_id' => 1, // Adidas
                'image' => 'products/adidas_soccer_ball.png',
            ],
            [
                'name' => 'Apple MacBook Pro',
                'description' => 'Powerful laptop from Apple',
                'price' => 2399.00,
                'stock' => 10,
                'category_id' => 4, // Electronics
                'brand_id' => 2, // Apple
                'image' => 'products/apple_macbook_pro.png',
            ],
            [
                'name' => 'Ashley Furniture Dining Table',
                'description' => 'Elegant dining table from Ashley Furniture',
                'price' => 599.00,
                'stock' => 8,
                'category_id' => 6, // Furniture
                'brand_id' => 3, // Ashley Furniture
                'image' => 'products/ashley_dining_table.png',
            ],
            [
                'name' => 'Dell Alienware Gaming Laptop',
                'description' => 'High-performance gaming laptop from Dell',
                'price' => 1999.00,
                'stock' => 12,
                'category_id' => 4, // Electronics
                'brand_id' => 4, // Dell
                'image' => 'products/dell_alienware.png'
            ],
            [
                'name' => 'Gucci Sneakers',
                'description' => 'Stylish sneakers from Gucci',
                'price' => 650.00,
                'stock' => 20,
                'category_id' => 9, // Sportswear
                'brand_id' => 5, // Gucci
                'image' => 'products/gucci_sneakers.png',
            ],
            [
                'name' => 'H&M Jeans',
                'description' => 'Comfortable jeans from H&M',
                'price' => 50.00,
                'stock' => 75,
                'category_id' => 5, // Fashion
                'brand_id' => 6, // H&M
                'image' => 'products/hm_jeans.png',
            ],
            [
                'name' => 'HP Omen Gaming Laptop',
                'description' => 'Gaming laptop from HP',
                'price' => 1599.00,
                'stock' => 15,
                'category_id' => 4, // Electronics
                'brand_id' => 7, // HP
                'image' => 'products/hp_omen.png',
            ],
            [
                'name' => 'IKEA Kallax Shelf',
                'description' => 'Versatile shelf from IKEA',
                'price' => 99.00,
                'stock' => 30,
                'category_id' => 6, // Furniture
                'brand_id' => 8, // IKEA
                'image' => 'products/ikea_kallax.png',
            ],
            [
                'name' => 'Lenovo Yoga Tablet',
                'description' => 'Versatile tablet from Lenovo',
                'price' => 299.00,
                'stock' => 40,
                'category_id' => 4, // Electronics
                'brand_id' => 9, // Lenovo
                'image' => 'products/lenovo_yoga_tablet.png',
            ],
            [
                'name' => 'LG Soundbar',
                'description' => 'High-quality soundbar from LG',
                'price' => 499.00,
                'stock' => 20,
                'category_id' => 1, // Audio
                'brand_id' => 10, // LG
                'image' => 'products/lg_soundbar.png',
            ],
            [
                'name' => 'Louis Vuitton Belt',
                'description' => 'Luxury belt from Louis Vuitton',
                'price' => 600.00,
                'stock' => 25,
                'category_id' => 5, // Fashion
                'brand_id' => 11, // Louis Vuitton
                'image' => 'products/lv_belt.png',
            ],
            [
                'name' => 'Nike Dri-FIT Shorts',
                'description' => 'Breathable shorts from Nike',
                'price' => 35.00,
                'stock' => 80,
                'category_id' => 9, // Sportswear
                'brand_id' => 12, // Nike
                'image' => 'products/nike_dri_fit_shorts.png',
            ],
            [
                'name' => 'Puma Backpack',
                'description' => 'Stylish backpack from Puma',
                'price' => 60.00,
                'stock' => 50,
                'category_id' => 9, // Sportswear
                'brand_id' => 13, // Puma
                'image' => 'products/puma_backpack.png',
            ],
            [
                'name' => 'Reebok Yoga Mat',
                'description' => 'Comfortable yoga mat from Reebok',
                'price' => 40.00,
                'stock' => 100,
                'category_id' => 8, // Sports & Outdoors
                'brand_id' => 14, // Reebok
                'image' => 'products/reebok_yoga_mat.png',
            ],
            [
                'name' => 'Samsung Smartwatch',
                'description' => 'Feature-rich smartwatch from Samsung',
                'price' => 299.00,
                'stock' => 25,
                'category_id' => 4, // Electronics
                'brand_id' => 15, // Samsung
                'image' => 'products/samsung_smartwatch.png',
            ],
            [
                'name' => 'Sony PlayStation 5',
                'description' => 'Next-gen gaming console from Sony',
                'price' => 499.00,
                'stock' => 10,
                'category_id' => 7, // Gaming
                'brand_id' => 16, // Sony
                'image' => 'products/sony_ps5.png',
            ],
            [
                'name' => 'Supreme Beanie',
                'description' => 'Stylish beanie from Supreme',
                'price' => 40.00,
                'stock' => 50,
                'category_id' => 9, // Sportswear
                'brand_id' => 17, // Supreme
                'image' => 'products/supreme_beanie.png',
            ],
            [
                'name' => 'Under Armour Running Shoes',
                'description' => 'Durable running shoes from Under Armour',
                'price' => 110.00,
                'stock' => 30,
                'category_id' => 9, // Sportswear
                'brand_id' => 18, // Under Armour
                'image' => 'products/under_armour_running_shoes.png',
            ],
            [
                'name' => 'Versace Handbag',
                'description' => 'Elegant handbag from Versace',
                'price' => 1200.00,
                'stock' => 5,
                'category_id' => 5, // Fashion
                'brand_id' => 19, // Versace
                'image' => 'products/versace_handbag.png',
            ],
            [
                'name' => 'Zara Blazer',
                'description' => 'Stylish blazer from Zara',
                'price' => 90.00,
                'stock' => 20,
                'category_id' => 5, // Fashion
                'brand_id' => 20, // Zara
                'image' => 'products/zara_blazer.png',
            ],
        ];

        Product::insert( $products );
    }
}
