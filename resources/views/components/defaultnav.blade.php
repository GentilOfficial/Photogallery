<header class="fixed top-0 z-50 flex flex-wrap w-full py-3 text-sm bg-white shadow sm:justify-start sm:flex-nowrap">
    <nav class="max-w-[85rem] w-full mx-auto px-4 sm:flex sm:items-center sm:justify-between">
        <a class="flex-none text-xl font-semibold text-black focus:outline-none focus:opacity-80" href="/"
            aria-label="Brand">Photo gallery</a>
        <div class="flex flex-row items-center gap-5 mt-5 sm:justify-end sm:mt-0 sm:ps-5">
            @auth
                <a class="font-medium text-gray-600 hover:text-gray-400 focus:outline-none focus:text-gray-400"
                    href="/">Home</a>
                <a class="font-medium text-gray-600 hover:text-gray-400 focus:outline-none focus:text-gray-400"
                    href="{{ route('albums.index') }}">Albums</a>
                <a class="font-medium text-gray-600 hover:text-gray-400 focus:outline-none focus:text-gray-400"
                    href="{{ route('categories.index') }}">Categories</a>
                <a class="font-medium text-gray-600 hover:text-gray-400 focus:outline-none focus:text-gray-400"
                    href="{{ route('categories.create') }}">New Category</a>
                <a class="font-medium text-gray-600 hover:text-gray-400 focus:outline-none focus:text-gray-400"
                    href="{{ route('albums.create') }}">New Album</a>
                <a class="font-medium text-gray-600 hover:text-gray-400 focus:outline-none focus:text-gray-400"
                    href="{{ route('photos.create') }}">New Photo</a>
            @endauth
        </div>
        @guest
            <div class="flex flex-row items-center gap-5 mt-5 sm:justify-end sm:mt-0 sm:ps-5">
                <a class="font-medium text-gray-600 hover:text-gray-400 focus:outline-none focus:text-gray-400"
                    href="{{ route('login') }}">Login</a>
                <a class="font-medium text-gray-600 hover:text-gray-400 focus:outline-none focus:text-gray-400"
                    href="{{ route('register') }}">Register</a>
            </div>
        @endguest
        @auth
            <div class="flex items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md focus:outline-none">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                </div>

                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="px-4">
                        <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <x-responsive-nav-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-responsive-nav-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                        </form>
                    </div>
                </div>
            </div>
        @endauth
    </nav>
</header>
