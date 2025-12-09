<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans min-h-screen flex items-center justify-center">

    <form action="{{ route('users.update', $user->id) }}" method="POST" class="bg-white p-6 rounded shadow-md w-full max-w-md">
        @csrf
        @method('PUT')
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Editar Usuario</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-semibold mb-1">Nombre completo *</label>
            <input type="text" 
                   id="name" 
                   name="name" 
                   value="{{ old('name', $user->name) }}"
                   required 
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-semibold mb-1">Email *</label>
            <input type="email" 
                   id="email" 
                   name="email" 
                   value="{{ old('email', $user->email) }}"
                   required
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-semibold mb-1">Nueva Contraseña</label>
            <input type="password" 
                   id="password" 
                   name="password"
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <p class="text-sm text-gray-500 mt-1">Déjalo en blanco para mantener la contraseña actual</p>
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700 font-semibold mb-1">Confirmar Nueva Contraseña</label>
            <input type="password" 
                   id="password_confirmation" 
                   name="password_confirmation"
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div class="mb-6">
            <label class="flex items-center">
                <input type="checkbox" 
                       id="is_admin" 
                       name="is_admin" 
                       value="1"
                       {{ old('is_admin', $user->is_admin) ? 'checked' : '' }}
                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                <span class="ml-2 text-gray-700 font-semibold">Usuario Administrador</span>
            </label>
        </div>

        <div class="flex space-x-4">
            <button type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded font-semibold">
                Actualizar Usuario
            </button>
            <a href="{{ route('users.index') }}" 
               class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded font-semibold inline-block">
                Cancelar
            </a>
        </div>
    </form>

</body>
</html>