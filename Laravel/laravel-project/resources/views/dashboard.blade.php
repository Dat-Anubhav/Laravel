<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900">
                    <ul class="flex justify-center flex-wrap text-sm font-medium text-center text-body">
                        <li class="me-2">
                            <a href="#" class="inline-block px-4 py-2 text-white bg-blue-600 rounded-md active" aria-current="page">
                                All
                            </a>
                        </li>

                        @foreach ($categories as $cat)
                            <li class="me-2">
                                <a href="#"
                                   class="inline-block px-4 py-2 rounded-base hover:text-heading hover:bg-neutral-secondary-soft">
                                    {{ $cat->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-4 text-gray-900">
                    @foreach ($posts as $po)
                        <div class="bg-neutral-primary-soft p-6 border border-default rounded-base shadow-xs mt-8 text-gray-900">
                            <div class="flex flex-col md:flex-row justify-between items-center gap-6">

                                <div class="flex-1">
                                    <a href="#">
                                        <h5 class="mb-2 text-2xl font-semibold tracking-tight text-heading">
                                            Streamlining your design process today.
                                        </h5>
                                    </a>

                                    <p class="mb-6 text-body">
                                        In today’s fast-paced digital landscape, fostering seamless collaboration among Developers and IT Operations.
                                    </p>

                                    <a href="#"
                                       class="inline-flex items-center text-white bg-blue-600 box-border border border-default-medium hover:bg-blue-700 focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2 focus:outline-none">
                                        Read more
                                        <svg class="w-4 h-4 ms-1.5 rtl:rotate-180 -me-0.5"
                                             aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg"
                                             width="24"
                                             height="24"
                                             fill="none"
                                             viewBox="0 0 24 24">
                                            <path stroke="currentColor"
                                                  stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M19 12H5m14 0-4 4m4-4-4-4" />
                                        </svg>
                                    </a>
                                </div>

                                <div class="w-full md:w-[420px]">
                                    <a href="#">
                                        <img class="rounded-base w-full h-auto"
                                             src="https://flowbite.com/docs/images/blog/image-1.jpg"
                                             alt="Post image" />
                                    </a>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</x-app-layout>