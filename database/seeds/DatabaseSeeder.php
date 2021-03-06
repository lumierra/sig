<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        // DB::connection('sqlsrv_server2')->table('GZ_ROLE_USER')->truncate();

        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        // $this->call(UnitsTableSeeder::class);
        // $this->call(MaterialTableSeeder::class);
        // $this->call(TypesTableSeeder::class);
        // $this->call(VendorsTableSeeder::class);
        // $this->call(HeadsTableSeeder::class);
    }
}
