<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\ShippingStatus;

class ShippingStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        ShippingStatus::create([
            "name" => "Quick Ship"
        ]);
        ShippingStatus::create([
            "name" => "Drop Ship"
        ]);
        ShippingStatus::create([
            "name" => "Custom Order"
        ]);

    }
}
