<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('events')->insert([
            [
                'event_id' => 1,
                'rating_fk' => 2,
                'name' => 'UFC 300: Pereira vs Hill',
                'ticket_price' => 500,
                'date' => '2024-04-13',
                'description' => 'Alex Pereira defiende su título de peso semipesado contra Jamahal Hill en un evento histórico.',
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'event_id' => 2,
                'name' => 'UFC 299: O\'Malley vs Vera 2',
                'rating_fk' => 2,
                'ticket_price' => 450,
                'date' => '2024-03-09',
                'description' => 'Sean O\'Malley busca vengar su única derrota contra Chito Vera en Miami.',
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'event_id' => 3,
                'name' => 'UFC Fight Night: Moreno vs Royval 2',
                'rating_fk' => 1,
                'ticket_price' => 200,
                'date' => '2024-02-24',
                'description' => 'Brandon Moreno se enfrenta a Brandon Royval en una revancha de alto voltaje en México.',
                'created_at' => now(),
                'updated_at' => now()

            ]
        ]);

        DB::table('events_have_categories')->insert([
            ['event_fk' => 1, 'category_fk' => 1],
            ['event_fk' => 1, 'category_fk' => 3],
            ['event_fk' => 1, 'category_fk' => 5],
            ['event_fk' => 2, 'category_fk' => 1],
            ['event_fk' => 2, 'category_fk' => 3],
            ['event_fk' => 3, 'category_fk' => 2],
            ['event_fk' => 3, 'category_fk' => 5],
        ]);
    }
}
