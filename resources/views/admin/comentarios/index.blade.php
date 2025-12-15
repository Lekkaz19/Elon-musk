<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                Gestión de Comentarios
            </h2>
            <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-gray-200">
                ← Volver al Panel
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Mensajes de éxito/error --}}
            @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
            @endif

            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    
                    {{-- Filtros --}}
                    <div class="mb-6 flex gap-4 flex-wrap">
                        <a href="?filter=all" 
                           class="px-4 py-2 rounded font-medium transition-colors {{ $filter === 'all' ? 'bg-blue-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }}">
                            Todos ({{ $pendientes + $aprobados }})
                        </a>
                        <a href="?filter=pending" 
                           class="px-4 py-2 rounded font-medium transition-colors {{ $filter === 'pending' ? 'bg-yellow-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }}">
                            Pendientes ({{ $pendientes }})
                        </a>
                        <a href="?filter=approved" 
                           class="px-4 py-2 rounded font-medium transition-colors {{ $filter === 'approved' ? 'bg-green-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }}">
                            Aprobados ({{ $aprobados }})
                        </a>
                    </div>

                    {{-- Lista de comentarios --}}
                    @forelse($comments as $comment)
                    <div class="bg-gray-900 rounded-lg p-5 mb-4 border-l-4 {{ $comment->approved ? 'border-green-500' : 'border-yellow-500' }}">
                        <div class="flex justify-between items-start gap-4">
                            
                            {{-- Información del comentario --}}
                            <div class="flex-1">
                                {{-- Encabezado: Usuario y estado --}}
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="font-bold text-white text-lg">
                                        {{ $comment->user->name }}
                                    </span>
                                    <span class="text-gray-400 text-sm">
                                        {{ $comment->created_at->diffForHumans() }}
                                    </span>
                                    @if($comment->approved)
                                        <span class="bg-green-600 text-white text-xs px-2 py-1 rounded font-semibold">
                                            ✓ Aprobado
                                        </span>
                                    @else
                                        <span class="bg-yellow-600 text-white text-xs px-2 py-1 rounded font-semibold">
                                            ⏳ Pendiente
                                        </span>
                                    @endif
                                </div>

                                {{-- Contenido del comentario --}}
                                <p class="text-gray-300 mb-3 leading-relaxed">
                                    {{ $comment->content }}
                                </p>

                                {{-- Información del artículo comentado --}}
                                <div class="text-gray-500 text-sm">
                                    <span>Comentario en: </span>
                                    @php
                                        // Determinar tipo y ruta del artículo
                                        $type = class_basename($comment->commentable_type);
                                        $routeName = match($type) {
                                            'Innovacion' => 'innovaciones.show',
                                            'Curiosidad' => 'curiosidades.show',
                                            'BiografiaEvento' => 'biografia-eventos.show',
                                            default => null
                                        };
                                        $typeLabel = match($type) {
                                            'Innovacion' => 'Innovación',
                                            'Curiosidad' => 'Curiosidad',
                                            'BiografiaEvento' => 'Evento Biográfico',
                                            default => 'Artículo'
                                        };
                                    @endphp
                                    @if($routeName && $comment->commentable)
                                        <a href="{{ route($routeName, $comment->commentable->id) }}" 
                                           class="text-blue-400 hover:text-blue-300 hover:underline"
                                           target="_blank">
                                            {{ $typeLabel }} #{{ $comment->commentable->id }}
                                            @if($comment->commentable->title ?? false)
                                                - "{{ Str::limit($comment->commentable->title, 40) }}"
                                            @endif
                                        </a>
                                    @else
                                        <span class="text-gray-600">
                                            {{ $typeLabel }} (eliminado)
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- Botones de acción --}}
                            <div class="flex flex-col gap-2 min-w-[120px]">
                                @if(!$comment->approved)
                                    <form action="{{ route('admin.comentarios.approve', $comment) }}" method="POST">
                                        @csrf
                                        <button type="submit" 
                                                class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded font-medium transition-colors">
                                            ✓ Aprobar
                                        </button>
                                    </form>
                                @endif
                                
                                <form action="{{ route('admin.comentarios.destroy', $comment) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('¿Estás seguro de que deseas eliminar este comentario? Esta acción no se puede deshacer.')">
                                    @csrf @method('DELETE')
                                    <button type="submit" 
                                            class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded font-medium transition-colors">
                                        🗑 Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <p class="mt-4 text-gray-400 text-lg">
                            No hay comentarios {{ $filter === 'pending' ? 'pendientes' : ($filter === 'approved' ? 'aprobados' : '') }}
                        </p>
                    </div>
                    @endforelse

                    {{-- Paginación --}}
                    @if($comments->hasPages())
                    <div class="mt-6">
                        {{ $comments->links() }}
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>