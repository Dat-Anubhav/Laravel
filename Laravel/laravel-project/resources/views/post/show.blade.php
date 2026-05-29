<x-app-layout>
    <div class="bg-gray-50 py-8 sm:py-12 min-h-screen">
        <article class="mx-auto w-full max-w-3xl px-4 sm:px-6">

            <header class="mb-8">
                <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 leading-tight tracking-tight">
                    {{ $post->title }}
                </h1>

                <div class="mt-5 flex flex-wrap items-center gap-x-4 gap-y-3 text-sm text-gray-500">
                    <span>
                        By
                        <a href="{{ route('profile.public', $post->user->username) }}" class="font-semibold text-gray-800 hover:text-blue-600 hover:underline">
                            {{ $post->user->name }}
                        </a>
                    </span>
                    @if ($post->category)
                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700">
                            {{ $post->category->name }}
                        </span>
                    @endif
                    <span>{{ $post->created_at->format('M d, Y') }}</span>

                    @auth
                        <form action="{{ route('posts.like', $post->id) }}" method="POST" class="ml-auto sm:ml-0">
                            @csrf
                            <button type="submit" class="inline-flex items-center gap-2 rounded-full border border-gray-200 bg-white px-3 py-1.5 hover:border-red-200 hover:bg-red-50 transition-colors">
                                @if ($likedPostIds->contains($post->id))
                                    <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                    </svg>
                                @else
                                    <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                @endif
                                <span class="font-medium text-gray-700">{{ $post->likes_count }}</span>
                            </button>
                        </form>
                    @endauth
                </div>
            </header>

            @if ($post->image)
                <figure class="mb-8 overflow-hidden rounded-xl bg-gray-100 shadow-sm">
                    <img src="{{ Storage::url($post->image) }}"
                         alt="{{ $post->title }}"
                         class="w-full max-h-[480px] object-cover" />
                </figure>
            @endif

            <div class="article-content">
                {!! Str::markdown($post->content) !!}
            </div>

            @can('update', $post)
                <div class="mt-10 flex flex-wrap gap-3 border-t border-gray-200 pt-6">
                    <a href="{{ route('post.edit', $post->slug) }}" class="inline-flex items-center justify-center rounded-lg bg-gray-800 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-700 transition-colors">
                        Edit Article
                    </a>
                    <form action="{{ route('post.destroy', $post->slug) }}" method="POST" onsubmit="return confirm('Delete this article permanently?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center justify-center rounded-lg border border-red-200 bg-red-50 px-4 py-2 text-sm font-semibold text-red-600 hover:bg-red-100 transition-colors">
                            Delete
                        </button>
                    </form>
                </div>
            @endcan

            <section class="mt-12 border-t border-gray-200 pt-10">
                <h2 class="text-xl font-bold text-gray-900 mb-6">
                    Discussion ({{ $post->comments_count }})
                </h2>

                @if (session('status'))
                    <div class="mb-4 rounded-lg border border-green-100 bg-green-50 p-3 text-sm text-green-700">
                        {{ session('status') }}
                    </div>
                @endif

                @auth
                    <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mb-8">
                        @csrf
                        <textarea name="body" rows="4" required
                                  class="w-full resize-none rounded-xl border border-gray-200 px-4 py-3 text-sm shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
                                  placeholder="What are your thoughts on this article?"></textarea>
                        @error('body')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                        <div class="mt-3">
                            <x-primary-button type="submit">Respond</x-primary-button>
                        </div>
                    </form>
                @else
                    <p class="mb-8 rounded-xl border border-gray-100 bg-white p-4 text-center text-sm text-gray-500">
                        <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:underline">Log in</a>
                        to join the discussion.
                    </p>
                @endauth

                <div class="space-y-4">
                    @forelse ($post->comments as $comment)
                        <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm">
                            <div class="mb-3 flex items-center gap-3">
                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-blue-600 text-xs font-bold text-white">
                                    {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-900">{{ $comment->user->name }}</p>
                                    <p class="text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <p class="text-sm leading-relaxed text-gray-700">
                                {!! nl2br(e($comment->body)) !!}
                            </p>
                        </div>
                    @empty
                        <p class="py-6 text-center text-sm italic text-gray-400">
                            No responses yet. Be the first to start the conversation!
                        </p>
                    @endforelse
                </div>
            </section>

        </article>
    </div>
</x-app-layout>
