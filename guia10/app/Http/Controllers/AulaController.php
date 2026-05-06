<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use App\Models\Curso;
use Illuminate\Http\Request;

class AulaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $buscar = $request->input('buscar');

        $aulas = Aula::with('cursos')
            ->when($buscar, function ($query, $buscar) {
                return $query->where('nombre', 'like', "%$buscar%");
            })
            ->get();

        return view('aulas.index', compact('aulas', 'buscar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('aulas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'capacidad' => 'required|integer|min:1',
        ]);

        $aula = Aula::create($request->all());
        $aula->cursos()->attach($request->input('cursos')); // Asignar cursos al aula
        return redirect()->route('aulas.index');
    }

    /**
     * Display the specified resource.
     */
    // 🔍 Mostrar un curso específico
    public function show(int $id)
    {
        $aula = Aula::findOrFail($id);
        return view('aulas.show', compact('aula'));
    }

    // ✏️ Mostrar formulario para editar
    public function edit(int $id)
    {
        $aula = Aula::findOrFail($id);
        $cursos = Curso::all(); // 👈 necesario para el select

        return view('aulas.edit', compact('aula', 'cursos'));
    }

    // 💾 Actualizar en la base de datos
    public function update(Request $request, int $id)
    {
        $aula = Aula::findOrFail($id);

        $request->validate([
            'nombre' => 'required|max:255',
            'capacidad' => 'required|integer|min:1',
            'cursos' => 'array' // 👈 importante
        ]);

        // ✔️ actualizar datos del aula
        $aula->update([
            'nombre' => $request->nombre,
            'capacidad' => $request->capacidad,
        ]);

        // ✔️ sincronizar cursos
        $aula->cursos()->sync($request->cursos ?? []);

        return redirect()->route('aulas.index')
            ->with('success', 'Aula actualizada correctamente');
    }

    // 🗑️ Eliminar un aula
    public function destroy(int $id)
    {
        $aula = Aula::findOrFail($id);
        $aula->delete();

        return redirect()->route('aulas.index')
            ->with('success', 'Aula eliminada correctamente');
    }
}
