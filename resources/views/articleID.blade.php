@extends('layout.app')
@section('sidebar')
    <p></p>
@endsection
<nav class="flex justify-start space-x-4 mb-6 items-center bg-gray-800 text-white p-4 w-full">
    <form method="GET" action="{{ route('articulos.create') }}">
        <button class="hover:bg-blue-600 px-4 py-2 rounded"> 
            Añadir artículos
        </button>
    </form>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="hover:bg-blue-600 px-4 py-2 rounded">
            Cerrar sesión
        </button>
    </form>
</nav>
<h1>Artículo {{ $article->id_art }}</h1>
<table class="min-w-full border-separate border-spacing-x-4 border-spacing-y-2 text-gray-700 shadow rounded mb-6">
    <tr class="even:bg-gray-100 hover:bg-indigo-50">
        <td class="px-4 py-2 border border-gray-300 rounded">{{ $article->id_art }}</td>
        <td class="px-4 py-2 border border-gray-300 rounded">{{ $article->titulo }}</td>
        <td class="px-4 py-2 border border-gray-300 rounded">{{ $article->cuerpo }}</td>
        <td class="px-4 py-2 border border-gray-300 rounded">
            <form action= "{{ route('articulos.edit', $article->id_art) }}">
                @csrf
                @method('POST')
                <input type="submit" value="actualizar articulo" class="bg-gray-800 hover:bg-blue-600 text-white px-4 py-2 rounded">
            </form>
        </td>
    </tr>
</table>
<form method="GET" action="{{ route('articulos.show') }}">
    <input type="submit" value="Volver" class="bg-gray-800 hover:bg-blue-600 text-white px-4 py-2 rounded">
</form>