<h1>Lista de Cursos</h1>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<a href="{{ route('cursos.create') }}" class="btn btn-primary">+ Crear nuevo curso</a>
<a href="{{ route('cursos.index') }}" class="btn btn-primary">Cursos</a>
<a href="{{ route('aulas.index') }}" class="btn btn-primary">Aulas</a>
<form method="GET" action="{{ route('cursos.index') }}">
    <input type="text" name="buscar" value="{{ $buscar ?? '' }}" placeholder="Buscar curso...">
    <button type="submit">Buscar</button>
</form>

<ul>
     <table border="1">
        <thead>
            <tr>
                <th>Cursos</th>
                <th>Aulas</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cursos as $curso)
            <tr>
                <td>{{ $curso->nombre }}</td>
                <td>
                    @forelse ($curso->aulas as $aula)
                    {{ $aula->nombre }}<br>

                    @empty
                    Sin aulas
                    @endforelse
                </td>
                <td><a href="{{ route('cursos.edit', $curso->id) }}" class="btn btn-sm btn-warning">Editar curso</a>

                    <form action="{{ route('cursos.destroy', $curso->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('¿Estás seguro de que quieres eliminar este curso?')" class="btn btn-sm btn-danger">
                            Eliminar curso
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</ul>