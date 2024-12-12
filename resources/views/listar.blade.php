<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Frutas</title>
</head>
<body>
    <h1>Listado de Frutas</h1>

    @if(session('mensaje'))
        <p style="color: green;">{{ session('mensaje') }}</p>
    @endif

    @if($errors->any())
        <p style="color: red;">{{ $errors->first() }}</p>
    @endif

    @if(Auth::check())
        <p>Bienvenido, {{ Auth::user()->name }}</p>
        <form action="{{ url('/logout') }}" method="POST">
            @csrf
            <button type="submit">Cerrar sesión</button>
        </form>
    @else
        <h2>Registro</h2>
        <form action="{{ url('/register') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Nombre" required>
            <input type="email" name="email" placeholder="Correo electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Registrar</button>
        </form>

        <h2>Login</h2>
        <form action="{{ url('/login') }}" method="POST">
            @csrf
            <input type="email" name="email" placeholder="Correo electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Iniciar sesión</button>
        </form>
    @endif

    <h2>Agregar Fruta</h2>
    <form action="{{ url('/insertar') }}" method="POST">
        @csrf
        <input type="text" name="nombre" placeholder="Nombre de la fruta" required>
        <input type="number" name="precio" placeholder="Precio" step="0.01" required>
        <button type="submit">Agregar Fruta</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($frutas as $fruta)
                <tr>
                    <td>{{ $fruta->nombre }}</td>
                    <td>{{ $fruta->precio }}</td>
                    <td>
                        <a href="{{ url('/editar/' . $fruta->id) }}">Editar</a>
                        <form action="{{ url('/eliminar/' . $fruta->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Estás seguro de eliminar esta fruta?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
