<h1>Lista de Cursos</h1>
<a href="{{ route('cursos.create') }}"> + Crear nuevo curso</a>
<ul>
 @foreach ($cursos as $curso)
 <li>{{ $curso->nombre }} ({{ $curso->duracion }} horas)</li>
 @endforeach
</ul> 