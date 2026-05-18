<ul class="flex justify-center flex-wrap gap-2 text-sm font-medium text-center">
                        <li>
                            <a href="#" class="inline-block px-4 py-2 text-white bg-blue-600 rounded-lg font-semibold shadow-sm">
                                All
                            </a>
                        </li>
                        @foreach ($categories as $cat)
                            <li>
                                <a href="#" class="inline-block px-4 py-2 text-gray-600 bg-gray-50 hover:bg-gray-100 hover:text-gray-900 rounded-lg transition-colors duration-200">
                                    {{ $cat->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>