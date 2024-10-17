<x-app-layout>
    <div class="container mx-auto mt-20">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Phone
                    </th>
                    <th scope="col" class="px-6 py-3">
                        City
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Country
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Job title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Biography
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Is banned
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Actions
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $user->name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $user->email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->phone ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->city ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->country ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->title ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->bio ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4">
                            @if ($user->trashed())
                                <span class="text-red-600">Banned {{ $user->deleted_at->diffForHumans() }}</span>
                            @else
                                <span class="text-green-600">Active</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if ($user->trashed())
                                <form action="{{ route('users.restore', $user->id) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to unban this user?');"
                                      class="inline-block">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                            class="font-medium text-green-600 dark:text-green-500 hover:underline">
                                        Unban
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to ban this user?');"
                                      class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline ms-1">
                                        Ban
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="my-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
