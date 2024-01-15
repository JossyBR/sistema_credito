<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesAndPermissionsSeeder::class);

        User::create([
            'name' => 'Sofia Gonzalez',
            'email' => 'sofi@gmail.com',
            'password' => Hash::make('admin1234'),
            'role' => 'super administrador'
        ]);
        
    

        User::create([
            'name' => 'Margarita Gutierrez',
            'email' => 'gerentegeneral@gmail.com',
            'password' => Hash::make('gerente1234'),
            'role' => 'gerente general'
        ]);
    
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
