<h1>Lista de Aulas</h1>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<button class="btn btn-primary"><a href="{{ route('aulas.create') }}" class="text-white text-decoration-none"> + Crear nueva aula</a></button>
<button class="btn btn-primary"><a href="{{ route('cursos.index') }}" class="text-white text-decoration-none">Cursos</a></button>
<button class="btn btn-primary"><a href="{{ route('aulas.index') }}" class="text-white text-decoration-none">Aulas</a></button>
<form method="GET" action="{{ route('aulas.index') }}">
    <input type="text" name="buscar" value="{{ $buscar ?? '' }}" placeholder="Buscar aula...">
    <button type="submit">Buscar</button>
</form>

<ul>
    <table border="1">
        <thead>
            <tr>
                <th>Aula</th>
                <th>Cursos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($aulas as $aula)
            <tr>
                <td>{{ $aula->nombre }}</td>
                <td>
                    @forelse ($aula->cursos as $curso)
                    {{ $curso->nombre }} ({{ $curso->duracion }}h)<br>

                    @empty
                    Sin cursos
                    @endforelse
                </td>
                <td><a href="{{ route('aulas.edit', $aula->id) }}" class="btn btn-sm btn-warning">Editar aula</a>

                    <form action="{{ route('aulas.destroy', $aula->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('¿Estás seguro de que quieres eliminar esta aula?')" class="btn btn-sm btn-danger">
                            Eliminar aula
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</ul>