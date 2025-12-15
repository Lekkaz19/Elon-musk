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
        // Dashboard para usuario normal
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

    public function adminDashboard()
    {
        // Dashboard para admin
        return view('admin.dashboard', [
            'biografiaEventos' => BiografiaEvento::count(),
            'innovaciones' => Innovacion::count(),
            'curiosidades' => Curiosidad::count(),
            'comentariosPendientes' => \App\Models\Comentario::where('approved', false)->count(),
            'ultimasInnovaciones' => Innovacion::latest()->take(5)->get(),
            'ultimasCuriosidades' => Curiosidad::latest()->take(5)->get(),
            'ultimosEventos' => BiografiaEvento::latest()->take(5)->get(),
            'comentariosRecientes' => \App\Models\Comentario::with('user')->latest()->take(10)->get(),
            'totalUsuarios' => User::count()
        ]);
    }
}
