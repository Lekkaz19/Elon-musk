<x-home-layout>
    <div class="py-12 bg-gray-100 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-8">{{ __('All Curiosities') }}</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($curiosidades as $curiosidad)
                    <div class="bg-white dark:bg-gray-900 rounded-lg shadow-lg overflow-hidden transform hover:-translate-y-2 transition-transform duration-300">
                        <a href="{{ route('curiosidades.show', $curiosidad->id) }}">
                            <img class="rounded-t-lg h-48 w-full object-cover" src="{{ $curiosidad->image_url ?? 'https://placehold.co/400x250/333333/FFFFFF/png?text=Curiosity' }}" alt="{{ $curiosidad->title }}" />
                            <div class="p-5">
                                <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $curiosidad->title }}</h5>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ Illuminate\Support\Str::limit($curiosidad->content, 100) }}</p>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-700 dark:text-gray-300 text-lg">{{ __('No curiosities found at the moment. Check back later!') }}</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-12">
                {{ $curiosidades->links() }}
            </div>
        </div>
    </div>
</x-home-layout>
