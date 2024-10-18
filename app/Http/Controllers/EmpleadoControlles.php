<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Empleados;
use Illuminate\Http\Request;

class EmpleadoControlles extends Controller
{
    public function show($id)
    {
        $empleado = Empleados::find($id);
        if ($empleado) {
            return response()->json($empleado, 200);
        } else {
            return response()->json(['message' => 'Empleado no encontrado'], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'fechanac' => 'required|date',
            'correo' => 'required|string|email',
            'activo' => 'required|integer',
            'id_departamento' => 'required|integer|exists:departamentos,id',
        ]);

        $empleado = Empleados::create([
            'nombre' => $request->nombre,
            'fechanac' => $request->fechanac,
            'correo' => $request->correo,
            'activo' => $request->activo,
            'id_departamento' => $request->id_departamento,
        ]);

        return response()->json($empleado, 201);
    }

    public function updateStatus($id, Request $request)
    {
        $request->validate([
            'activo' => 'required|integer',
        ]);

        $empleado = Empleados::find($id);

        if ($empleado) {
            $empleado->activo = $request->activo;
            $empleado->save();
            return response()->json($empleado, 200);
        } else {
            return response()->json(['message' => 'Empleado no encontrado'], 404);
        }
    }

    public function destroy($id)
    {
        $empleado = Empleados::find($id);

        if ($empleado) {
            $empleado->delete();
            return response()->json(['message' => 'Empleado eliminado'], 200);
        } else {
            return response()->json(['message' => 'Empleado no encontrado'], 404);
        }
    }

    public function index()
    {
        $empleados = Empleados::all();
        return response()->json($empleados, 200);
    }
}
