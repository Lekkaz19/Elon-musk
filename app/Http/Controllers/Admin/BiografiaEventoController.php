<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\BiografiaEvento;

class BiografiaEventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $biografiaEventos = BiografiaEvento::all();
        return view('admin.biografia-eventos.index', compact('biografiaEventos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.biografia-eventos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|digits:4|integer|min:1900|max:'.(date('Y')),
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only(['year', 'title', 'description']);
        $data['created_by'] = auth()->id();

        if ($request->hasFile('image_url')) {
            $path = $request->file('image_url')->store('public/biografia-eventos');
            $data['image_url'] = \Illuminate\Support\Facades\Storage::url($path);
        }

        BiografiaEvento::create($data);

        return redirect()->route('admin.biografia-eventos.index')->with('success', 'Biografia Evento created successfully.');
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
    public function edit(BiografiaEvento $biografia_evento)
    {
        return view('admin.biografia-eventos.edit', ['evento' => $biografia_evento]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BiografiaEvento $biografia_evento)
    {
        $request->validate([
            'year' => 'required|digits:4|integer|min:1900|max:'.(date('Y')),
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only(['year', 'title', 'description']);

        if ($request->hasFile('image_url')) {
            // Delete old image
            if ($biografia_evento->image_url) {
                \Illuminate\Support\Facades\Storage::delete(str_replace('/storage', 'public', $biografia_evento->image_url));
            }

            $path = $request->file('image_url')->store('public/biografia-eventos');
            $data['image_url'] = \Illuminate\Support\Facades\Storage::url($path);
        }

        $biografia_evento->update($data);

        return redirect()->route('admin.biografia-eventos.index')->with('success', 'Biografia Evento updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BiografiaEvento $biografia_evento)
    {
        if ($biografia_evento->image_url) {
            \Illuminate\Support\Facades\Storage::delete(str_replace('/storage', 'public', $biografia_evento->image_url));
        }
        $biografia_evento->delete();

        return redirect()->route('admin.biografia-eventos.index')->with('success', 'Biografia Evento deleted successfully.');
    }
}
