<section>
    <header><h2 class="text-lg font-medium text-gray-100">Contraseña</h2></header>
    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf @method('put')
        <div><label class="block text-gray-300">Actual</label><x-text-input name="current_password" type="password" class="mt-1 block w-full bg-gray-900 border-gray-600 text-white rounded-md" /></div>
        <div><label class="block text-gray-300">Nueva</label><x-text-input name="password" type="password" class="mt-1 block w-full bg-gray-900 border-gray-600 text-white rounded-md" /></div>
        <div><label class="block text-gray-300">Confirmar</label><x-text-input name="password_confirmation" type="password" class="mt-1 block w-full bg-gray-900 border-gray-600 text-white rounded-md" /></div>
        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Guardar</button>
    </form>
</section>
