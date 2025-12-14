<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Curiosidad;

class CuriosidadSeeder extends Seeder
{
    public function run(): void
    {
        Curiosidad::create([
            'title' => 'Musk aprendió a programar a los 12 años',
            'content' => 'A los 12 años, Musk vendió el código de su primer videojuego, "Blastar", por aproximadamente 500 dólares, mostrando su precoz talento en la programación.',
            'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d1/Blastar_Screenshot.png/220px-Blastar_Screenshot.png', // Placeholder image
            'created_by' => 1,
        ]);

        Curiosidad::create([
            'title' => 'El personaje de Tony Stark se inspiró en Musk',
            'content' => 'Robert Downey Jr., el actor que interpreta a Iron Man en el MCU, se reunió con Musk para inspirarse en su personaje de Tony Stark, el excéntrico y brillante multimillonario inventor.',
            'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d4/Tony_Stark_%28Iron_Man%29.jpg/220px-Tony_Stark_%28Iron_Man%29.jpg', // Placeholder image
            'created_by' => 1,
        ]);

        Curiosidad::create([
            'title' => 'Es un ávido lector y autodidacta',
            'content' => 'Musk ha mencionado en varias ocasiones que gran parte de su conocimiento en áreas complejas como la cohetería lo obtuvo de la lectura intensiva de libros y manuales técnicos.',
            'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b3/Library_of_Congress_Main_Reading_Room.jpg/220px-Library_of_Congress_Main_Reading_Room.jpg', // Placeholder image
            'created_by' => 1,
        ]);

        Curiosidad::create([
            'title' => 'Fundó una escuela experimental: Ad Astra',
            'content' => 'Para sus hijos y los de algunos empleados de SpaceX, Musk fundó Ad Astra, una escuela privada y no tradicional que se enfoca en la resolución de problemas en lugar de la memorización.',
            'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Ad_Astra_School_Logo.png/220px-Ad_Astra_School_Logo.png', // Placeholder image
            'created_by' => 1,
        ]);
        
        Curiosidad::create([
            'title' => 'Casi vendió Tesla a Google en 2013',
            'content' => 'En 2013, durante un período de dificultades financieras para Tesla, Musk estuvo a punto de vender la compañía a Google por 11 mil millones de dólares.',
            'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/87/Google_logo_full_2015.svg/220px-Google_logo_full_2015.svg.png', // Placeholder image
            'created_by' => 1,
        ]);
    }
}
