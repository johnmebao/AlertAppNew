<?php

namespace App\Http\Controllers;

use App\Models\Configuracion;
use Illuminate\Http\Request;

class ConfiguracionController extends Controller
{
   
    public function index()
    {
        $configuracion = Configuracion::first();
        return view('admin.configuracion.index', compact('configuracion'));
    }

   
    public function create()
    {
        
    }

    public function store(Request $request)
    {
        // $datos = $request->all;
        // return response()->json($datos);

        $request->validate([
            'nombre' => 'required|string|max:50',
            'logo' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        // Verificar si ya existe una configuración
        $configuracion = Configuracion::first();

        if ($configuracion) {
            if($request->hasFile('logo')) 
        {
            if($configuracion->logo)
            {
                unlink(public_path($configuracion->logo)); // Eliminar el logo anterior
            }
            // Guardar el nuevo logo
                $configuracion->nombre = $request->input('nombre');
                $LogoPath = $request->file('logo');
                $nombreArchivo = time() . '_' . $LogoPath->getClientOriginalName();
                $rutaDestino = public_path('uploads/logos');
                $LogoPath->move($rutaDestino, $nombreArchivo);
                $configuracion->logo = 'uploads/logos/' . $nombreArchivo;

        }
            $configuracion->save();
            return redirect()->route('admin.configuracion.index')->with('success', 'Configuración actualizada exitosamente.');
        }
         else {
            // Crear una nueva configuración
            $configuracion = new Configuracion();
            $configuracion->nombre = $request->input('nombre');
            if($request->hasFile('logo')) 
            {
                $LogoPath = $request->file('logo');
                $nombreArchivo = time() . '_' . $LogoPath->getClientOriginalName();
                $rutaDestino = public_path('uploads/logos');
                $LogoPath->move($rutaDestino, $nombreArchivo);
                $configuracion->logo = 'uploads/logos/' . $nombreArchivo;
            }
            $configuracion->save();
            return redirect()->route('admin.configuracion.index')->with('success', 'Configuración creada exitosamente.');
        }
    }

   
    public function show(Configuracion $configuracion)
    {
        //
    }

   
    public function edit(Configuracion $configuracion)
    {
        //
    }

   
    public function update(Request $request, Configuracion $configuracion)
    {
        //
    }

    public function destroy(Configuracion $configuracion)
    {
        //
    }
}
