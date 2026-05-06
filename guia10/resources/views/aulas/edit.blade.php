<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Aula</title>
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

        <button type="submit">Guardar Aula</button>
    </form>

    <br>
    <a href="{{ route('aulas.index') }}">Volver a la lista de aulas</a>
</body>

</html>