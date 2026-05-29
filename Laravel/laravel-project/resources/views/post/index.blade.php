<x-app-layout>
    <div class="py-6 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-feed-tabs />

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-4">
                    <x-category-tabs />
                </div>
            </div>

            @if (session('status'))
                <div class="mb-4 p-4 bg-green-50 text-green-700 text-sm rounded-lg border border-green-100">
                    {{ session('status') }}
                </div>
            @endif

            <div class="space-y-6">
                @forelse($posts as $po)
                    <x-post-item :po="$po" :liked-post-ids="$likedPostIds" />
                @empty
                    <div class="text-center py-12 bg-white rounded-lg border border-gray-200 shadow-sm">
                        <p class="text-gray-500 text-lg">
                            @if (request()->query('feed') === 'following')
                                Follow authors to see their articles here.
                            @else
                                No articles found. Be the first to
                                <a href="{{ route('post.create') }}" class="text-blue-600 hover:underline">write one</a>.
                            @endif
                        </p>
                    </div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $posts->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
