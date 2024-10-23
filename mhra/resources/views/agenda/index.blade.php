<x-app-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 mt-20 lg:max-w-screen-lg">
        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <span class="font-medium"></span> {{ session('success') }}
            </div>
        @endif
        <div class="mb-5">
            <a href="{{ route('agenda.create') }}"
               class="py-2.5 px-6 text-sm rounded-lg bg-gradient-to-r from-orange-500 to-orange-300 text-white font-semibold shadow-xs transition duration-500 hover:bg-gradient-to-l">
                Add new agenda <i class="fas fa-angle-double-right"></i>
            </a>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Agenda</th>
                    <th scope="col" class="px-6 py-3">Event/Conference</th>
                    <th scope="col" class="px-6 py-3">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($agendas as $agenda)
                    @php
                        $agendaItems = json_decode($agenda->details, true);
                    @endphp
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">
                            @foreach($agendaItems as $item)
                                <div class="mb-4">
                                    <strong>Hour:</strong> {{ $item['hour'] }}<br>
                                    <strong>Title:</strong> {{ $item['title'] }}<br>
                                    <strong>Description:</strong> {!! $item['description'] !!}
                                </div>
                            @endforeach
                        </td>
                        <td class="px-6 py-4">
                            @if ($agenda->event)
                                {{ $agenda->event->title }} - Event
                            @elseif ($agenda->annual_conference)
                                {{ $agenda->annual_conference->title }} - Conference
                            @else
                                No event/conference
                            @endif
                        </td>
                        <td class="px-6 py-4 flex space-x-3">
                            <a href="{{ route('agenda.edit', $agenda->id) }}"
                               class="text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                            <form action="{{ route('agenda.destroy', $agenda->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this agenda?');"
                                  class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 dark:text-red-500 hover:underline">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $agendas->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
