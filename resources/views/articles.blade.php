@extends('layout.app')
@yield('Lista de articulos')
@section('sidebar')
    <p>texto de ejemplo</p>
@endsection
@yield('content')
    <h1>Lista de articulos</h1>
    @if($articlesList->count() === 0)
    <p>No existen articulos</p>
    @else
    <table border='1';>
        
         @foreach($articlesList as $article)
            <tr>
                <td><a href="{{url('/articulos/' . $article->id_art) }}">{{$article["id_art"]}} </a></td>
                <td>{{$article["titulo"]}}</td>
                <td>{{$article["cuerpo"]}}</td>
                <td>
                    <form action= "{{ route('articulos.destroy', $article->id_art) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="eliminar articulo">
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <p><a href="{{ route('articulos.create') }}"><button>Añadir artículos</button></a></p>
    @endif
