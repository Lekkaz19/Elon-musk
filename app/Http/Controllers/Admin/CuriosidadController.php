<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only(['title', 'content']);
        $data['created_by'] = auth()->id();

        if ($request->hasFile('image_url')) {
            $path = $request->file('image_url')->store('public/curiosidades');
            $data['image_url'] = \Illuminate\Support\Facades\Storage::url($path);
        }

        Curiosidad::create($data);

        return redirect()->route('admin.curiosidades.index')->with('success', 'Curiosidad created successfully.');
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
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only(['title', 'content']);

        if ($request->hasFile('image_url')) {
            // Delete old image
            if ($curiosidade->image_url) {
                \Illuminate\Support\Facades\Storage::delete(str_replace('/storage', 'public', $curiosidade->image_url));
            }

            $path = $request->file('image_url')->store('public/curiosidades');
            $data['image_url'] = \Illuminate\Support\Facades\Storage::url($path);
        }

        $curiosidade->update($data);

        return redirect()->route('admin.curiosidades.index')->with('success', 'Curiosidad updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Curiosidad $curiosidade)
    {
        if ($curiosidade->image_url) {
            \Illuminate\Support\Facades\Storage::delete(str_replace('/storage', 'public', $curiosidade->image_url));
        }
        $curiosidade->delete();

        return redirect()->route('admin.curiosidades.index')->with('success', 'Curiosidad deleted successfully.');
    }
}
