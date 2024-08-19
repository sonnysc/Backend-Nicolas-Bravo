<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CardsTableSeeder extends Seeder
{
    /**
     * Ejecuta las semillas.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cards')->insert([
            [
                'title' => 'INSCRIPCIONES',
                'imageSrc' => 'path/to/image1.png',
                'pdfLink' => 'path/to/pdf1.pdf'
            ],
            [
                'title' => 'REINSCRIPCION',
                'imageSrc' => 'path/to/image2.png',
                'pdfLink' => 'path/to/pdf2.pdf'
            ],
            [
                'title' => 'CALENDARIO',
                'imageSrc' => 'path/to/image3.png',
                'pdfLink' => 'path/to/pdf3.pdf'
            ],
            [
                'title' => 'LISTA DE ACEPTADOS',
                'imageSrc' => 'path/to/image4.png',
                'pdfLink' => 'path/to/pdf4.pdf'
            ],
        ]);
    }
}
