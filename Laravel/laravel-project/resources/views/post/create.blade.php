<x-app-layout>
    <div class="py-6 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 p-8">
                <form action="{{ route('post.store') }}" enctype="multipart/form-data" method="Post">
                    @csrf

                    <!--Image-->

                    <div>
                        <x-input-label for="image" :value="__('Image')" />
                        <input name="image"
                            class="cursor-pointer bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full shadow-xs placeholder:text-body"
                            id="file_input" type="file">
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    <!--Category-->

                    <div class="mt-4">
                        <x-input-label for="category_id" :value="__('Category')" />
                        <select name="category_id" id="category_id"
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                            <option value="">Select a Category</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                    </div>

                    <!--title-->

                    <div class="mt-4">
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                            :value="old('title')" required autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <!--Content-->

                    <div class="mt-4">
                        <x-input-label for="content" :value="__('Content')" />
                        <x-input-textarea id="content" class="block mt-1 w-full" type="text" name="content"
                            :value="old('content')" required />
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                    </div>

                    <!--Submit-->

                    <x-primary-button class="mt-4">Submit</x-primary-button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>