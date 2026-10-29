<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuario.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuario.create');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'username'   => 'required|string|max:50|unique:usuario,username',
            'password'   => 'required|string|min:6|max:255',
            'rol'        => 'required|in:admin,vendedor,supervisor',
            'activo'     => 'required|boolean',
            'id_empresa' => 'nullable|integer|exists:empresa,id_empresa',
        ]);

        $datos['password'] = Hash::make($datos['password']);
        $datos['fecha_creacion'] = now();

        Usuario::create($datos);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario creado correctamente.');
    }

    public function show(Usuario $usuario)
    {
        return redirect()->route('usuarios.edit', $usuario->id_usuario);
    }

    public function edit(Usuario $usuario)
    {
        return view('usuario.edit', compact('usuario'));
    }

    public function update(Request $request, Usuario $usuario)
    {
        $datos = $request->validate([
            'username'   => [
                'required', 'string', 'max:50',
                Rule::unique('usuario', 'username')->ignore($usuario->id_usuario, 'id_usuario'),
            ],
            'password'   => 'nullable|string|min:6|max:255',
            'rol'        => 'required|in:admin,vendedor,supervisor',
            'activo'     => 'required|boolean',
            'id_empresa' => 'nullable|integer|exists:empresa,id_empresa',
        ]);

        if (!empty($datos['password'])) {
            $datos['password'] = Hash::make($datos['password']);
        } else {
            unset($datos['password']);
        }

        $usuario->update($datos);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(Usuario $usuario)
    {
        $usuario->delete();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }
}
