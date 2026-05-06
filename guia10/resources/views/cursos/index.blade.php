<h1>Lista de Cursos</h1>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<button class="btn btn-primary"><a href="{{ route('cursos.create') }}" class="text-white text-decoration-none"> + Crear nuevo curso</a></button>
<button class="btn btn-primary"><a href="{{ route('cursos.index') }}" class="text-white text-decoration-none">Cursos</a></button>
<button class="btn btn-primary"><a href="{{ route('aulas.index') }}" class="text-white text-decoration-none">Aulas</a></button>

<ul>
    @foreach ($cursos as $curso)
    <li>
        {{ "Nombre del curso: " . $curso->nombre }}
        {{ "Duración: (" . $curso->duracion . " horas)" }}
        {{ "Aula: " . $curso->aulas->pluck('nombre')->implode(', ') }}

        <a href="{{ route('cursos.edit', $curso->id) }}" class="btn btn-sm btn-warning">Editar curso</a>

        <form action="{{ route('cursos.destroy', $curso->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('¿Estás seguro de que quieres eliminar este curso?')" class="btn btn-sm btn-danger">
                Eliminar curso
            </button>
        </form>
    </li>
    @endforeach
</ul>