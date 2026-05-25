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

                <div class="prose max-w-none text-gray-700 leading-relaxed text-lg whitespace-pre-line">
                    {{ $post->content }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>