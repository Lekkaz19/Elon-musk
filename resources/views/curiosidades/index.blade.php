<x-home-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(Auth::check() && Auth::user()->isAdmin())
                <div class="flex justify-end mb-6"><a href="{{ route('admin.curiosidades.create') }}" class="bg-green-600 hover:bg-green-500 text-white font-bold py-2 px-4 rounded">+ Nueva Curiosidad</a></div>
            @endif
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse ($curiosidades as $item)
                    <div class="bg-gray-800 border border-gray-700 rounded-lg shadow-lg overflow-hidden">
                        @php
                            $src = (str_starts_with($item->image_url, 'http')) ? $item->image_url : asset('storage/' . $item->image_url);
                            if(!$item->image_url) $src = 'https://placehold.co/600x400/333/fff?text=No+Image';
                        @endphp
                        <img class="w-full h-48 object-cover" src="{{ $src }}" alt="{{ $item->title }}">
                        <div class="p-5">
                            <h5 class="text-xl font-bold text-white mb-2">{{ $item->title }}</h5>
                            <p class="text-gray-400 mb-4">{{ Str::limit($item->content, 80) }}</p>
                            <a href="{{ route('curiosidades.show', $item->id) }}" class="text-blue-400 hover:underline">Leer más →</a>
                        </div>
                    </div>
                @empty
                    <p class="text-white">No hay curiosidades aún.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
