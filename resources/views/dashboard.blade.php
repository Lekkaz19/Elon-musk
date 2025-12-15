<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Administración') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Estadísticas -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                
                <!-- Card: Eventos Biográficos -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-700">Línea de Tiempo</h3>
                                <p class="text-3xl font-bold text-gray-900">{{ $stats['total_eventos'] }}</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('biografia-eventos.create') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Agregar Evento →
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card: Innovaciones -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-700">Innovaciones</h3>
                                <p class="text-3xl font-bold text-gray-900">{{ $stats['total_innovaciones'] }}</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('innovaciones.create') }}" class="text-green-600 hover:text-green-800 text-sm font-medium">
                                Agregar Innovación →
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card: Curiosidades -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-700">Curiosidades</h3>
                                <p class="text-3xl font-bold text-gray-900">{{ $stats['total_curiosidades'] }}</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('curiosidades.create') }}" class="text-purple-600 hover:text-purple-800 text-sm font-medium">
                                Agregar Curiosidad →
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Comentarios Pendientes -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Comentarios Recientes</h3>
                        @if($stats['comentarios_pendientes'] > 0)
                            <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                {{ $stats['comentarios_pendientes'] }} pendientes
                            </span>
                        @endif
                    </div>

                    @if($comentarios_recientes->count() > 0)
                        <div class="space-y-4">
                            @foreach($comentarios_recientes as $comentario)
                                <div class="border-l-4 {{ $comentario->approved ? 'border-green-500' : 'border-yellow-500' }} pl-4 py-2">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="font-medium text-gray-900">
                                                {{ $comentario->user->name ?? $comentario->guest_name }}
                                            </p>
                                            <p class="text-sm text-gray-600">{{ Str::limit($comentario->content, 100) }}</p>
                                            <p class="text-xs text-gray-400 mt-1">{{ $comentario->created_at->diffForHumans() }}</p>
                                        </div>
                                        <div>
                                            @if(!$comentario->approved)
                                                <span class="text-yellow-600 text-sm">Pendiente</span>
                                            @else
                                                <span class="text-green-600 text-sm">Aprobado</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('admin.comentarios.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Ver todos los comentarios →
                            </a>
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">No hay comentarios aún.</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>