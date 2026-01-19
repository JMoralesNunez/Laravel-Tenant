<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database (Central database).
     */
    public function run(): void
    {
        $this->call([
            CentralAdminSeeder::class,
            TenantsSeeder::class,
            TenantAdminSeeder::class,
        ]);

        $this->command->info('✅ Central database seeded successfully!');
    }
}
