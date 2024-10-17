<x-app-layout>

    <div class="container mx-auto mt-20">
        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <span class="font-medium"></span> {{ session('success') }}
            </div>
        @endif
        <div class="mb-5">
            <a href="{{ route('conferences.create') }}"
               class="py-2.5 px-6 text-sm rounded-lg bg-gradient-to-r from-orange-500 to-orange-300 text-white font-semibold shadow-xs transition duration-500 hover:bg-gradient-to-l">
                Add new conference <i class="fas fa-angle-double-right"></i>
            </a>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Theme
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Description
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Location
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Objective
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Speaker
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Actions
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($conferences as $conference)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $conference->title }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $conference->theme }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $conference->description }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $conference->date }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $conference->location }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $conference->objective }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $conference->status }}
                        </td>
                        <td class="px-6 py-4">

                            @if ($conference->speaker->is_special_guest)
                                {{ $conference->speaker->name }} {{ $conference->speaker->surname }} - Special guest
                            @elseif (!$conference->speaker->is_special_guest)
                                {{ $conference->speaker->name }} {{ $conference->speaker->surname }}
                            @else
                                No speaker chosen
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('conferences.edit', $conference->id) }}"
                               class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                            <form action="{{ route('conferences.destroy', $conference->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this conference?');"
                                  class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline ms-1">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>
