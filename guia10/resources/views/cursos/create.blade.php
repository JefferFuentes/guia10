<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear Curso</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <h1>Crear Nuevo Curso</h1>

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

    <form action="{{ route('cursos.store') }}" method="POST">
        @csrf

        <label for="nombre">Nombre del Curso:</label><br>
        <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}"><br><br>

        <label for="duracion">Duración (en horas):</label><br>
        <input type="number" id="duracion" name="duracion" value="{{ old('duracion') }}"><br><br>

        <label for="aula_id">Aula:</label><br>
        <select name="aulas[]" multiple>
            @foreach($aulas as $aula)
            <option value="{{ $aula->id }}">{{ $aula->nombre }}</option>
            @endforeach
        </select>
        <br><br>

        <button type="submit">Guardar Curso</button>
    </form>

    <br>
    <a href="{{ route('cursos.index') }}">Volver a la lista de cursos</a>
</body>

</html>