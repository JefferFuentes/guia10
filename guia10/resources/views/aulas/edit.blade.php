<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Aula</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <h1>Editar Aula</h1>

    {{-- Mostrar errores de validación --}}
    @if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('aulas.update', $aula->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="nombre">Nombre de la Aula:</label><br>
        <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $aula->nombre) }}"><br><br>

        <label for="capacidad">Capacidad:</label><br>
        <input type="number" id="capacidad" name="capacidad" value="{{ old('capacidad', $aula->capacidad) }}" min="1"><br><br>

        <select name="cursos[]" multiple>
            @foreach($cursos as $curso)
            <option value="{{ $curso->id }}"
                {{ $aula->cursos->contains($curso->id) ? 'selected' : '' }}>
                {{ $curso->nombre }}
            </option>
            @endforeach
        </select>

        <button type="submit">Guardar Aula</button>
    </form>

    <br>
    <button class="btn btn-secondary"><a href="{{ route('aulas.index') }}" class="text-white text-decoration-none">Volver a la lista de aulas</a></button>
</body>

</html>