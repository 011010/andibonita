<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run() {
        // \App\Models\User::factory(10)->create();
   
        $user = new User;
        $user->Usuario = 'Admin';
        $user->Contraseña = '123456';
        $user->Correo_electronico = 'admin@test.com';  
        $user->role = 'admin';

        $user->save();
    }
}