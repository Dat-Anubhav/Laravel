<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center justify-center bg-gray-50 px-4">
        <div class="max-w-lg text-center">
            <x-application-logo class="w-20 h-20 mx-auto fill-current text-gray-800" />

            <h1 class="mt-8 text-4xl font-bold text-gray-900 tracking-tight">
                Share your stories
            </h1>

            <p class="mt-4 text-lg text-gray-600 leading-relaxed">
                A Medium-style blogging platform built with Laravel. Read articles, follow authors, and publish your own ideas.
            </p>

            <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}">
                        <x-primary-button class="px-8 py-3">Go to your feed</x-primary-button>
                    </a>
                @else
                    <a href="{{ route('register') }}">
                        <x-primary-button class="px-8 py-3">Get started</x-primary-button>
                    </a>
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900 transition-colors">
                        Log in
                    </a>
                @endauth
            </div>

            <p class="mt-12 text-xs text-gray-400">
                Based on the
                <a href="https://www.youtube.com/watch?v=MG1kt_wiIz0" class="underline hover:text-gray-600" target="_blank" rel="noopener">
                    freeCodeCamp Laravel Medium clone
                </a>
                tutorial.
            </p>
        </div>
    </div>
</x-guest-layout>
