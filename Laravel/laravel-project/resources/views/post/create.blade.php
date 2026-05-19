<x-app-layout>
    <div class="py-6 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 p-8">
                <form action="{{ route('post.store') }}" method="post"></form>
            </div>

        </div>
    </div>
</x-app-layout>