<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <div class="flex flex-col md:flex-row gap-12 items-start">

            <div class="w-full md:w-2/3 space-y-10">

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 mb-6 border border-gray-100">
                    <x-category-tabs :user="$user" />
                </div>

                <div class="border-b border-gray-200 pb-4 mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Articles</h2>
                </div>

                @forelse($posts as $post)
                    <x-post-item :po="$post" :liked-post-ids="$likedPostIds" />
                @empty
                    <div class="text-center py-12 bg-white rounded-lg border border-gray-200 shadow-sm">
                        <p class="text-gray-500 text-lg">This author hasn't published any articles yet.</p>
                    </div>
                @endforelse

                <div class="mt-6">
                    {{ $posts->links() }}
                </div>
            </div>

            <div class="w-full md:w-1/3 sticky top-6">
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">

                    @if ($user->image)
                        <img src="{{ Storage::url($user->image) }}" alt="{{ $user->name }}"
                             class="w-16 h-16 md:w-20 md:h-20 rounded-full object-cover shadow-md mb-4" />
                    @else
                        <div class="w-16 h-16 md:w-20 md:h-20 bg-blue-600 rounded-full flex items-center justify-center text-white text-2xl md:text-3xl font-bold shadow-md mb-4 select-none">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif

                    <h1 class="text-xl md:text-2xl font-bold text-gray-900 mb-1 leading-tight">
                        {{ $user->name }}
                    </h1>
                    <p class="text-xs md:text-sm text-gray-500 mb-4">
                        @<span>{{ $user->username }}</span>
                    </p>

                    <div class="flex gap-4 text-xs md:text-sm font-medium text-gray-700 border-y border-gray-100 py-3 mb-4">
                        <div><span class="text-gray-900 font-bold">{{ $user->followers_count }}</span> Followers</div>
                        <div><span class="text-gray-900 font-bold">{{ $user->followings_count }}</span> Following</div>
                    </div>

                    <div class="text-xs md:text-sm text-gray-600 leading-relaxed">
                        <h4 class="font-bold text-gray-800 mb-1">About me</h4>
                        <p class="italic">
                            {{ $user->bio ?? 'No bio shared by the author yet.' }}
                        </p>
                    </div>

                    @if (auth()->id() === $user->id)
                        <a href="{{ route('profile.edit') }}" class="w-full mt-6 inline-flex items-center justify-center px-4 py-2 bg-gray-50 border border-gray-200 hover:bg-gray-100 text-gray-700 text-xs md:text-sm font-semibold rounded-full transition-colors shadow-sm">
                            Edit Profile
                        </a>
                    @elseif (auth()->check())
                        <form action="{{ route('users.follow', $user->id) }}" method="POST" class="mt-3">
                            @csrf
                            <button type="submit"
                                    class="w-full text-xs md:text-sm font-semibold py-2 px-4 rounded-full transition-colors shadow-sm {{ $isFollowing ? 'bg-gray-100 border border-gray-200 hover:bg-gray-200 text-gray-700' : 'bg-gray-900 hover:bg-gray-800 text-white' }}">
                                {{ $isFollowing ? 'Unfollow' : 'Follow' }}
                            </button>
                        </form>
                    @endif

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
