<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Curiosidad;

class CuriosidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $curiosidades = Curiosidad::all();
        return view('admin.curiosidades.index', compact('curiosidades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.curiosidades.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data['created_by'] = auth()->id();

        if ($request->hasFile('image_url')) {
            $path = $request->file('image_url')->store('curiosidades', 'public');
            $data['image_url'] = $path;
        }

        Curiosidad::create($data);
        return redirect()->route('admin.curiosidades.index')->with('success', 'Creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Curiosidad $curiosidade)
    {
        return view('admin.curiosidades.edit', ['curiosidad' => $curiosidade]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Curiosidad $curiosidade)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image_url')) {
            // Delete old image
            if ($curiosidade->image_url && Storage::disk('public')->exists($curiosidade->image_url)) {
                Storage::disk('public')->delete($curiosidade->image_url);
            }

            $path = $request->file('image_url')->store('curiosidades', 'public');
            $data['image_url'] = $path;
        }

        $curiosidade->update($data);

        return redirect()->route('admin.curiosidades.index')->with('success', 'Actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Curiosidad $curiosidade)
    {
        if ($curiosidade->image_url) {
            Storage::disk('public')->delete($curiosidade->image_url);
        }
        $curiosidade->delete();

        return redirect()->route('admin.curiosidades.index')->with('success', 'Curiosidad deleted successfully.');
    }
}
