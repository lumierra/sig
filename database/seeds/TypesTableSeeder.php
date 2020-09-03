<?php

use App\Type;
use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Type::truncate();

        Type::create([
           'name' => 'Makanan Berat',
           'user_id' =>  1
        ]);

        Type::create([
            'name' => 'Makanan Ringan',
            'user_id' =>  1
        ]);

        Type::create([
            'name' => 'Makanan Diet',
            'user_id' =>  1
        ]);
    }
}
