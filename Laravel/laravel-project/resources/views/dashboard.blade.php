<x-app-layout>


    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900">


                    <ul class="flex justify-center flex-wrap text-sm font-medium text-center text-body">
                        
                        <li class="me-2">
                            <a href="#"
                                class="inline-block px-4 py-2 text-white bg-blue-600 rounded-md active"
                                aria-current="page">
                                All
                                </a>
                        </li>
                        @foreach ($categories as $cat)
                         <li class="me-2">
                            <a href="#"
                                class="inline-block px-4 py-2 rounded-base hover:text-heading hover:bg-neutral-secondary-soft">
                                {{$cat->name}}
                            </a>
                        </li>


                        @endforeach
                       
                    </ul>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>