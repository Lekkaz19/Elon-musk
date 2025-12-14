<x-home-layout>

    <!-- Hero Section -->
    <div class="relative h-[50vh] bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1541185934-01b604ca86ed?q=80&w=2070&auto=format&fit=crop');">
        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="text-center text-white p-8">
                <h1 class="text-5xl font-extrabold tracking-tight">{{ __('Exploring the Mind of a Visionary') }}</h1>
                <p class="mt-4 text-xl text-gray-300">{{ __('A journey through the innovations, curiosities, and life of Elon Musk.') }}</p>
            </div>
        </div>
    </div>

    <div class="py-12 bg-gray-100 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Innovaciones Section -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">{{ __('Recent Innovations') }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($innovaciones as $innovacion)
                        <div class="bg-white dark:bg-gray-900 rounded-lg shadow-lg overflow-hidden transform hover:-translate-y-2 transition-transform duration-300">
                            <a href="{{ route('innovaciones.show', $innovacion->id) }}">
                                <img class="rounded-t-lg h-48 w-full object-cover" src="{{ $innovacion->image_url ?? 'https://placehold.co/400x250/000000/FFFFFF/png?text=Innovation' }}" alt="{{ $innovacion->title }}" />
                                <div class="p-5">
                                    <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $innovacion->title }}</h5>
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ Illuminate\Support\Str::limit($innovacion->description, 100) }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Curiosidades Section -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">{{ __('Interesting Curiosities') }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($curiosidades as $curiosidad)
                         <div class="bg-white dark:bg-gray-900 rounded-lg shadow-lg overflow-hidden transform hover:-translate-y-2 transition-transform duration-300">
                            <a href="{{ route('curiosidades.show', $curiosidad->id) }}">
                                <img class="rounded-t-lg h-48 w-full object-cover" src="{{ $curiosidad->image_url ?? 'https://placehold.co/400x250/333333/FFFFFF/png?text=Curiosity' }}" alt="{{ $curiosidad->title }}" />
                                <div class="p-5">
                                    <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $curiosidad->title }}</h5>
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ Illuminate\Support\Str::limit($curiosidad->content, 100) }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Biografia Section -->
            <div>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">{{ __('Biography Timeline') }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($biografiaEventos as $evento)
                        <div class="bg-white dark:bg-gray-900 rounded-lg shadow-lg overflow-hidden transform hover:-translate-y-2 transition-transform duration-300">
                            <a href="{{ route('biografia-eventos.show', $evento->id) }}">
                                <img class="rounded-t-lg h-48 w-full object-cover" src="{{ $evento->image_url ?? 'https://placehold.co/400x250/1a1a1a/FFFFFF/png?text=Bio' }}" alt="{{ $evento->title }}" />
                                <div class="p-5">
                                    <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $evento->year }}: {{ $evento->title }}</h5>
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ Illuminate\Support\Str::limit($evento->description, 100) }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</x-home-layout>