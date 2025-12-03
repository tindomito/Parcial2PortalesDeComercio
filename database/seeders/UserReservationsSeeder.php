<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserReservationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear 3 usuarios no admin
        DB::table('users')->insert([
            [
                'id' => 2,
                'name' => 'Juan Pérez',
                'email' => 'juan.perez@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'María García',
                'email' => 'maria.garcia@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Carlos López',
                'email' => 'carlos.lopez@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Crear reservas para Juan Pérez (usuario 2)
        DB::table('reservations')->insert([
            [
                'event_fk' => 1, // UFC 300
                'user_fk' => 2,
                'quantity' => 2,
                'total_price' => 1000, // 500 * 2
                'status' => 'confirmed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'event_fk' => 3, // UFC Fight Night
                'user_fk' => 2,
                'quantity' => 1,
                'total_price' => 200,
                'status' => 'confirmed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Crear reservas para María García (usuario 3)
        DB::table('reservations')->insert([
            [
                'event_fk' => 2, // UFC 299
                'user_fk' => 3,
                'quantity' => 3,
                'total_price' => 1350, // 450 * 3
                'status' => 'confirmed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'event_fk' => 1, // UFC 300
                'user_fk' => 3,
                'quantity' => 1,
                'total_price' => 500,
                'status' => 'confirmed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'event_fk' => 3, // UFC Fight Night
                'user_fk' => 3,
                'quantity' => 2,
                'total_price' => 400, // 200 * 2
                'status' => 'cancelled',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Crear reservas para Carlos López (usuario 4)
        DB::table('reservations')->insert([
            [
                'event_fk' => 1, // UFC 300
                'user_fk' => 4,
                'quantity' => 4,
                'total_price' => 2000, // 500 * 4
                'status' => 'confirmed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'event_fk' => 2, // UFC 299
                'user_fk' => 4,
                'quantity' => 1,
                'total_price' => 450,
                'status' => 'confirmed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
