<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                
                <h1 class="text-4xl font-bold text-gray-900 mb-6">
                    {{ $post->title }}
                </h1>

                @if($post->image)
                    <div class="mb-8">
                        <img src="{{ Storage::url($post->image) }}" 
                             alt="{{ $post->title }}" 
                             class="w-full h-auto max-h-[450px] object-cover rounded-lg shadow-sm" />
                    </div>
                @endif

                <div class="prose max-w-none text-gray-700 leading-relaxed text-lg whitespace-pre-line mb-8">
                    {{ $post->content }}
                </div>

                @can('update', $post)
                    <div class="border-t border-gray-100 pt-6 flex items-center gap-4">
                        <a href="{{ route('post.edit', $post) }}" class="inline-flex items-center justify-center px-4 py-2 bg-gray-900 hover:bg-gray-800 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm">
                            Edit Article
                        </a>

                        <form action="{{ route('post.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this article?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-red-50 hover:bg-red-100 text-red-600 text-sm font-semibold rounded-lg transition-colors">
                                Delete
                            </button>
                        </form>
                    </div>
                @endcan

            </div>
        </div>
    </div>
</x-app-layout>