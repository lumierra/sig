<?php

use App\Vendor;
use Illuminate\Database\Seeder;

class VendorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vendor::truncate();

        Vendor::create([
           'name' => 'Logistik',
           'description' => 'Vendor A',
            'user_id' => 1,
        ]);
    }
}
