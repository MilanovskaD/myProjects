<x-app-layout>
    <h2 class="my-4 text-xl font-bold text-gray-900 text-center">Add new agenda</h2>
    <div class="bg-white container mx-auto rounded-lg">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <form action="{{ route('agenda.store') }}" method="POST">
                @csrf
                @if ($errors->any())
                    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                        <span class="font-medium"></span> Please correct the errors below.
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div id="agendaItemsContainer" class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="agenda-item sm:col-span-2">
                        <label for="hour" class="block mb-2 text-sm font-medium text-gray-900">Hour</label>
                        <input type="time" name="hour[]" placeholder="Hour"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">

                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Title</label>
                        <input type="text" name="title[]" placeholder="Title"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">

                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                        <input id="description" type="hidden" name="description[]">
                        <!-- Trix editor for description -->
                        <trix-editor input="description"></trix-editor>
                    </div>
                </div>

                <label class="block mb-2 text-sm font-medium text-gray-900">Choose type</label>
                <div class="mb-4">
                    <label>
                        <input type="radio" name="agenda_type" value="event" checked>
                        Event
                    </label>
                    <label>
                        <input type="radio" name="agenda_type" value="annual_conference">
                        Conference
                    </label>
                </div>

                <div id="eventSelect" class="mb-4">
                    <label for="event_id" class="block mb-2 text-sm font-medium text-gray-900">Event</label>
                    <select name="event_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                        <option value="">Choose event</option>
                        @foreach($events as $event)
                            <option value="{{ $event->id }}">{{ $event->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="conferenceSelect" class="mb-4" style="display:none;">
                    <label for="annual_conference_id"
                           class="block mb-2 text-sm font-medium text-gray-900">Conference</label>
                    <select name="annual_conference_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                        <option value="">Choose conference</option>
                        @foreach($conferences as $conference)
                            <option value="{{ $conference->id }}">{{ $conference->title }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="button" id="addAgendaItem"
                        class="py-2.5 px-6 text-sm rounded-lg bg-gradient-to-r from-orange-500 to-orange-300 text-white font-semibold shadow-xs transition duration-500 hover:bg-gradient-to-l">
                    Add new set of items
                </button>

                <button type="submit"
                        class="py-2.5 px-6 text-sm rounded-lg bg-gradient-to-r from-orange-500 to-orange-300 text-white font-semibold shadow-xs transition duration-500 hover:bg-gradient-to-l">
                    Create Agenda
                </button>
            </form>
        </div>
    </div>
    <script>

        document.getElementById('addAgendaItem').addEventListener('click', function () {
            let container = document.getElementById('agendaItemsContainer');
            let uniqueID = Date.now();
            let newItem = `
                <div class="agenda-item sm:col-span-2">
                    <label for="hour" class="block mb-2 text-sm font-medium text-gray-900">Hour</label>
                    <input type="time" name="hour[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">

                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Title</label>
                    <input type="text" name="title[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">

                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                    <input id="description_${uniqueID}" type="hidden" name="description[]">
                    <trix-editor input="description_${uniqueID}"></trix-editor>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', newItem);
        });

        document.querySelectorAll('input[name="agenda_type"]').forEach(function (input) {
            input.addEventListener('change', function () {
                if (this.value === 'event') {
                    document.getElementById('eventSelect').style.display = 'block';
                    document.getElementById('conferenceSelect').style.display = 'none';
                } else {
                    document.getElementById('eventSelect').style.display = 'none';
                    document.getElementById('conferenceSelect').style.display = 'block';
                }
            });
        });
    </script>
</x-app-layout>

