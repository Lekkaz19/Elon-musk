<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Innovacion;

class InnovacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $innovaciones = Innovacion::all();
        return view('admin.innovaciones.index', compact('innovaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.innovaciones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data['created_by'] = auth()->id();

        if ($request->hasFile('image_url')) {
            $path = $request->file('image_url')->store('innovaciones', 'public');
            $data['image_url'] = $path;
        }

        Innovacion::create($data);
        return redirect()->route('admin.innovaciones.index')->with('success', 'Creado correctamente');
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
    public function edit(Innovacion $innovacione)
    {
        return view('admin.innovaciones.edit', ['innovacion' => $innovacione]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Innovacion $innovacione)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image_url')) {
            // Delete old image
            if ($innovacione->image_url && Storage::disk('public')->exists($innovacione->image_url)) {
                Storage::disk('public')->delete($innovacione->image_url);
            }

            $path = $request->file('image_url')->store('innovaciones', 'public');
            $data['image_url'] = $path;
        }

        $innovacione->update($data);

        return redirect()->route('admin.innovaciones.index')->with('success', 'Actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Innovacion $innovacione)
    {
        if ($innovacione->image_url) {
            Storage::disk('public')->delete($innovacione->image_url);
        }
        $innovacione->delete();

        return redirect()->route('admin.innovaciones.index')->with('success', 'Innovacion deleted successfully.');
    }
}
