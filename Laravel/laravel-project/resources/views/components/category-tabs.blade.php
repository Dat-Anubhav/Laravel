@props(['user' => null])

<ul class="flex justify-center flex-wrap gap-2 text-sm font-medium text-center">
    
    <li>
        <a href="{{ $user ? route('profile.public', $user->username) : route('dashboard', request()->only('feed')) }}" 
           class="inline-block px-4 py-2 {{ !request()->has('category') ? 'text-white bg-blue-600 font-semibold shadow-sm' : 'text-gray-600 bg-gray-50 hover:bg-gray-100 hover:text-gray-900' }} rounded-lg transition-colors duration-200">
            All
        </a>
    </li>

    @foreach ($categories as $cat)
        @php
            // Fallback: If slug is missing from the DB record, generate it from the name automatically
            $slug = $cat->slug ?: Str::slug($cat->name);
        @endphp
        <li>
            <a href="{{ $user ? route('profile.public', ['username' => $user->username, 'category' => $slug]) : route('dashboard', array_merge(request()->query(), ['category' => $slug])) }}" 
               class="inline-block px-4 py-2 {{ request()->has('category') && request()->query('category') === $slug ? 'text-white bg-blue-600 font-semibold shadow-sm' : 'text-gray-600 bg-gray-50 hover:bg-gray-100 hover:text-gray-900' }} rounded-lg transition-colors duration-200">
                {{ $cat->name }}
            </a>
        </li>
    @endforeach
</ul>