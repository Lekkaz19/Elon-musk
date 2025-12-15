<?php

namespace App\Http\Controllers;

use App\Models\Curiosidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CuriosidadController extends Controller
{
    /**
     * Muestra lista de curiosidades (para usuarios normales)
     */
    public function index()
    {
        $curiosidades = Curiosidad::latest()->paginate(9);
        return view('curiosidades.index', compact('curiosidades'));
    }

    /**
     * Muestra una curiosidad específica (para usuarios normales)
     */
    public function show(Curiosidad $curiosidad)
    {
        $comments = $curiosidad->comentarios()
            ->where('approved', true)
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('curiosidades.show', [
            'curiosidad' => $curiosidad, 
            'comments' => $comments
        ]);
    }

    /**
     * Muestra formulario para crear nueva curiosidad (SOLO ADMIN)
     */
    public function create()
    {
        return view('curiosidades.create');
    }

    /**
     * Guarda nueva curiosidad en la base de datos (SOLO ADMIN)
     */
    public function store(Request $request)
    {
        // Validar datos recibidos
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_url' => 'nullable|url|max:500',
        ], [
            'title.required' => 'El título es obligatorio',
            'content.required' => 'El contenido es obligatorio',
            'image_file.image' => 'El archivo debe ser una imagen',
            'image_file.max' => 'La imagen no puede superar 2MB',
            'image_url.url' => 'La URL debe ser válida',
        ]);

        // Manejar imagen (archivo o URL)
        if ($request->hasFile('image_file')) {
            // Opción A: Usuario subió un archivo
            $path = $request->file('image_file')->store('curiosidades', 'public');
            $validated['image_url'] = $path;
        } elseif ($request->filled('image_url')) {
            // Opción B: Usuario pegó una URL
            $validated['image_url'] = $request->image_url;
        } else {
            // Sin imagen
            $validated['image_url'] = null;
        }

        // Asegurar timestamps
        $validated['created_at'] = now();
        $validated['updated_at'] = now();

        // Crear curiosidad
        Curiosidad::create($validated);

        // Redirigir con mensaje de éxito
        return redirect()
            ->route('curiosidades.index')
            ->with('success', 'Curiosidad creada exitosamente');
    }

    /**
     * Muestra formulario para editar curiosidad (SOLO ADMIN)
     */
    public function edit(Curiosidad $curiosidad)
    {
        return view('curiosidades.edit', compact('curiosidad'));
    }

    /**
     * Actualiza curiosidad en la base de datos (SOLO ADMIN)
     */
    public function update(Request $request, Curiosidad $curiosidad)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_url' => 'nullable|url|max:500',
        ]);

        // Manejar imagen actualizada
        if ($request->hasFile('image_file')) {
            // Eliminar imagen anterior si era archivo local
            if ($curiosidad->image_url && !filter_var($curiosidad->image_url, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete($curiosidad->image_url);
            }
            
            $path = $request->file('image_file')->store('curiosidades', 'public');
            $validated['image_url'] = $path;
        } elseif ($request->filled('image_url')) {
            $validated['image_url'] = $request->image_url;
        }

        $validated['updated_at'] = now();
        $curiosidad->update($validated);

        return redirect()
            ->route('curiosidades.index')
            ->with('success', 'Curiosidad actualizada exitosamente');
    }

    /**
     * Elimina curiosidad de la base de datos (SOLO ADMIN)
     */
    public function destroy(Curiosidad $curiosidad)
    {
        // Eliminar imagen si era archivo local
        if ($curiosidad->image_url && !filter_var($curiosidad->image_url, FILTER_VALIDATE_URL)) {
            Storage::disk('public')->delete($curiosidad->image_url);
        }

        $curiosidad->delete();

        return redirect()
            ->route('curiosidades.index')
            ->with('success', 'Curiosidad eliminada exitosamente');
    }
}
