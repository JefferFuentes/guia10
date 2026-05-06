<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use Illuminate\Http\Request;
use App\Models\Curso;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $buscar = $request->input('buscar');

        $cursos = Curso::with('aulas')
            ->when($buscar, function ($query, $buscar) {
                return $query->where('nombre', 'like', "%$buscar%");
            })
            ->get();

        return view('cursos.index', compact('cursos', 'buscar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $aulas = Aula::all(); // 👈 traes las aulas

        return view('cursos.create', compact('aulas')); // 👈 las envías
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación
        $request->validate([
            'nombre' => 'required',
            'duracion' => 'required',
            'aulas' => 'required|array'
        ]);

        // Crear curso
        $curso = Curso::create([
            'nombre' => $request->nombre,
            'duracion' => $request->duracion,
        ]);

        // 🔗 Relacionar con aulas (tabla pivot)
        $curso->aulas()->attach($request->aulas);

        return redirect()->route('cursos.index')
            ->with('success', 'Curso creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    // 🔍 Mostrar un curso específico
    public function show(int $id)
    {
        $curso = Curso::findOrFail($id);
        $curso = Curso::all()->find($id); // 👈 traes el curso con sus aulas
        return view('cursos.index', compact('curso'));
    }

    // ✏️ Mostrar formulario para editar
    public function edit(int $id)
    {
        $curso = Curso::findOrFail($id);
        $aulas = Aula::all(); // 👈 traes las aulas

        return view('cursos.edit', compact('curso', 'aulas')); // 👈 las envías
    }

    // 💾 Actualizar en la base de datos
    public function update(Request $request, $id)
    {
        $curso = Curso::findOrFail($id);

        // Validación
        $request->validate([
            'nombre' => 'required',
            'duracion' => 'required',
            'aulas' => 'required|array'
        ]);

        // ✏️ Actualizar datos del curso
        $curso->update([
            'nombre' => $request->nombre,
            'duracion' => $request->duracion,
        ]);

        // 🔗 Sincronizar aulas (pivot)
        $curso->aulas()->sync($request->aulas);

        return redirect()->route('cursos.index')
            ->with('success', 'Curso actualizado correctamente');
    }

    // 🗑️ Eliminar un curso
    public function destroy(int $id)
    {
        $curso = Curso::findOrFail($id);
        $curso->delete();

        return redirect()->route('cursos.index')
            ->with('success', 'Curso eliminado correctamente');
    }
}
