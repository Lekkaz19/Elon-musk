<x-home-layout>
    <div class="py-12 bg-gray-100 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-8">{{ __('Biography Timeline') }}</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($eventos as $evento)
                    <div class="bg-white dark:bg-gray-900 rounded-lg shadow-lg overflow-hidden transform hover:-translate-y-2 transition-transform duration-300">
                        <a href="{{ route('biografia-eventos.show', $evento->id) }}">
                            <img class="rounded-t-lg h-48 w-full object-cover" src="{{ $evento->image_url ?? 'https://placehold.co/400x250/1a1a1a/FFFFFF/png?text=Bio' }}" alt="{{ $evento->title }}" />
                            <div class="p-5">
                                <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $evento->year }}: {{ $evento->title }}</h5>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ Illuminate\Support\Str::limit($evento->description, 100) }}</p>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-700 dark:text-gray-300 text-lg">{{ __('No biography events found at the moment. Check back later!') }}</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-12">
                {{ $eventos->links() }}
            </div>
        </div>
    </div>
</x-home-layout>
