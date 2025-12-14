<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Innovacion;

class InnovacionSeeder extends Seeder
{
    public function run(): void
    {
        Innovacion::create([
            'title' => 'Coches Eléctricos de Alto Rendimiento (Tesla)',
            'description' => 'Tesla ha revolucionado la industria automotriz con sus vehículos eléctricos de alto rendimiento, autonomía extendida y un enfoque en la sostenibilidad, haciendo la electrificación atractiva para el mercado masivo.',
            'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/bb/2016_Tesla_Model_S_P90D_Ludicrous_DSC_0093_%2824368945690%29.jpg/220px-2016_Tesla_Model_S_P90D_Ludicrous_DSC_0093_%2824368945690%29.jpg',
            'created_by' => 1,
        ]);

        Innovacion::create([
            'title' => 'Cohetes Reutilizables (SpaceX)',
            'description' => 'SpaceX ha logrado un hito histórico al desarrollar y perfeccionar cohetes reutilizables como el Falcon 9, reduciendo drásticamente el costo de los lanzamientos espaciales y abriendo el camino a la exploración de Marte.',
            'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/36/Falcon_9_CRS-8_first_stage_landing_on_OS_in_Atlantic.jpg/220px-Falcon_9_CRS-8_first_stage_landing_on_OS_in_Atlantic.jpg',
            'created_by' => 1,
        ]);

        Innovacion::create([
            'title' => 'Internet Satelital Global (Starlink)',
            'description' => 'Starlink, una constelación de satélites de SpaceX, tiene como objetivo proporcionar acceso a internet de banda ancha de baja latencia a nivel mundial, especialmente en áreas rurales y con poca conectividad.',
            'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d7/Starlink_satellites_in_orbit.jpg/220px-Starlink_satellites_in_orbit.jpg',
            'created_by' => 1,
        ]);

        Innovacion::create([
            'title' => 'Interfaces Cerebro-Computadora (Neuralink)',
            'description' => 'Neuralink está desarrollando interfaces cerebro-computadora (BCI) de ultra alta banda ancha con el fin de ayudar a personas con parálisis y, eventualmente, permitir la simbiosis entre humanos y la inteligencia artificial.',
            'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6f/Neuralink_logo.png/220px-Neuralink_logo.png',
            'created_by' => 1,
        ]);

        Innovacion::create([
            'title' => 'El Proyecto Hyperloop',
            'description' => 'Musk propuso el concepto de Hyperloop, un sistema de transporte de alta velocidad que utiliza cápsulas presurizadas moviéndose a través de tubos al vacío, prometiendo reducir drásticamente los tiempos de viaje.',
            'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/07/Hyperloop_concept.jpg/220px-Hyperloop_concept.jpg',
            'created_by' => 1,
        ]);
    }
}
