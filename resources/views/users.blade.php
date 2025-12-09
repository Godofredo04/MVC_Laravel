@extends('layout.app')

@section('title', 'Lista de usuarios')

@section('sidebar')
    <p></p>
@endsection

@section('content')
    <nav class="flex justify-start space-x-4 mb-6 items-center bg-gray-800 text-white p-4 w-full">
        <a href="{{ route('articulos.show') }}" class="hover:bg-blue-600 px-4 py-2 rounded">
            Artículos
        </a>
        
        @if(auth()->check() && auth()->user()->is_admin)
            <a href="{{ route('users.index') }}" class="bg-blue-600 px-4 py-2 rounded">
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

    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">
                Lista de usuarios
            </h1>
            <a href="{{ route('users.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Añadir usuario
            </a>
        </div>

        @if($usersList->count() === 0)
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6" role="alert">
                <p>No existen usuarios registrados.</p>
            </div>
        @else
            <div class="overflow-x-auto shadow rounded-lg">
                <table class="min-w-full border-collapse bg-white">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium">ID</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Nombre</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Email</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Admin</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Fecha registro</th>
                            @auth
                                <th class="px-6 py-3 text-center text-sm font-medium">Acciones</th>
                            @endauth
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach($usersList as $user)
                            <tr class="even:bg-gray-100 hover:bg-indigo-50 border-b">
                                <td class="px-6 py-4">
                                        {{ $user->id }}
                                </td>
                                <td class="px-6 py-4">{{ $user->name }}</td>
                                <td class="px-6 py-4">{{ $user->email }}</td>
                                <td class="px-6 py-4">
                                    @if($user->is_admin)
                                        <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                            Admin
                                        </span>
                                    @else
                                        <span class="bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                            Usuario
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">{{ $user->created_at->format('d/m/Y') }}</td>
                                @auth
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-2 justify-center">
                                            <a href="{{ route('users.edit', $user->id) }}" 
                                               class="bg-yellow-500 hover:bg-yellow-600 text-black px-3 py-1 rounded text-sm">
                                                Editar
                                            </a>
                                            
                                            @if($user->id !== auth()->user()->id)
                                                <form action="{{ route('users.destroy', $user->id) }}" 
                                                      method="POST" 
                                                      onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="bg-red-500 hover:bg-red-600 text-black px-3 py-1 rounded text-sm">
                                                        Eliminar
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                @endauth
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
@endsection