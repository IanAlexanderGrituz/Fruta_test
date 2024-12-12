<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Fruta</title>
</head>
<body>
    <h1>Editar Fruta</h1>

    <form action="{{ url('/modificar') }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $fruta->id }}">
        <input type="text" name="nombre" value="{{ $fruta->nombre }}" required>
        <input type="number" name="precio" value="{{ $fruta->precio }}" step="0.01" required>
        <button type="submit">Guardar Cambios</button>
    </form>

    <a href="{{ url('/') }}">Volver al listado</a>
</body>
</html>