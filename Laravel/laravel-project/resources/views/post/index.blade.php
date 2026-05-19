<x-app-layout>
    <div class="py-6 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-4">
                    <x-category-tabs />
                </div>
            </div>

            <div class="space-y-6">
                @forelse ($posts as $p)
                <x-post-item :po="$p"/> <!--post-item.blade.php define $po variable inside it -->
                    
                @empty
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-12 text-center">
                        <div class="max-w-md mx-auto flex flex-col items-center">
                            <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"></path>
                            </svg>
                            <h3 class="text-lg font-bold text-gray-900 mb-1">No articles found</h3>
                            <p class="text-sm text-gray-500">We couldn't find any posts matching your selection right now. Try checking back later or browsing another category.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $posts->onEachSide(1)->links() }}
            </div>

        </div>
    </div>
</x-app-layout>