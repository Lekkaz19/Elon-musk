<section>
    <header><h2 class="text-lg font-medium text-gray-100">Info Perfil</h2></header>
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf @method('patch')
        <div><label class="block text-gray-300">Nombre</label><x-text-input name="name" type="text" class="mt-1 block w-full bg-gray-900 border-gray-600 text-white rounded-md" value="{{ old('name', $user->name) }}" required /></div>
        <div><label class="block text-gray-300">Email</label><x-text-input name="email" type="email" class="mt-1 block w-full bg-gray-900 border-gray-600 text-white rounded-md" value="{{ old('email', $user->email) }}" required /></div>
        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Guardar</button>
    </form>
</section>
