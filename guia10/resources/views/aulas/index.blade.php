<h1>Lista de aulas</h1>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<button class="btn btn-primary"><a href="{{ route('aulas.create') }}" class="text-white text-decoration-none"> + Crear nueva aula</a></button>
<button class="btn btn-primary"><a href="{{ route('aulas.index') }}" class="text-white text-decoration-none">Aulas</a></button>
<button class="btn btn-primary"><a href="{{ route('cursos.index') }}" class="text-white text-decoration-none">Cursos</a></button>
<ul>
@foreach ($aulas as $aula)
    <h3>{{ $aula->nombre }}</h3>

    <ul>
        @forelse ($aula->cursos as $curso)
            <li>
                {{ $curso->nombre }} 
            </li>
        @empty
            <li>No hay cursos en esta aula</li>
        @endforelse
    </ul>
@endforeach
</ul> 