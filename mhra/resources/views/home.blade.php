<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User home') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        @foreach($blogs as $blog)
            <div class="mb-8">
                <div
                    class="max-w-4xl mx-auto bg-white border border-gray-200 shadow-lg hover:shadow-2xl dark:bg-gray-800 dark:border-gray-700 rounded-lg overflow-hidden transition-shadow duration-300 ease-in-out">
                    <div class="p-8">
                        <h3 class="mb-4 text-3xl font-extrabold text-gray-900 dark:text-white">{{ $blog->title }}</h3>
                        <p class="mb-6 text-lg font-light text-gray-700 dark:text-gray-400">{{ $blog->body }}</p>
                        <div class="text-right">
                            <a href="#" class="text-indigo-600 dark:text-indigo-400 hover:underline font-semibold">Read
                                more</a>
                        </div>
                    </div>
                    <!-- Comments section -->
                    <div class="bg-gray-50 dark:bg-gray-900 p-4 border-t border-gray-200 dark:border-gray-700">
                        <livewire:comments :model="$blog"/>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
