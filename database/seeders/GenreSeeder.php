<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('genres')->insert([
            ['genre_id'=>1, 'name'=> 'Anmiación', 'created_at' => now(), 'updated_at' => now()],
            ['genre_id'=>2, 'name'=> 'Acción', 'created_at' => now(), 'updated_at' => now()],
            ['genre_id'=>3, 'name'=> 'Documental', 'created_at' => now(), 'updated_at' => now()],
            ['genre_id'=>4, 'name'=> 'Hístorica', 'created_at' => now(), 'updated_at' => now()],
            ['genre_id'=>5, 'name'=> 'Drama', 'created_at' => now(), 'updated_at' => now()],
            ['genre_id'=>6, 'name'=> 'Comedia', 'created_at' => now(), 'updated_at' => now()],
            ['genre_id'=>7, 'name'=> 'Fantasía', 'created_at' => now(), 'updated_at' => now()],
            ['genre_id'=>8, 'name'=> 'Ciencia Ficción', 'created_at' => now(), 'updated_at' => now()],
            ['genre_id'=>9, 'name'=> 'Thriller', 'created_at' => now(), 'updated_at' => now()],
            ['genre_id'=>10, 'name'=> 'Suspenso', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
