<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $events = [
            [
                'title' => 'Evento 1',
                'description' => 'Descripción del evento 1',
                'images' => json_encode([
                    ['url' => 'https://example.com/image1.jpg', 'alt' => 'Imagen 1'],
                    ['url' => 'https://example.com/image2.jpg', 'alt' => 'Imagen 2']
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Evento 2',
                'description' => 'Descripción del evento 2',
                'images' => json_encode([
                    ['url' => 'https://example.com/image3.jpg', 'alt' => 'Imagen 3'],
                    ['url' => 'https://example.com/image4.jpg', 'alt' => 'Imagen 4']
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Agrega más eventos aquí según sea necesario
            [
                'title' => 'Evento 3',
                'description' => 'Descripción del evento 2',
                'images' => json_encode([
                    ['url' => 'https://example.com/image3.jpg', 'alt' => 'Imagen 3'],
                    ['url' => 'https://example.com/image4.jpg', 'alt' => 'Imagen 4']
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('events')->insert($events);
    }
}
