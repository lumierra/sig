<?php

use App\Head;
use Illuminate\Database\Seeder;

class HeadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Head::truncate();

        Head::create([
            'name' => 'aji',
            'user_id' => 1,
        ]);
    }
}
