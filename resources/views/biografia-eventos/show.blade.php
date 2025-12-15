<x-home-layout>
    <div class="py-12 bg-gray-100 dark:bg-gray-800">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-4xl font-extrabold mb-4">{{ $evento->year }}: {{ $evento->title }}</h1>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">{{ __('Published on') }} {{ $evento->created_at->format('M d, Y') }}</p>
                    
                    <img class="w-full h-80 object-cover mb-8 rounded-lg"
                        <?php
                            $imageUrl = $evento->image_url;
                            if ($imageUrl && (str_starts_with($imageUrl, 'http://') || str_starts_with($imageUrl, 'https://'))) {
                                echo 'src="' . e($imageUrl) . '"';
                            } elseif ($imageUrl) {
                                echo 'src="' . e(asset('storage/' . $imageUrl)) . '"';
                            } else {
                                echo 'src="https://placehold.co/1200x400/1a1a1a/FFFFFF/png?text=Bio+Event+Image"';
                            }
                        ?>
                    alt="{{ $evento->title }}">
                    
                    <div class="prose dark:prose-invert max-w-none text-gray-800 dark:text-gray-200">
                        {!! $evento->description !!}
                    </div>

                    <hr class="my-10 border-gray-200 dark:border-gray-700">

                    <!-- Comments Section -->
                    <div class="mt-8">
                        <h2 class="text-3xl font-bold mb-6 text-gray-900 dark:text-gray-100">{{ __('Comments') }}</h2>

                        @if (session('success'))
                            <div class="bg-green-100 dark:bg-green-800 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-200 px-4 py-3 rounded relative mb-4" role="alert">
                                <span class="block sm:inline">{{ session('success') }}</span>
                            </div>
                        @endif

                        <!-- Post Comment Form -->
                        <div class="mb-10 p-6 bg-gray-50 dark:bg-gray-800 rounded-lg shadow-inner">
                            <h3 class="text-2xl font-bold mb-4 text-gray-900 dark:text-gray-100">{{ __('Leave a Comment') }}</h3>
                            <form action="{{ route('comments.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="commentable_type" value="App\Models\BiografiaEvento">
                                <input type="hidden" name="commentable_id" value="{{ $evento->id }}">
                                
                                @guest
                                    <div class="mb-4">
                                        <label for="guest_name" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">{{ __('Your Name') }}:</label>
                                        <input type="text" name="guest_name" id="guest_name" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600" required>
                                    </div>
                                @endguest

                                <div class="mb-4">
                                    <label for="content" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">{{ __('Your Comment') }}:</label>
                                    <textarea name="content" id="content" rows="6" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600" required></textarea>
                                </div>
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                                    {{ __('Post Comment') }}
                                </button>
                            </form>
                        </div>

                        <!-- Existing Comments List -->
                        <div>
                            @forelse ($comments as $comment)
                                <div class="mb-6 p-5 bg-white dark:bg-gray-800 rounded-lg shadow">
                                    <div class="flex items-center mb-2">
                                        <div class="w-10 h-10 rounded-full bg-gray-300 dark:bg-gray-600 flex items-center justify-center text-gray-800 dark:text-gray-200 font-bold text-lg mr-3">
                                            {{ substr($comment->user->name ?? $comment->guest_name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-gray-900 dark:text-gray-100">{{ $comment->user->name ?? $comment->guest_name }}</p>
                                            <p class="text-gray-600 dark:text-gray-400 text-xs">{{ $comment->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <p class="mt-3 text-gray-800 dark:text-gray-200">{{ $comment->content }}</p>
                                </div>
                            @empty
                                <p class="text-center text-gray-600 dark:text-gray-400 text-lg py-8">{{ __('No comments yet. Be the first to comment!') }}</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-home-layout>