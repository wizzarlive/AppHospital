<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        // Insertar roles con IDs FIJOS garantizados
        DB::table('roles')->insert([
            // ID 1: Administrador
            ['id' => 1, 'name' => 'admin', 'description' => 'Administrador del Sistema', 'created_at' => now(), 'updated_at' => now()],
            // ID 2: Doctor
            ['id' => 2, 'name' => 'doctor', 'description' => 'Profesional Médico', 'created_at' => now(), 'updated_at' => now()],
            // ID 3: Paciente
            ['id' => 3, 'name' => 'patient', 'description' => 'Paciente', 'created_at' => now(), 'updated_at' => now()],
            // ID 4: Administrativo
            ['id' => 4, 'name' => 'administrative', 'description' => 'Personal Administrativo', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}