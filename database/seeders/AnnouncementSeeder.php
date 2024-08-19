<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Announcement;
use Carbon\Carbon;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Announcement::insert([
            [
                'title' => 'Título del Comunicado 1',
                'date' => Carbon::parse('2024-08-01'),
                'content' => 'Contenido del Comunicado 1',
                'logo' => '/img/megafono2.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Título del Comunicado 2',
                'date' => Carbon::parse('2024-08-05'),
                'content' => 'Contenido del Comunicado 2',
                'logo' => '/img/megafono2.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Título del Comunicado 3',
                'date' => Carbon::parse('2024-08-10'),
                'content' => 'Contenido del Comunicado 3',
                'logo' => '/img/megafono2.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Título del Comunicado 2',
                'date' => Carbon::parse('2024-08-05'),
                'content' => 'Contenido del Comunicado 2',
                'logo' => '/img/megafono2.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Título del Comunicado 3',
                'date' => Carbon::parse('2024-08-10'),
                'content' => 'Contenido del Comunicado 3',
                'logo' => '/img/megafono2.png',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'title' => 'Título del Comunicado 2',
                'date' => Carbon::parse('2024-08-05'),
                'content' => 'Contenido del Comunicado 2',
                'logo' => '/img/megafono2.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Título del Comunicado 3',
                'date' => Carbon::parse('2024-08-10'),
                'content' => 'Contenido del Comunicado 3',
                'logo' => '/img/megafono2.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
