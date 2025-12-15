<section class="space-y-6">
    <header><h2 class="text-lg font-medium text-gray-100">Eliminar Cuenta</h2></header>
    <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-gray-900 border border-gray-700 rounded-lg">
        @csrf @method('delete')
        <h2 class="text-lg font-medium text-gray-100">¿Estás seguro?</h2>
        <div class="mt-6"><x-text-input name="password" type="password" placeholder="Contraseña" class="mt-1 block w-3/4 bg-gray-800 border-gray-600 text-white rounded-md" /></div>
        <div class="mt-6 flex justify-end"><button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Eliminar Cuenta</button></div>
    </form>
</section>
