<ul class="flex gap-6 border-b border-gray-200 mb-6 text-sm font-medium">
    <li>
        <a href="{{ route('dashboard', request()->only('category')) }}"
           class="inline-block pb-3 {{ request()->query('feed') !== 'following' ? 'border-b-2 border-gray-900 text-gray-900' : 'text-gray-500 hover:text-gray-700' }}">
            For you
        </a>
    </li>
    <li>
        <a href="{{ route('dashboard', array_merge(request()->only('category'), ['feed' => 'following'])) }}"
           class="inline-block pb-3 {{ request()->query('feed') === 'following' ? 'border-b-2 border-gray-900 text-gray-900' : 'text-gray-500 hover:text-gray-700' }}">
            Following
        </a>
    </li>
</ul>
