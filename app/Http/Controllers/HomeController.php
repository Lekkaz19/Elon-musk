<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curiosidad;
use App\Models\Innovacion;
use App\Models\BiografiaEvento;

class HomeController extends Controller
{
    public function index()
    {
        $curiosidades = Curiosidad::latest()->take(3)->get();
        $innovaciones = Innovacion::latest()->take(3)->get();
        $biografiaEventos = BiografiaEvento::latest()->take(3)->get();

        return view('home', compact('curiosidades', 'innovaciones', 'biografiaEventos'));
    }
}
