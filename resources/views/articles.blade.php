@extends('layout.app')
@yield('Lista de articulos')
@section('sidebar')
    <p></p>
@endsection
@yield('content')
   <nav class="flex justify-start space-x-4 mb-6 items-center bg-gray-800 text-white p-4 w-full">
        <form method="GET" action="{{ route('articulos.create') }}">
            <button class="hover:bg-blue-600 px-4 py-2 rounded"> 
                Añadir artículos
            </button>
        </a>
        </form>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="hover:bg-blue-600 px-4 py-2 rounded">
                Cerrar sesión
            </button>
        </form>
    </nav>
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Lista de articulos de {{ auth()->user()->name ?? 'Invitado'}}</h1>
    @if($articlesList->count() === 0)
    <p>No existen articulos</p>
    @else
    <table class="min-w-full border-collapse text-gray-700 shadow rounded mb-6">
        
         @foreach($articlesList as $article)
            <tr class="even:bg-gray-100 hover:bg-indigo-50">
                <td class="px-4 py-2"><a href="{{url('/articulos/' . $article->id_art) }}">{{$article["id_art"]}} </a></td>
                <td class="px-4 py-2">{{$article["titulo"]}}</td>
                <td class="px-4 py-2">{{$article["cuerpo"]}}</td>
                @auth
                <td class=class="px-4 py-2">
                    <form action= "{{ route('articulos.destroy', $article->id_art) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="eliminar articulo" class="bg-gray-800 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    </form>
                </td>
                <td class="px-4 py-2">
                    <form action= "{{ route('articulos.edit', $article->id_art) }}">
                        @csrf
                        @method('POST')
                        <input type="submit" value="actualizar articulo" class="bg-gray-800 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    </form>
                </td>
                @endauth
            </tr>
        @endforeach
    </table>
    @endif
    </form>

    
