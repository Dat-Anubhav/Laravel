@props(['po', 'likedPostIds' => collect()])

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-md transition-shadow duration-200">
    <div class="flex flex-col md:flex-row justify-between items-start gap-6">

        <div class="flex-1 order-2 md:order-1 flex flex-col gap-4">
            <a href="{{ route('post.show', $po->slug) }}" class="group">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 group-hover:text-blue-600 transition-colors duration-200">
                    {{ $po->title }}
                </h5>
            </a>

            <div class="flex items-center gap-2 text-xs text-gray-500">
                @if ($po->user->image)
                    <img src="{{ Storage::url($po->user->image) }}" alt="{{ $po->user->name }}" class="h-6 w-6 rounded-full object-cover" />
                @else
                    <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-blue-600 text-[10px] font-bold text-white">
                        {{ strtoupper(substr($po->user->name, 0, 1)) }}
                    </span>
                @endif
                <span>
                    By
                    <a href="{{ route('profile.public', $po->user->username) }}" class="font-semibold text-gray-700 hover:text-blue-600 hover:underline transition-colors">
                        {{ $po->user->name }}
                    </a>
                </span>
            </div>

            <p class="text-gray-600 leading-relaxed text-sm line-clamp-3">
                {{ $po->excerpt }}
            </p>

            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-t border-gray-100 pt-4">
                <a href="{{ route('post.show', $po->slug) }}">
                    <x-primary-button>
                        Read more
                        <svg class="w-4 h-4 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5m14 0-4 4m4-4-4-4" />
                        </svg>
                    </x-primary-button>
                </a>

                <div class="text-xs text-gray-400 flex items-center gap-4 select-none">
                    <div>
                        Published on {{ $po->created_at->format('M d, Y') }}
                    </div>

                    <div class="flex items-center gap-1 text-gray-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                        </svg>
                        <span class="font-medium text-gray-600">{{ $po->comments_count }}</span>
                    </div>

                    @auth
                        <form action="{{ route('posts.like', $po->id) }}" method="POST"
                              class="inline-flex items-center"
                              data-like-form
                              data-liked="{{ $likedPostIds->contains($po->id) ? 'true' : 'false' }}">
                            @csrf
                            <button type="submit" class="flex items-center gap-1 text-gray-500 hover:text-red-500 transition-colors group focus:outline-none">
                                <span data-like-icon>
                                    @if ($likedPostIds->contains($po->id))
                                        <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5 fill-none stroke-current stroke-2 group-hover:scale-110 transition-transform" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                        </svg>
                                    @endif
                                </span>
                                <span data-like-count class="text-xs font-medium text-gray-600 group-hover:text-red-500">
                                    {{ $po->likes_count }}
                                </span>
                            </button>
                        </form>
                    @else
                        <span class="flex items-center gap-1 text-gray-500">
                            <svg class="w-5 h-5 fill-none stroke-current stroke-2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            <span class="text-xs font-medium text-gray-600">{{ $po->likes_count }}</span>
                        </span>
                    @endauth
                </div>
            </div>
        </div>

        @if($po->image)
            <div class="w-full md:w-[320px] lg:w-[400px] order-1 md:order-2 shrink-0 overflow-hidden rounded-lg bg-gray-50 shadow-sm">
                <a href="{{ route('post.show', $po->slug) }}" class="block w-full h-full">
                    <img class="w-full h-48 md:h-56 object-cover hover:opacity-95 transition-opacity duration-200" src="{{ Storage::url($po->image) }}" alt="{{ $po->title }}" />
                </a>
            </div>
        @endif

    </div>
</div>
