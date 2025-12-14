<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BiografiaEvento;

class BiografiaEventoSeeder extends Seeder
{
    public function run(): void
    {
        BiografiaEvento::create([
            'title' => 'Nacimiento y Primeros Años en Sudáfrica',
            'year' => '1971',
            'description' => 'Elon Reeve Musk nació el 28 de junio de 1971 en Pretoria, Sudáfrica. Desde joven mostró un gran interés por la ciencia ficción y la informática.',
            'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e8/Young_Elon_Musk.jpg/220px-Young_Elon_Musk.jpg',
            'created_by' => 1, 
        ]);

        BiografiaEvento::create([
            'title' => 'Fundación de Zip2 Corporation',
            'year' => '1995',
            'description' => 'En 1995, Elon y su hermano Kimbal Musk fundaron Zip2, una compañía de software web que proporcionaba guías de ciudades en línea para periódicos.',
            'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/Zip2_advertisement.png/220px-Zip2_advertisement.png',
            'created_by' => 1,
        ]);

        BiografiaEvento::create([
            'title' => 'Co-fundación de X.com (futuro PayPal)',
            'year' => '1999',
            'description' => 'Musk cofundó X.com, una de las primeras bancas en línea. La empresa se fusionó con Confinity y eventualmente se convirtió en PayPal.',
            'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a4/X.com_website_in_2000.png/220px-X.com_website_in_2000.png',
            'created_by' => 1,
        ]);

        BiografiaEvento::create([
            'title' => 'Creación de SpaceX',
            'year' => '2002',
            'description' => 'Con la visión de hacer la humanidad multi-planetaria, Musk fundó Space Exploration Technologies (SpaceX) para revolucionar la tecnología espacial.',
            'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/cb/SpaceX_CRS-2_launch_cropped.jpg/220px-SpaceX_CRS-2_launch_cropped.jpg',
            'created_by' => 1,
        ]);

        BiografiaEvento::create([
            'title' => 'Inversión y Liderazgo en Tesla, Inc.',
            'year' => '2004',
            'description' => 'Musk se unió a la junta directiva de Tesla Motors (ahora Tesla, Inc.) como su mayor accionista y presidente, con el objetivo de acelerar la transición a la energía sostenible.',
            'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/bd/Tesla_Roadster_2008_electric_sportscar_side_view.jpg/220px-Tesla_Roadster_2008_electric_sportscar_side_view.jpg',
            'created_by' => 1,
        ]);
        
        BiografiaEvento::create([
            'title' => 'Lanzamiento del Falcon 9 y Dragon',
            'year' => '2010',
            'description' => 'SpaceX logró hitos importantes con el primer lanzamiento exitoso del cohete Falcon 9 y la cápsula Dragon, abriendo una nueva era en el transporte espacial privado.',
            'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3b/Falcon_9_launch_from_Cape_Canaveral_AFS_SLC-40_01.jpg/220px-Falcon_9_launch_from_Cape_Canaveral_AFS_SLC-40_01.jpg',
            'created_by' => 1,
        ]);

        BiografiaEvento::create([
            'title' => 'Desarrollo de Neuralink',
            'year' => '2016',
            'description' => 'Musk cofundó Neuralink, una empresa de neurotecnología que busca desarrollar interfaces cerebro-computadora implantables.',
            'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6f/Neuralink_logo.png/220px-Neuralink_logo.png',
            'created_by' => 1,
        ]);
    }
}
