<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-md transition-shadow duration-200">
    <div class="flex flex-col md:flex-row justify-between items-start gap-6">

        <div class="flex-1 order-2 md:order-1">
            <a href="{{ route('post.show', $po->slug) }}" class="group">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 group-hover:text-blue-600 transition-colors duration-200">
                    {{ $po->title }}
                </h5>
            </a>

            <p class="mb-6 text-gray-600 leading-relaxed">
                {{ Str::limit($po->content, 190) }}
            </p>
            
            <a href="{{ route('post.show', $po->slug) }}">
                <x-primary-button>
                    Read more
                    <svg class="w-4 h-4 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5m14 0-4 4m4-4-4-4" />
                    </svg>
                </x-primary-button>
            </a>
        </div>

        <div class="w-full md:w-[320px] lg:w-[400px] order-1 md:order-2 shrink-0">
            <a href="#">
                <img class="rounded-lg w-full h-48 md:h-56 object-cover shadow-sm hover:opacity-95 transition-opacity"
                     src="{{ Storage::url($po->image) }}"
                     alt="{{ $po->title }}" />
            </a>
        </div>

    </div>
</div>