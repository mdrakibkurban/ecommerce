<?php

namespace Database\Seeders;

use App\Models\Shipping;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShippingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shipping::create([
            'user_id' => 1,
            'name' => "rakib",
            'email' => "rakib@gmail.com",
            'address' => "netrokona",
            'mobile' => "01976009329",
            'pincode' => "123",
            'status' => 1,
        ]);
    }
}
