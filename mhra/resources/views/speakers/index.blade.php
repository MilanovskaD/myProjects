<x-app-layout>

    <div class="container mx-auto mt-20">
        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <span class="font-medium"></span> {{ session('success') }}
            </div>
        @endif
        <div class="mb-5">
            <a href="{{ route('speakers.create') }}"
               class="py-2.5 px-6 text-sm rounded-lg bg-gradient-to-r from-orange-500 to-orange-300 text-white font-semibold shadow-xs transition duration-500 hover:bg-gradient-to-l">
                Add new speaker<i class="fas fa-angle-double-right"></i>
            </a>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Surname
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Job Type
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Is special guest
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Social Media links
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Actions
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($speakers as $speaker)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $speaker->name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $speaker->surname }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $speaker->title}}
                        </td>
                        <td class="px-6 py-4">
                            {{ $speaker->job_type }}
                        </td>
                        <td class="px-6 py-4">
                            @if($speaker->is_special_guest === 1)
                                Yes
                            @else
                                No
                            @endif


                        </td>
                        <td class="px-6 py-4">
                            @php
                                $socialMedia = json_decode($speaker->social_media, true);
                            @endphp

                            @if(!empty($socialMedia))
                                @foreach($socialMedia as $platform => $url)
                                    <a href="{{ $url }}" target="_blank"
                                       class="text-blue-500 hover:underline">{{ ucfirst($platform) }}</a><br>
                                @endforeach
                            @else
                                No social media links
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('speakers.edit', $speaker->id) }}"
                               class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                            <form action="{{ route('speakers.destroy', $speaker->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this speaker?');"
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
