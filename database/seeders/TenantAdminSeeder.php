<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\TenantAdmin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TenantAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenants = Tenant::all();

        foreach ($tenants as $tenant) {
            // Create admin for each tenant
            TenantAdmin::create([
                'tenant_id' => $tenant->id,
                'name' => 'Admin ' . $tenant->name,
                'email' => 'admin@' . $tenant->domains->first()->domain,
                'password' => 'password',
            ]);

            $this->command->info("Admin creado para: {$tenant->name}");
        }
    }
}
