<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use Illuminate\Http\Request;

class AulaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aulas = Aula::all();
        return view('aulas.index', compact('aulas'));
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
    public function edit(Request $request, int $id)
    {
        $aula = Aula::findOrFail($id);
        $aula->update($request->all());
        $aula->cursos()->sync($request->cursos); // Sincronizar cursos asignados
        return view('aulas.edit', compact('aula'));
    }

    // 💾 Actualizar en la base de datos
    public function update(Request $request, int $id)
    {
        $aula = Aula::findOrFail($id);

        // Validación (ajústala a tus campos)
        $request->validate([
            'nombre' => 'required|max:255',
            'capacidad' => 'required|integer|min:1',
        ]);

        // Actualizar datos
        $aula->update($request->all());

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
