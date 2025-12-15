<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-100 leading-tight">Panel de Control</h2></x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg border border-gray-700 p-6">
                <h3 class="text-2xl font-bold mb-6 text-white">Gestionar Contenido</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <a href="{{ route('admin.curiosidades.index') }}" class="block p-6 bg-blue-600 hover:bg-blue-700 rounded-lg shadow text-center"><h4 class="text-white font-bold text-lg">Curiosidades</h4></a>
                    <a href="{{ route('admin.innovaciones.index') }}" class="block p-6 bg-purple-600 hover:bg-purple-700 rounded-lg shadow text-center"><h4 class="text-white font-bold text-lg">Innovaciones</h4></a>
                    <a href="{{ route('admin.biografia-eventos.index') }}" class="block p-6 bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow text-center"><h4 class="text-white font-bold text-lg">Biografía</h4></a>
                    <a href="{{ route('admin.users.index') }}" class="block p-6 bg-red-600 hover:bg-red-700 rounded-lg shadow text-center"><h4 class="text-white font-bold text-lg">Usuarios</h4></a>
                    <a href="{{ route('admin.comments.index') }}" class="block p-6 bg-green-600 hover:bg-green-700 rounded-lg shadow text-center"><h4 class="text-white font-bold text-lg">Comentarios</h4></a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
