<?php

namespace App\Http\Controllers;

use App\Models\Curiosidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CuriosidadController extends Controller
{
    public function index()
    {
        $curiosidades = Curiosidad::latest()->get();
        return view('curiosidades.index', compact('curiosidades'));
    }

    public function create()
    {
        return view('curiosidades.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image_url' => 'nullable|string',
            'image_file' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['title', 'content']);

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('curiosidades', 'public');
            $data['image_url'] = $path;
        } elseif ($request->filled('image_url')) {
            $data['image_url'] = $request->image_url;
        }

        Curiosidad::create($data);

        return redirect()->route('admin.curiosidades.index')->with('success', 'Creado con éxito.');
    }

    public function show(Curiosidad $curiosidade)
    {
        $comments = $curiosidade->comentarios()
            ->where('approved', true)
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('curiosidades.show', [
            'curiosidad' => $curiosidade, 
            'comments' => $comments
        ]);
    }
    
    // Agrega métodos edit/update/destroy si faltan, usando la misma lógica de imagen
}
