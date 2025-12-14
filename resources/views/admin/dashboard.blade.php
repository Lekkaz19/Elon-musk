<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-4">{{ __('Manage Content') }}</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <a href="{{ route('admin.curiosidades.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center">
                            {{ __('Manage Curiosidades') }}
                        </a>
                        <a href="{{ route('admin.innovaciones.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center">
                            {{ __('Manage Innovaciones') }}
                        </a>
                        <a href="{{ route('admin.biografia-eventos.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center">
                            {{ __('Manage Biografia Eventos') }}
                        </a>
                        <a href="{{ route('admin.comments.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded text-center">
                            {{ __('Manage Comments') }}
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded text-center">
                            {{ __('Manage Users') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
