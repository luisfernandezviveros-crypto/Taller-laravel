<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4">Crear Usuario</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('usuarios.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" value="{{ old('username') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Rol</label>
                <select name="rol" class="form-select" required>
                    <option value="admin" {{ old('rol') == 'admin' ? 'selected' : '' }}>admin</option>
                    <option value="vendedor" {{ old('rol') == 'vendedor' ? 'selected' : '' }}>vendedor</option>
                    <option value="supervisor" {{ old('rol') == 'supervisor' ? 'selected' : '' }}>supervisor</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Activo</label>
                <select name="activo" class="form-select" required>
                    <option value="1" {{ old('activo', '1') == '1' ? 'selected' : '' }}>Si</option>
                    <option value="0" {{ old('activo') === '0' ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">ID Empresa</label>
                <input type="number" name="id_empresa" class="form-control" value="{{ old('id_empresa') }}">
            </div>

            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
