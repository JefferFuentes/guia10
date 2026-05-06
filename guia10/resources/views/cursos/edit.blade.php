<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Curso</title>
</head>

<body>
    <h1>Editar Curso</h1>

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

    <form action="{{ route('cursos.update', $curso->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="nombre">Nombre del Curso:</label><br>
        <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $curso->nombre) }}"><br><br>

        <label for="duracion">Duración (en horas):</label><br>
        <input type="number" id="duracion" name="duracion" value="{{ old('duracion', $curso->duracion) }}"><br><br>

        <label for="aula_id">Aula:</label><br>
        <select name="aulas[]" multiple>
            @foreach($aulas as $aula)
            <option value="{{ $aula->id }}" {{ in_array($aula->id, old('aulas', $curso->aulas->pluck('id')->toArray())) ? 'selected' : '' }}>
                {{ $aula->nombre }}
            </option>
            @endforeach
        </select>
        <br><br>

        <button type="submit">Guardar Curso</button>
    </form>

    <br>
    <a href="{{ route('cursos.index') }}">Volver a la lista de cursos</a>
</body>

</html>