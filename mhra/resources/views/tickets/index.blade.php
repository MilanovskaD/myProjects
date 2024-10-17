<x-app-layout>

    <div class="container mx-auto mt-20">
        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <span class="font-medium"></span> {{ session('success') }}
            </div>
        @endif
        <div class="mb-5">
            <a href="{{ route('tickets.create') }}"
               class="py-2.5 px-6 text-sm rounded-lg bg-gradient-to-r from-orange-500 to-orange-300 text-white font-semibold shadow-xs transition duration-500 hover:bg-gradient-to-l">
                Add new ticket <i class="fas fa-angle-double-right"></i>
            </a>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        For event/Conference
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Price (per person)
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Price (per company)
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Actions
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($tickets as $ticket)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">
                            @if ($ticket->event)
                                {{ $ticket->event->title }} - Event
                            @elseif ($ticket->annual_conference)
                                {{ $ticket->annual_conference->title }} - Conference
                            @else
                                No Event/Conference
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            {{ $ticket->price_per_person }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $ticket->price_per_company  }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('tickets.edit', $ticket->id) }}"
                               class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                            <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this ticket?');"
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
