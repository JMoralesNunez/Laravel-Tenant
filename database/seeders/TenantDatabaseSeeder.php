<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class TenantDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds for tenant database.
     */
    public function run(): void
    {
        $tenant = tenant();

        // Different products based on business type
        $products = $this->getProductsForTenant($tenant->business_type);

        foreach ($products as $product) {
            Product::create($product);
        }

        $this->command->info("✅ Productos creados para: {$tenant->name}");
    }

    /**
     * Get products based on business type
     */
    private function getProductsForTenant(?string $businessType): array
    {
        return match ($businessType) {
            'Cocina y Hogar' => [
                ['name' => 'Juego de Ollas Premium', 'description' => 'Set de 12 ollas de acero inoxidable', 'price' => 299.99],
                ['name' => 'Licuadora Industrial', 'description' => 'Licuadora de alta potencia 1200W', 'price' => 189.50],
                ['name' => 'Sartén Antiadherente', 'description' => 'Sartén de cerámica 28cm', 'price' => 45.00],
                ['name' => 'Procesador de Alimentos', 'description' => 'Procesador multifunción 800W', 'price' => 120.00],
                ['name' => 'Batidora de Mano', 'description' => 'Batidora eléctrica con accesorios', 'price' => 65.00],
            ],
            'Ferretería y Construcción' => [
                ['name' => 'Taladro Percutor', 'description' => 'Taladro eléctrico 850W con maletín', 'price' => 150.00],
                ['name' => 'Juego de Llaves', 'description' => 'Set de 24 llaves métricas', 'price' => 45.00],
                ['name' => 'Sierra Eléctrica', 'description' => 'Sierra circular 1400W', 'price' => 220.00],
                ['name' => 'Caja de Herramientas', 'description' => 'Caja metálica con 100 piezas', 'price' => 85.00],
                ['name' => 'Martillo Profesional', 'description' => 'Martillo de acero forjado 500g', 'price' => 25.00],
            ],
            'Joyería y Accesorios' => [
                ['name' => 'Collar de Plata 925', 'description' => 'Collar elegante con piedras', 'price' => 350.00],
                ['name' => 'Anillo de Compromiso', 'description' => 'Anillo oro 18k con diamante', 'price' => 1250.00],
                ['name' => 'Aretes de Perla', 'description' => 'Aretes con perlas cultivadas', 'price' => 180.00],
                ['name' => 'Pulsera de Oro', 'description' => 'Pulsera tejida oro 14k', 'price' => 890.00],
                ['name' => 'Reloj de Lujo', 'description' => 'Reloj suizo automático', 'price' => 2500.00],
            ],
            'Productos Gaming' => [
                ['name' => 'Mouse Gamer RGB', 'description' => 'Mouse óptico 16000 DPI', 'price' => 75.00],
                ['name' => 'Teclado Mecánico', 'description' => 'Teclado RGB switches azules', 'price' => 130.00],
                ['name' => 'Audífonos Gaming 7.1', 'description' => 'Audífonos con sonido envolvente', 'price' => 95.00],
                ['name' => 'Silla Gamer Ergonómica', 'description' => 'Silla reclinable con soporte lumbar', 'price' => 350.00],
                ['name' => 'Monitor Curvo 27"', 'description' => 'Monitor 144Hz QHD', 'price' => 420.00],
            ],
            'Papelería y Oficina' => [
                ['name' => 'Resma de Papel A4', 'description' => 'Paquete de 500 hojas premium', 'price' => 12.50],
                ['name' => 'Set de Marcadores', 'description' => 'Caja de 48 colores', 'price' => 25.00],
                ['name' => 'Calculadora Científica', 'description' => 'Calculadora programable', 'price' => 35.00],
                ['name' => 'Archivador Metálico', 'description' => 'Archivador 4 gavetas', 'price' => 280.00],
                ['name' => 'Cuadernos Universitarios', 'description' => 'Pack de 5 cuadernos 100 hojas', 'price' => 18.00],
            ],
            default => [
                ['name' => 'Producto de Ejemplo 1', 'description' => 'Descripción del producto', 'price' => 50.00],
                ['name' => 'Producto de Ejemplo 2', 'description' => 'Descripción del producto', 'price' => 75.00],
                ['name' => 'Producto de Ejemplo 3', 'description' => 'Descripción del producto', 'price' => 100.00],
            ],
        };
    }
}
