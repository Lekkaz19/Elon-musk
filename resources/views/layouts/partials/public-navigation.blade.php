<nav x-data="{ open: false }" class="bg-gray-900 text-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="text-xl font-bold tracking-wider">
                    The Musk Archives
                </a>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="text-gray-300 hover:text-white">
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link :href="route('innovaciones.index')" :active="request()->routeIs('innovaciones.index')" class="text-gray-300 hover:text-white">
                        {{ __('Innovations') }}
                    </x-nav-link>
                    <x-nav-link :href="route('curiosidades.index')" :active="request()->routeIs('curiosidades.index')" class="text-gray-300 hover:text-white">
                        {{ __('Curiosities') }}
                    </x-nav-link>
                    <x-nav-link :href="route('biografia-eventos.index')" :active="request()->routeIs('biografia-eventos.index')" class="text-gray-300 hover:text-white">
                        {{ __('Biography') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Right Side Links -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-gray-300 hover:text-white">{{ __('Dashboard') }}</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-300 hover:text-white">{{ __('Log in') }}</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ms-4 text-sm font-medium text-gray-300 hover:text-white">{{ __('Register') }}</a>
                    @endif
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('innovaciones.index')" :active="request()->routeIs('innovaciones.index')">
                {{ __('Innovations') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('curiosidades.index')" :active="request()->routeIs('curiosidades.index')">
                {{ __('Curiosities') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('biografia-eventos.index')" :active="request()->routeIs('biografia-eventos.index')">
                {{ __('Biography') }}
            </x-responsive-nav-link>
        </div>
    </div>
</nav>