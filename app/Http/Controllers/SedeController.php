<?php

namespace App\Http\Controllers;

use App\Models\Sede;
use Illuminate\Http\Request;

class SedeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sedes = Sede::all();
        return view('admin.sedes.index', compact('sedes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sedes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:sedes,nombre|string|max:100',
            'telefono' => 'nullable|string|max:20',
        ]);

        Sede::create($request->all());

        return redirect()->route('admin.sedes.index')->with('success', 'Sede creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sede $sede)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sede = Sede::findOrFail($id);
        return view('admin.sedes.edit', compact('sede'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // $datos = $request->all();
        // return response()->json($datos);
        $sede = Sede::findOrFail($id);

        $request->validate([
            'nombre' => 'required|unique:sedes,nombre,' . $sede->id . '|string|max:255',
            'telefono' => 'nullable|string|max:20',
        ]);

        $sede->update($request->all());

        return redirect()->route('admin.sedes.index')->with('success', 'Sede actualizada exitosamente.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sede $id)
    {
        $sede = Sede::findOrFail($id->id);
        $sede->delete();

        return redirect()->route('admin.sedes.index')->with('success', 'Sede eliminada exitosamente.');
    }
}
