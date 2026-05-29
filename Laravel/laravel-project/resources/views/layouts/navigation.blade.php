<nav x-data="{ open: false }" class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between gap-4">

            <div class="flex shrink-0 items-center">
                <a href="{{ auth()->check() ? route('dashboard') : route('home') }}" class="flex items-center">
                    <x-application-logo class="block h-8 w-auto" />
                </a>
            </div>

            <div class="flex items-center gap-3 sm:gap-6">
                @auth
                    <a href="{{ route('post.create') }}" class="hidden sm:inline-flex">
                        <x-primary-button>Create Post</x-primary-button>
                    </a>

                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button type="button" class="inline-flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 focus:outline-none">
                                <span class="hidden sm:inline">{{ Auth::user()->name }}</span>
                                <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-gray-800 text-xs font-bold text-white sm:hidden">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </span>
                                <svg class="hidden h-4 w-4 fill-current sm:block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.public', auth()->user()->username)">
                                {{ __('My Public Profile') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Settings') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">Log in</a>
                    <a href="{{ route('register') }}">
                        <x-primary-button>Register</x-primary-button>
                    </a>
                @endauth

                <button type="button" @click="open = ! open" class="inline-flex items-center justify-center rounded-md p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-700 focus:outline-none sm:hidden">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{ 'block': open, 'hidden': !open }" class="hidden border-t border-gray-200 sm:hidden">
        <div class="space-y-1 px-4 py-3">
            @auth
                <a href="{{ route('dashboard') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-50">Feed</a>
                <a href="{{ route('post.create') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-50">Create Post</a>
                <a href="{{ route('profile.public', auth()->user()->username) }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-50">My Profile</a>
            @else
                <a href="{{ route('login') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-50">Log in</a>
                <a href="{{ route('register') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-50">Register</a>
            @endauth
        </div>
    </div>
</nav>
