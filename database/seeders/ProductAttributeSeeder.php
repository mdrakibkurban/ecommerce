<?php

namespace Database\Seeders;

use App\Models\ProductAttribute;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            ProductAttribute::create([
                'product_id' => 1,
                'size'       => 'small',
                'price'      => 100,
                'stock'      => 10,
                'sku'        => 'sh-s', 
                'color'      => 'red', 
            ]);
            
            ProductAttribute::create([
                'product_id' => 1,
                'size'       => 'medium',
                'price'      => 200,
                'stock'      => 20,
                'sku'        => 'sh-m', 
                'color'      => 'black', 
            ]);

            ProductAttribute::create([
                'product_id' => 1,
                'size'       => 'large',
                'price'      => 250,
                'stock'      => 15,
                'sku'        => 'sh-l', 
                'color'      => 'blue', 
            ]);
       
    }
}
