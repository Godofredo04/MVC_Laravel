@extends('layout.app')
@section('title', 'Lista de artículos')

@section('sidebar')
    <p></p>
@endsection

@section('content')
    {{-- BARRA DE NAVEGACIÓN --}}
    <nav class="flex justify-start space-x-4 mb-6 items-center bg-gray-800 text-white p-4 w-full">
        <a href="{{ route('articulos.show') }}" class="bg-blue-600 px-4 py-2 rounded">
            Artículos
        </a>
        
        @if(auth()->check() && auth()->user()->is_admin)
            <a href="{{ route('users.index') }}" class="hover:bg-blue-600 px-4 py-2 rounded">
                Usuarios
            </a>
        @endif
        
        <form method="POST" action="{{ route('logout') }}" class="ml-auto">
            @csrf
            <button type="submit" class="hover:bg-blue-600 px-4 py-2 rounded">
                Cerrar sesión
            </button>
        </form>
    </nav>

    {{-- CONTENIDO PRINCIPAL --}}
    <div class="container mx-auto px-4">
        
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">
                Lista de artículos de {{ auth()->user()->name ?? 'Invitado'}}
            </h1>
            <a href="{{ route('articulos.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Añadir artículo
            </a>
        </div>
        
        @if($articlesList->count() === 0)
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6" role="alert">
                <p>No existen artículos.</p>
            </div>
        @else
            <div class="overflow-x-auto shadow rounded-lg">
                <table class="min-w-full border-collapse bg-white">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium w-1/12">ID</th>
                            <th class="px-6 py-3 text-left text-sm font-medium w-3/12">Título</th>
                            <th class="px-6 py-3 text-left text-sm font-medium w-4/12">Cuerpo</th>
                            @auth
                                <th class="px-6 py-3 text-center text-sm font-medium w-4/12">Acciones</th>
                            @endauth
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach($articlesList as $article)
                            <tr class="even:bg-gray-100 hover:bg-indigo-50 border-b">
                                {{-- 1. ID --}}
                                <td class="px-6 py-4">
                                    <a href="{{ route('articulos.show', $article->id_art) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">
                                        {{ $article->id_art }}
                                    </a>
                                </td>
                                {{-- 2. Título --}}
                                <td class="px-6 py-4">{{ $article->titulo }}</td>
                                {{-- 3. Cuerpo --}}
                                <td class="px-6 py-4">{{ Str::limit($article->cuerpo, 80) }}</td>
                                
                                @auth
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex space-x-2 justify-center">
                                            
                                            <a href="{{ route('articulos.edit', $article->id_art) }}" 
                                               class="bg-yellow-500 hover:bg-yellow-600 text-black px-3 py-1 rounded text-sm whitespace-nowrap">
                                                Editar artículo
                                            </a>
                                            
                                            <form action="{{ route('articulos.destroy', $article->id_art) }}" method="POST"
                                                  onsubmit="return confirm('¿Estás seguro de eliminar este artículo?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-black px-3 py-1 rounded text-sm whitespace-nowrap">
                                                    Eliminar artículo
                                                </button>
                                            </form>
                                            
                                        </div>
                                    </td>
                                @endauth
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection