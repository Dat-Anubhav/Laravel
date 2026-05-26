<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <div class="flex flex-col md:flex-row gap-12 items-start">
            
            <div class="w-full md:w-2/3 space-y-10">
                <div class="border-b border-gray-200 pb-4 mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Articles</h2>
                </div>

                @forelse($posts as $post)
                    <article class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col sm:flex-row gap-6 hover:shadow-md transition-shadow">
                        <div class="flex-1 flex flex-col justify-between">
                            <div>
                                <a href="{{ route('post.show', $post->slug) }}" class="group">
                                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-indigo-600 transition-colors mb-2">
                                        {{ $post->title }}
                                    </h3>
                                </a>
                                <p class="text-gray-600 text-sm line-clamp-3 mb-4">
                                    {{ Str::limit($post->content, 180) }}
                                </p>
                            </div>
                            <div class="text-xs text-gray-400">
                                Published on {{ $post->created_at->format('M d, Y') }}
                            </div>
                        </div>

                        @if($post->image)
                            <div class="w-full sm:w-48 h-32 flex-shrink-0">
                                <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover rounded-lg shadow-sm">
                            </div>
                        @endif
                    </article>
                @empty
                    <div class="text-center py-12 bg-white rounded-lg border border-gray-200 shadow-sm">
                        <p class="text-gray-500 text-lg">This author hasn't published any articles yet.</p>
                    </div>
                @endforelse
            </div>

            <div class="w-full md:w-1/3 sticky top-6">
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    
                    <div class="w-16 h-16 md:w-20 md:h-20 bg-gradient-to-tr from-indigo-500 to-purple-500 rounded-full flex items-center justify-center text-white text-2xl md:text-3xl font-bold shadow-md mb-4">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>

                    <h1 class="text-xl md:text-2xl font-bold text-gray-900 mb-1 leading-tight">
                        {{ $user->name }}
                    </h1>
                    <p class="text-xs md:text-sm text-gray-500 mb-4">
                        @<span>{{ $user->username }}</span>
                    </p>

                    <div class="flex gap-4 text-xs md:text-sm font-medium text-gray-700 border-y border-gray-100 py-3 mb-4">
                        <div><span class="text-gray-900 font-bold">0</span> Followers</div>
                        <div><span class="text-gray-900 font-bold">0</span> Following</div>
                    </div>

                    <div class="text-xs md:text-sm text-gray-600 leading-relaxed">
                        <h4 class="font-bold text-gray-800 mb-1">About me</h4>
                        <p class="italic">
                            {{ $user->bio ?? 'No bio shared by the author yet.' }}
                        </p>
                    </div>

                    <button class="w-full mt-6 bg-gray-900 hover:bg-gray-800 text-white text-xs md:text-sm font-semibold py-2 px-4 rounded-full transition-colors shadow-sm">
                        Follow
                    </button>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>