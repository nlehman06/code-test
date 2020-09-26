<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::insert([
            [
                'name' => "Lawyer's Brain Mug",
                'description' => "Anatomy of a lawyer's brain... on a mug",
                'price' => '844',
                'image' => 'lawyer_mug.jpg'
            ],
            [
                'name' => "Lawyer Crew Socks",
                'description' => "Wear these dashing lawyer socks when a touch of personality is needed. The top-of-the-range craftsmanship and sharp design will elevate your work attire.",
                'price' => '1200',
                'image' => 'lawyer_socks.png'
            ],
            [
                'name' => "Lawyer Hourly Rate T-Shirt",
                'description' => "Funny rates that lawyers want to use",
                'price' => '2000',
                'image' => 'lawyer_tshirt.jpg'
            ],
        ]);
    }
}
