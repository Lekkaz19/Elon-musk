<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-100 leading-tight">Crear Innovación</h2></x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 border border-gray-700 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.innovaciones.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div><label class="block text-sm font-medium text-gray-300">Título</label><input type="text" name="title" class="mt-1 block w-full bg-gray-900 border-gray-600 text-white rounded-md" required></div>
                    <div><label class="block text-sm font-medium text-gray-300">Descripción</label><textarea name="description" rows="4" class="mt-1 block w-full bg-gray-900 border-gray-600 text-white rounded-md" required></textarea></div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-gray-900 p-4 rounded border border-gray-600">
                        <div><label class="block text-yellow-500 font-bold mb-2">Opción A: Subir Archivo</label><input type="file" name="image_file" class="text-gray-400"></div>
                        <div><label class="block text-blue-400 font-bold mb-2">Opción B: Pegar URL</label><input type="text" name="image_url" placeholder="https://..." class="w-full bg-gray-800 text-white border-gray-600 rounded"></div>
                    </div>
                    <div class="flex justify-end"><button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded">Guardar</button></div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>