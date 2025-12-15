<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">Panel de Control - Administrador</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Estadísticas --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm opacity-80">Línea de Tiempo</p>
                            <h3 class="text-3xl font-bold">{{ $biografiaEventos }}</h3>
                        </div>
                        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <div class="mt-4 flex gap-2">
                        <a href="{{ route('admin.biografia-eventos.create') }}" class="bg-white/20 hover:bg-white/30 px-3 py-1 rounded text-sm">Agregar</a>
                        <a href="{{ route('biografia-eventos.index') }}" class="bg-white/20 hover:bg-white/30 px-3 py-1 rounded text-sm">Ver todos</a>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm opacity-80">Innovaciones</p>
                            <h3 class="text-3xl font-bold">{{ $innovaciones }}</h3>
                        </div>
                        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                    <div class="mt-4 flex gap-2">
                        <a href="{{ route('admin.innovaciones.create') }}" class="bg-white/20 hover:bg-white/30 px-3 py-1 rounded text-sm">Agregar</a>
                        <a href="{{ route('innovaciones.index') }}" class="bg-white/20 hover:bg-white/30 px-3 py-1 rounded text-sm">Ver todos</a>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm opacity-80">Curiosidades</p>
                            <h3 class="text-3xl font-bold">{{ $curiosidades }}</h3>
                        </div>
                        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"/>
                        </svg>
                    </div>
                    <div class="mt-4 flex gap-2">
                        <a href="{{ route('admin.curiosidades.create') }}" class="bg-white/20 hover:bg-white/30 px-3 py-1 rounded text-sm">Agregar</a>
                        <a href="{{ route('curiosidades.index') }}" class="bg-white/20 hover:bg-white/30 px-3 py-1 rounded text-sm">Ver todos</a>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm opacity-80">Comentarios Pendientes</p>
                            <h3 class="text-3xl font-bold">{{ $comentariosPendientes }}</h3>
                        </div>
                        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z"/>
                        </svg>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('admin.comentarios.index') }}" class="bg-white/20 hover:bg-white/30 px-3 py-1 rounded text-sm">Gestionar</a>
                    </div>
                </div>
            </div>

            {{-- Gestión de Contenido --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                {{-- Innovaciones --}}
                <div class="bg-gray-800 rounded-lg p-6">
                    <h3 class="text-lg font-bold text-white mb-4">Innovaciones Recientes</h3>
                    @foreach($ultimasInnovaciones as $innovacion)
                    <div class="flex justify-between items-center py-2 border-b border-gray-700">
                        <span class="text-gray-300 text-sm">{{ Str::limit($innovacion->title, 30) }}</span>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.innovaciones.edit', $innovacion) }}" class="text-blue-400 hover:text-blue-300 text-xs">Editar</a>
                            <form action="{{ route('admin.innovaciones.destroy', $innovacion) }}" method="POST" onsubmit="return confirm('¿Eliminar?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300 text-xs">Eliminar</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Curiosidades --}}
                <div class="bg-gray-800 rounded-lg p-6">
                    <h3 class="text-lg font-bold text-white mb-4">Curiosidades Recientes</h3>
                    @foreach($ultimasCuriosidades as $curiosidad)
                    <div class="flex justify-between items-center py-2 border-b border-gray-700">
                        <span class="text-gray-300 text-sm">{{ Str::limit($curiosidad->title, 30) }}</span>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.curiosidades.edit', $curiosidad) }}" class="text-blue-400 hover:text-blue-300 text-xs">Editar</a>
                            <form action="{{ route('admin.curiosidades.destroy', $curiosidad) }}" method="POST" onsubmit="return confirm('¿Eliminar?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300 text-xs">Eliminar</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Eventos Biográficos --}}
                <div class="bg-gray-800 rounded-lg p-6">
                    <h3 class="text-lg font-bold text-white mb-4">Eventos Recientes</h3>
                    @foreach($ultimosEventos as $evento)
                    <div class="flex justify-between items-center py-2 border-b border-gray-700">
                        <span class="text-gray-300 text-sm">{{ $evento->year }}: {{ Str::limit($evento->title, 20) }}</span>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.biografia-eventos.edit', $evento) }}" class="text-blue-400 hover:text-blue-300 text-xs">Editar</a>
                            <form action="{{ route('admin.biografia-eventos.destroy', $evento) }}" method="POST" onsubmit="return confirm('¿Eliminar?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300 text-xs">Eliminar</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Comentarios Recientes --}}
            <div class="bg-gray-800 rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-white">Comentarios Recientes</h3>
                    <a href="{{ route('admin.comentarios.index') }}" class="text-blue-400 hover:text-blue-300 text-sm">Ver todos →</a>
                </div>
                
                @foreach($comentariosRecientes as $comment)
                <div class="flex justify-between items-start py-3 border-b border-gray-700">
                    <div class="flex-1">
                        <p class="text-white font-medium">{{ $comment->user->name }}</p>
                        <p class="text-gray-400 text-sm">{{ Str::limit($comment->content, 100) }}</p>
                        <p class="text-gray-500 text-xs mt-1">{{ $comment->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="flex gap-2 ml-4">
                        @if(!$comment->approved)
                        <form action="{{ route('admin.comentarios.approve', $comment) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs">Aprobar</button>
                        </form>
                        @endif
                        <form action="{{ route('admin.comentarios.destroy', $comment) }}" method="POST" onsubmit="return confirm('¿Eliminar comentario?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs">Eliminar</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Gestión de Usuarios (OPCIONAL) --}}
            <div class="bg-gray-800 rounded-lg p-6 mt-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-white">Usuarios Registrados</h3>
                    <span class="text-gray-400">Total: {{ $totalUsuarios }}</span>
                </div>
                <a href="{{ route('admin.usuarios.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded inline-block">Gestionar Usuarios</a>
            </div>

        </div>
    </div>
</x-app-layout>