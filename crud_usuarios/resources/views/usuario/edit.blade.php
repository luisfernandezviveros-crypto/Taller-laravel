<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4">Editar Usuario</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('usuarios.update', $usuario->id_usuario) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" value="{{ old('username', $usuario->username) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password (dejar vacio para no cambiarla)</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Rol</label>
                <select name="rol" class="form-select" required>
                    @foreach (['admin', 'vendedor', 'supervisor'] as $rol)
                        <option value="{{ $rol }}" {{ old('rol', $usuario->rol) == $rol ? 'selected' : '' }}>{{ $rol }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Activo</label>
                <select name="activo" class="form-select" required>
                    <option value="1" {{ old('activo', $usuario->activo) == 1 ? 'selected' : '' }}>Si</option>
                    <option value="0" {{ old('activo', $usuario->activo) == 0 ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">ID Empresa</label>
                <input type="number" name="id_empresa" class="form-control" value="{{ old('id_empresa', $usuario->id_empresa) }}">
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
