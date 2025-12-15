<?php

namespace App\Http\Controllers;

use App\Models\Innovacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InnovacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $innovaciones = Innovacion::latest()->paginate(9);
        return view('innovaciones.index', compact('innovaciones'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Innovacion $innovacion)
    {
        $comments = $innovacion->comentarios()
            ->where('approved', true)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('innovaciones.show', compact('innovacion', 'comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('innovaciones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_url' => 'nullable|url|max:500',
        ]);

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('innovaciones', 'public');
            $validated['image_url'] = $path;
        } elseif ($request->filled('image_url')) {
            $validated['image_url'] = $request->image_url;
        } else {
            $validated['image_url'] = null;
        }

        $validated['created_by'] = auth()->id();
        $validated['created_at'] = now();
        $validated['updated_at'] = now();

        Innovacion::create($validated);

        return redirect()->route('innovaciones.index')->with('success', 'Innovación creada exitosamente');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Innovacion $innovacion)
    {
        return view('innovaciones.edit', compact('innovacion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Innovacion $innovacion)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_url' => 'nullable|url|max:500',
        ]);

        if ($request->hasFile('image_file')) {
            if ($innovacion->image_url && !filter_var($innovacion->image_url, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete($innovacion->image_url);
            }
            $path = $request->file('image_file')->store('innovaciones', 'public');
            $validated['image_url'] = $path;
        } elseif ($request->filled('image_url')) {
            $validated['image_url'] = $request->image_url;
        }

        $validated['updated_at'] = now();
        $innovacion->update($validated);

        return redirect()->route('innovaciones.index')->with('success', 'Innovación actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Innovacion $innovacion)
    {
        if ($innovacion->image_url && !filter_var($innovacion->image_url, FILTER_VALIDATE_URL)) {
            Storage::disk('public')->delete($innovacion->image_url);
        }
        $innovacion->delete();

        return redirect()->route('innovaciones.index')->with('success', 'Innovación eliminada exitosamente');
    }
}
