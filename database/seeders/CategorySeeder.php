<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['category_id'=>1, 'name'=> 'Numerado', 'created_at' => now(), 'updated_at' => now()],
            ['category_id'=>2, 'name'=> 'Fight Night', 'created_at' => now(), 'updated_at' => now()],
            ['category_id'=>3, 'name'=> 'Campeonato', 'created_at' => now(), 'updated_at' => now()],
            ['category_id'=>4, 'name'=> 'Preliminares', 'created_at' => now(), 'updated_at' => now()],
            ['category_id'=>5, 'name'=> 'Estelar', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
