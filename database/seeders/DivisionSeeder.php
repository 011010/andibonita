<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Division;
use Illuminate\Support\Facades\DB;

/**
 * Seeder: DivisionSeeder
 *
 * Carga datos iniciales de divisiones académicas del instituto.
 * Estas divisiones son típicas de un Instituto Tecnológico en México.
 *
 * Uso:
 * php artisan db:seed --class=DivisionSeeder
 * O incluirlo en DatabaseSeeder
 */
class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Limpiar tabla antes de insertar (opcional)
        // Division::truncate();

        $divisiones = [
            [
                'nombre' => 'Ingeniería Industrial',
                'codigo' => 'IND',
                'descripcion' => 'División de Ingeniería Industrial',
                'activo' => true,
            ],
            [
                'nombre' => 'Ingeniería en Sistemas Computacionales',
                'codigo' => 'ISC',
                'descripcion' => 'División de Ingeniería en Sistemas Computacionales',
                'activo' => true,
            ],
            [
                'nombre' => 'Ingeniería Electrónica',
                'codigo' => 'ELEC',
                'descripcion' => 'División de Ingeniería Electrónica',
                'activo' => true,
            ],
            [
                'nombre' => 'Ingeniería Mecánica',
                'codigo' => 'MEC',
                'descripcion' => 'División de Ingeniería Mecánica',
                'activo' => true,
            ],
            [
                'nombre' => 'Ingeniería Eléctrica',
                'codigo' => 'ELCT',
                'descripcion' => 'División de Ingeniería Eléctrica',
                'activo' => true,
            ],
            [
                'nombre' => 'Ingeniería Química',
                'codigo' => 'QUI',
                'descripcion' => 'División de Ingeniería Química',
                'activo' => true,
            ],
            [
                'nombre' => 'Ingeniería Bioquímica',
                'codigo' => 'BIO',
                'descripcion' => 'División de Ingeniería Bioquímica',
                'activo' => true,
            ],
            [
                'nombre' => 'Ingeniería en Gestión Empresarial',
                'codigo' => 'IGE',
                'descripcion' => 'División de Ingeniería en Gestión Empresarial',
                'activo' => true,
            ],
            [
                'nombre' => 'Ingeniería Civil',
                'codigo' => 'CIV',
                'descripcion' => 'División de Ingeniería Civil',
                'activo' => true,
            ],
            [
                'nombre' => 'Contador Público',
                'codigo' => 'CP',
                'descripcion' => 'División de Contador Público',
                'activo' => true,
            ],
            [
                'nombre' => 'Arquitectura',
                'codigo' => 'ARQ',
                'descripcion' => 'División de Arquitectura',
                'activo' => true,
            ],
            [
                'nombre' => 'Ciencias Básicas',
                'codigo' => 'CB',
                'descripcion' => 'División de Ciencias Básicas (Matemáticas, Física, Química)',
                'activo' => true,
            ],
            [
                'nombre' => 'Desarrollo Académico',
                'codigo' => 'DA',
                'descripcion' => 'División de Desarrollo Académico y Tutoría',
                'activo' => true,
            ],
        ];

        // Insertar usando el modelo (recomendado para usar timestamps automáticos)
        foreach ($divisiones as $division) {
            Division::create($division);
        }

        $this->command->info('✓ Divisiones creadas exitosamente: ' . count($divisiones));
    }
}
