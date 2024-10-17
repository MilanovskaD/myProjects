<x-app-layout>

    <div class="container mx-auto mt-20">
        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <span class="font-medium"></span> {{ session('success') }}
            </div>
        @endif
        <div class="mb-5">
            <a href="{{ route('employees.create') }}"
               class="py-2.5 px-6 text-sm rounded-lg bg-gradient-to-r from-orange-500 to-orange-300 text-white font-semibold shadow-xs transition duration-500 hover:bg-gradient-to-l">
                Add new employee <i class="fas fa-angle-double-right"></i>
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
                        Job title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Short biography
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Social Media links
                    </th>
                    <th>
                        Profile picture preview
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Actions
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($employees as $employee)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $employee->name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $employee->surname }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $employee->job_title}}
                        </td>
                        <td class="px-6 py-4">
                            {{ $employee->short_bio }}
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $socialMedia = json_decode($employee->social_media, true);
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
                            @if($employee->profile_picture_path)
                                <img src="{{ Storage::url($employee->profile_picture_path) }}" alt="{{ $employee->name }}"
                                     class="w-10 h-10 rounded-full">
                            @else
                                No picture
                            @endif
                        </td>

                        <td class="px-6 py-4">
                            <a href="{{ route('employees.edit', $employee->id) }}"
                               class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this employee?');"
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

