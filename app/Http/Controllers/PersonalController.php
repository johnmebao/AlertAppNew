<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\User;
use Faker\Provider\ar_EG\Person;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class PersonalController extends Controller
{
    
    public function index()
    {
        // Fetch all personas from the database
        $personas = Persona::all();

        // Return the personas as a JSON response or view
        return view('admin.personal.index', compact('personas'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.personal.create', compact('roles'));
    }

  
    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string',
            'documento' => 'required|numeric|unique:personals',
            'email' => 'required|email|unique:users,email',
            'rol_id' => 'required',
        ]);

        // Crear usuario
        $persona = new User();
        $persona->name = $request->nombres;
        $persona->email = $request->email;
        $persona->password = Hash::make($request->documento); // Contraseña por defecto
        $persona->save();

        // Buscar el nombre del rol por ID y asignar
        $rol = Role::findOrFail($request->rol_id);
        $persona->assignRole($rol->name);

        // Crear registro en Persona
        $personal = new Persona();
        $personal->usuario_id = $persona->id;
        $personal->nombres = $request->nombres;
        $personal->documento = $request->documento;
        $personal->correo = $request->email;
        $personal->save();

        return redirect()->route('admin.personal.index')->with('success', 'Personal creado correctamente.');
    }

   
    public function show(Persona $persona)
    {
        //
    }

    public function edit(Persona $request, $id)
    {
        // $datos = $request->all();
        // return response()->json($datos);

        $roles = Role::all();
        $personal = Persona::findOrFail($id);
        return view('admin.personal.edit', compact('personal', 'roles'));
    }

    public function update(Request $request, $id)
    {

        // $datos = $request->all();
        // return response()->json($datos);

        $personal = Persona::findOrFail($id);
        $userId = $personal->usuario_id;

        $request->validate([
            'nombres' => 'required|string',
            'documento' => 'required|numeric|unique:personals,documento,' . $id,
            'email' => 'required|email|unique:users,email,' . $userId,
            'rol_id' => 'required',
        ]);

        $personal->nombres = $request->nombres;
        $personal->documento = $request->documento;
        $personal->correo = $request->email;
        $personal->save();

        // Actualizar usuario relacionado
        $usuario = $personal->usuario;
        if ($usuario) {
            $usuario->name = $request->nombres;
            $usuario->email = $request->email;
            $usuario->save();
            // Actualizar rol
            $rol = Role::findOrFail($request->rol_id);
            $usuario->syncRoles([$rol->name]);
        }

        return redirect()->route('admin.personal.index')->with('success', 'Personal actualizado correctamente.');
    }

    public function destroy(Persona $id)
    {
        $personal = Persona::findOrFail($id->id);
        $usuario = $personal->usuario;

        // Eliminar el usuario relacionado
        if ($usuario) {
            $usuario->delete();
        }

        // Eliminar el registro de Persona
        $personal->delete();

        return redirect()->route('admin.personal.index')->with('success', 'Personal eliminado correctamente.');
    }
}
