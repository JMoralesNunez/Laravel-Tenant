<?php

namespace Database\Seeders;

use App\Models\CentralAdmin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CentralAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CentralAdmin::create([
            'name' => 'Admin MultiStore',
            'email' => 'admin@multistore.test',
            'password' => 'password',
        ]);

        CentralAdmin::create([
            'name' => 'Super Admin',
            'email' => 'super@multistore.test',
            'password' => 'password',
        ]);
    }
}
