<html>
<head>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans min-h-screen flex items-center justify-center">
    <form action="{{ route('articulos.update', $article->id_art) }}" method="POST" class="bg-white p-6 rounded shadow-md w-full max-w-md">
        @csrf
        <h1 class="block text-gray-700 font-semibold mb-1">Actualizar artículo</h1>
        <!-- ID del artículo -->
        <div class="mb-4">
            <label for="id_art" class="block text-gray-700 font-semibold mb-1">ID del Artículo</label>
            <input type="text" id="id_art" name="id_art" required value="{{ $article->id_art }}"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <!-- Título -->
        <div class="mb-4">
            <label for="titulo" class="block text-gray-700 font-semibold mb-1">Nombre del artículo</label>
            <input type="text" id="titulo" name="titulo" value="{{ $article->titulo }}"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <!-- Descripción -->
        <div class="mb-4">
            <label for="descripcion" class="block text-gray-700 font-semibold mb-1">Descripción del Artículo</label>
            <input type="text" id="descripcion" name="descripcion" value="{{ $article->cuerpo }}"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>
        <div class="mb-4">
            <a href="{{ route('articulos.show') }}"><button class="block text-gray-700 font-semibold mb-1">Volver</button></a>
        </div>
        <!-- Botón -->
        <div class="mb-4">
            <button type="submit" class="bg-gray-800 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Actualizar artículo
            </button>
        </div>
    </form>
</body>
</html>
