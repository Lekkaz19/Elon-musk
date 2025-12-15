<?php

namespace App\Http\Controllers;

use App\Models\BiografiaEvento;
use App\Models\Innovacion;
use App\Models\Curiosidad;
use App\Models\Comentario;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_eventos' => BiografiaEvento::count(),
            'total_innovaciones' => Innovacion::count(),
            'total_curiosidades' => Curiosidad::count(),
            'total_comentarios' => Comentario::count(),
            'comentarios_pendientes' => Comentario::where('approved', false)->count(),
            'total_usuarios' => User::count(),
        ];

        $comentarios_recientes = Comentario::with(['user', 'commentable'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact('stats', 'comentarios_recientes'));
    }
}
