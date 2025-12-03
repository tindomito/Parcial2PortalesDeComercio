<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('news')->insert([
            [
                'title' => 'UFC 300: Pereira hace historia',
                'date' => '2024-04-14',
                'summary' => 'Alex Pereira defiende su título con un nocaut espectacular en el evento principal de UFC 300.',
                'content' => 'En una noche histórica para las artes marciales mixtas, Alex Pereira consolidó su legado al derrotar a Jamahal Hill en el primer asalto. El evento UFC 300 cumplió con todas las expectativas, ofreciendo combates memorables y momentos que quedarán grabados en la historia del deporte. Max Holloway también brilló con un nocaut en el último segundo para ganar el título BMF.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Makhachev vs Poirier confirmado para UFC 302',
                'date' => '2024-04-15',
                'summary' => 'Islam Makhachev defenderá su título de peso ligero contra Dustin Poirier en Nueva Jersey.',
                'content' => 'La UFC ha anunciado oficialmente que el campeón de peso ligero, Islam Makhachev, pondrá su cinturón en juego contra el veterano Dustin Poirier en el evento principal de UFC 302. Poirier, quien viene de una impresionante victoria sobre Benoit Saint Denis, buscará finalmente capturar el oro indiscutible en lo que podría ser su última oportunidad por el título.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Conor McGregor regresa en UFC 303',
                'date' => '2024-04-16',
                'summary' => 'El "Notorious" vuelve al octágono para enfrentarse a Michael Chandler en la International Fight Week.',
                'content' => 'La espera ha terminado. Dana White ha confirmado que Conor McGregor regresará a la acción en UFC 303 el 29 de junio para enfrentarse a Michael Chandler en un combate de peso welter. Este será el primer combate de McGregor desde su lesión en 2021, y se espera que sea uno de los eventos más grandes del año.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Resultados UFC Fight Night: Allen vs Curtis 2',
                'date' => '2024-04-07',
                'summary' => 'Brendan Allen se lleva la victoria en una revancha muy disputada en el UFC Apex.',
                'content' => 'Brendan Allen logró vengar su derrota anterior ante Chris Curtis, llevándose una decisión dividida en el evento principal de UFC Fight Night. La pelea fue una batalla táctica de cinco asaltos donde Allen mostró su mejora en el striking y su dominio en el grappling en los momentos clave.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
