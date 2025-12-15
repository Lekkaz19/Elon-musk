<?php

namespace App\Http\Controllers;

use App\Models\Comentario as ContentComment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Muestra todos los comentarios (SOLO ADMIN)
     * 
     * Permite filtrar por estado:
     * - ?filter=pending → Solo comentarios pendientes de aprobación
     * - ?filter=approved → Solo comentarios aprobados
     * - ?filter=all o sin parámetro → Todos los comentarios
     */
    public function index(Request $request)
    {
        // Obtener filtro de la URL
        $filter = $request->get('filter', 'all');

        // Query base con relaciones cargadas
        $query = ContentComment::with(['user', 'commentable']);

        // Aplicar filtro según lo solicitado
        switch ($filter) {
            case 'pending':
                $query->where('approved', false);
                break;
            case 'approved':
                $query->where('approved', true);
                break;
            case 'all':
            default:
                // No aplicar filtro, mostrar todos
                break;
        }

        // Ordenar por más recientes primero y paginar
        $comments = $query->orderBy('created_at', 'desc')->paginate(20);

        // Obtener contadores para los filtros
        $pendientes = ContentComment::where('approved', false)->count();
        $aprobados = ContentComment::where('approved', true)->count();

        return view('admin.comentarios.index', compact('comments', 'pendientes', 'aprobados', 'filter'));
    }

    /**
     * Guarda un nuevo comentario (USUARIO NORMAL)
     * 
     * Los comentarios se guardan con approved = false por defecto
     * El admin debe aprobarlos desde el panel
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string|min:3|max:1000',
            'commentable_type' => 'required|string|in:App\Models\Innovacion,App\Models\Curiosidad,App\Models\BiografiaEvento',
            'commentable_id' => 'required|integer|exists:innovaciones,id', // Ajustar según el tipo
        ], [
            'content.required' => 'El comentario no puede estar vacío',
            'content.min' => 'El comentario debe tener al menos 3 caracteres',
            'content.max' => 'El comentario no puede superar 1000 caracteres',
        ]);

        // Crear comentario asociado al usuario actual
        ContentComment::create([
            'user_id' => auth()->id(),
            'content' => $validated['content'],
            'commentable_type' => $validated['commentable_type'],
            'commentable_id' => $validated['commentable_id'],
            'approved' => false, // Por defecto, requiere aprobación
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Comentario enviado. Será visible una vez aprobado por un administrador.');
    }

    /**
     * Aprueba un comentario (SOLO ADMIN)
     */
    public function approve(ContentComment $comment)
    {
        $comment->update([
            'approved' => true,
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Comentario aprobado exitosamente');
    }

    /**
     * Elimina un comentario (SOLO ADMIN)
     */
    public function destroy(ContentComment $comment)
    {
        $comment->delete();

        return back()->with('success', 'Comentario eliminado exitosamente');
    }
}
