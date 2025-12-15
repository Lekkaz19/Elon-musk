<?php

namespace App\Http\Controllers;

use App\Models\BiografiaEvento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BiografiaEventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eventos = BiografiaEvento::orderBy('year', 'desc')->paginate(9);
        return view('biografia-eventos.index', ['eventos' => $eventos]);
    }

    /**
     * Display the specified resource.
     */
    public function show(BiografiaEvento $biografia_evento)
    {
        $comments = $biografia_evento->comentarios()
            ->where('approved', true)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('biografia-eventos.show', ['evento' => $biografia_evento, 'comments' => $comments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('biografia-eventos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'year' => 'required|integer|min:1900|max:2100',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_url' => 'nullable|url|max:500',
        ]);

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('biografia-eventos', 'public');
            $validated['image_url'] = $path;
        } elseif ($request->filled('image_url')) {
            $validated['image_url'] = $request->image_url;
        } else {
            $validated['image_url'] = null;
        }

        $validated['created_by'] = auth()->id();
        $validated['created_at'] = now();
        $validated['updated_at'] = now();

        BiografiaEvento::create($validated);

        return redirect()->route('biografia-eventos.index')->with('success', 'Evento biográfico creado exitosamente');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BiografiaEvento $biografia_evento)
    {
        return view('biografia-eventos.edit', ['evento' => $biografia_evento]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BiografiaEvento $biografia_evento)
    {
        $validated = $request->validate([
            'year' => 'required|integer|min:1900|max:2100',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_url' => 'nullable|url|max:500',
        ]);

        if ($request->hasFile('image_file')) {
            if ($biografia_evento->image_url && !filter_var($biografia_evento->image_url, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete($biografia_evento->image_url);
            }
            $path = $request->file('image_file')->store('biografia-eventos', 'public');
            $validated['image_url'] = $path;
        } elseif ($request->filled('image_url')) {
            $validated['image_url'] = $request->image_url;
        }

        $validated['updated_at'] = now();
        $biografia_evento->update($validated);

        return redirect()->route('biografia-eventos.index')->with('success', 'Evento biográfico actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BiografiaEvento $biografia_evento)
    {
        if ($biografia_evento->image_url && !filter_var($biografia_evento->image_url, FILTER_VALIDATE_URL)) {
            Storage::disk('public')->delete($biografia_evento->image_url);
        }
        $biografia_evento->delete();

        return redirect()->route('biografia-eventos.index')->with('success', 'Evento biográfico eliminado exitosamente');
    }
}
