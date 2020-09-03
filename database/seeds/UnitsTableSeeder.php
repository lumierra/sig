<?php

use App\Unit;
use Illuminate\Database\Seeder;

class UnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unit::truncate();

        Unit::create([
           'name' => 'Kg',
           'deskripsi' => 'Kilogram',
            'user_id' => 1
        ]);
        Unit::create([
            'name' => 'Gr',
            'deskripsi' => 'Gram',
            'user_id' => 1
        ]);
        Unit::create([
            'name' => 'Bks',
            'deskripsi' => 'Bungkus',
            'user_id' => 1
        ]);
        Unit::create([
            'name' => 'Sdk',
            'deskripsi' => 'Sendok',
            'user_id' => 1
        ]);
        Unit::create([
            'name' => 'Pcs',
            'deskripsi' => 'Pieces',
            'user_id' => 1
        ]);
        Unit::create([
            'name' => 'Cup',
            'deskripsi' => 'Cup',
            'user_id' => 1
        ]);
        Unit::create([
            'name' => 'Mg',
            'deskripsi' => 'Miligram',
            'user_id' => 1
        ]);
        Unit::create([
            'name' => 'L',
            'deskripsi' => 'Liter',
            'user_id' => 1
        ]);
        Unit::create([
            'name' => 'Ml',
            'deskripsi' => 'Mililiter',
            'user_id' => 1
        ]);
    }
}
