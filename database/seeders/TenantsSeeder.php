<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Seeder;

class TenantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenants = [
            [
                'name' => 'Productos de Cocina',
                'domain' => 'cocina.multistore.test',
                'business_type' => 'Cocina y Hogar',
            ],
            [
                'name' => 'Ferretería El Martillo',
                'domain' => 'ferreteria.multistore.test',
                'business_type' => 'Ferretería y Construcción',
            ],
            [
                'name' => 'Joyería Diamante',
                'domain' => 'joyeria.multistore.test',
                'business_type' => 'Joyería y Accesorios',
            ],
            [
                'name' => 'Gamer Zone',
                'domain' => 'gamer.multistore.test',
                'business_type' => 'Productos Gaming',
            ],
            [
                'name' => 'Papelería Creativa',
                'domain' => 'papeleria.multistore.test',
                'business_type' => 'Papelería y Oficina',
            ],
        ];

        foreach ($tenants as $tenantData) {
            $tenant = Tenant::create([
                'name' => $tenantData['name'],
                'business_type' => $tenantData['business_type'],
                'status' => 'active',
            ]);

            $tenant->domains()->create([
                'domain' => $tenantData['domain'],
            ]);

            $this->command->info("Tenant creado: {$tenantData['name']} - {$tenantData['domain']}");
        }
    }
}
