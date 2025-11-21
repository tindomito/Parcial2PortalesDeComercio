<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('movies')->insert([
            [
                'movie_id' => 1,
                'rating_fk' => 2,
                'title' => 'El Señor de los Anillos: La Comunidad del Anillo',
                'price' => 1999,
                'release_date' => '2002-01-31',
                'synopsis' => 'Unos tipitos bajitos se van de paseo a tirar un anillo a un volcan',
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'movie_id' => 2,
                'title' => 'La Matrix',
                'rating_fk' => 4,
                'price' => 1799,
                'release_date' => '1999-06-10',
                'synopsis' => 'Neo sigue al conejito blanco y se mete en flor de quilombo',
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'movie_id' => 3,
                'title' => 'El Discurso del Rey',
                'rating_fk' => 1,
                'price' => 2199,
                'release_date' => '2011-02-10',
                'synopsis' => 'Un rey tartamudo tiene que dar un discurso para inspirar a todo un país.',
                'created_at' => now(),
                'updated_at' => now()

            ]
        ]);

        DB::table('movies_have_genres')->insert([
            ['movie_fk' => 1, 'genre_fk' => 2],
            ['movie_fk' => 1, 'genre_fk' => 7],
            ['movie_fk' => 2, 'genre_fk' => 2],
            ['movie_fk' => 2, 'genre_fk' => 8],
            ['movie_fk' => 3, 'genre_fk' => 4],
            ['movie_fk' => 3, 'genre_fk' => 5],
        ]);
    }
}
