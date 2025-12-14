<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only(['title', 'description']);
        $data['created_by'] = auth()->id();

        if ($request->hasFile('image_url')) {
            $path = $request->file('image_url')->store('public/innovaciones');
            $data['image_url'] = \Illuminate\Support\Facades\Storage::url($path);
        }

        Innovacion::create($data);

        return redirect()->route('admin.innovaciones.index')->with('success', 'Innovacion created successfully.');
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
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only(['title', 'description']);

        if ($request->hasFile('image_url')) {
            // Delete old image
            if ($innovacione->image_url) {
                \Illuminate\Support\Facades\Storage::delete(str_replace('/storage', 'public', $innovacione->image_url));
            }

            $path = $request->file('image_url')->store('public/innovaciones');
            $data['image_url'] = \Illuminate\Support\Facades\Storage::url($path);
        }

        $innovacione->update($data);

        return redirect()->route('admin.innovaciones.index')->with('success', 'Innovacion updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Innovacion $innovacione)
    {
        if ($innovacione->image_url) {
            \Illuminate\Support\Facades\Storage::delete(str_replace('/storage', 'public', $innovacione->image_url));
        }
        $innovacione->delete();

        return redirect()->route('admin.innovaciones.index')->with('success', 'Innovacion deleted successfully.');
    }
}
