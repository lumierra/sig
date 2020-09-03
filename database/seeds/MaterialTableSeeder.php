<?php

use App\Material;
use Illuminate\Database\Seeder;

class MaterialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Material::truncate();

        Material::create([
            'name' => 'ayam',
            'user_id' => 1,
        ]);

        Material::create([
            'name' => 'ikan',
            'user_id' => 1,
        ]);

        Material::create([
            'name' => 'cabai merah',
            'user_id' => 1,
        ]);

        Material::create([
            'name' => 'bawang merah',
            'user_id' => 1,
        ]);
    }
}
