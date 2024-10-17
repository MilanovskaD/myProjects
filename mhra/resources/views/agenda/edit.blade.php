<x-app-layout>
    <h2 class="my-4 text-xl font-bold text-gray-900 text-center">Edit Agenda</h2>
    <div class="bg-white container mx-auto rounded-lg">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <form action="{{ route('agenda.update', $agenda->id) }}" method="POST">
                @csrf
                @method('PUT')

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
                    @foreach($agendaItems as $index => $item)
                        <div class="agenda-item sm:col-span-2">
                            <label for="hour_{{ $index }}"
                                   class="block mb-2 text-sm font-medium text-gray-900">Hour</label>
                            <input type="time" name="hour[]" id="hour_{{ $index }}" value="{{ $item['hour'] }}"
                                   placeholder="Hour"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">

                            <label for="title_{{ $index }}"
                                   class="block mb-2 text-sm font-medium text-gray-900">Title</label>
                            <input type="text" name="title[]" id="title_{{ $index }}" value="{{ $item['title'] }}"
                                   placeholder="Title"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">

                            <label for="description_{{ $index }}" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                            <input id="description_{{ $index }}" type="hidden" name="description[]"
                                   value="{{ $item['description'] }}">
                            <trix-editor input="description_{{ $index }}"></trix-editor>
                        </div>
                    @endforeach
                </div>

                <button type="button" id="addAgendaItem"
                        class="mt-3 py-2.5 px-6 text-sm rounded-lg bg-gradient-to-r from-orange-500 to-orange-300 text-white font-semibold shadow-xs transition duration-500 hover:bg-gradient-to-l">
                    Add new set of items
                </button>

                <button type="submit"
                        class="py-2.5 px-6 text-sm rounded-lg bg-gradient-to-r from-orange-500 to-orange-300 text-white font-semibold shadow-xs transition duration-500 hover:bg-gradient-to-l">
                    Edit
                </button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('addAgendaItem').addEventListener('click', function () {
            let container = document.getElementById('agendaItemsContainer');
            let uniqueID = Date.now(); // Generate a unique ID for each new item

            let newItem = `
                <div class="agenda-item sm:col-span-2">
                    <label for="hour_${uniqueID}" class="block mb-2 text-sm font-medium text-gray-900">Hour</label>
                    <input type="time" name="hour[]" id="hour_${uniqueID}" placeholder="Hour" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">

                    <label for="title_${uniqueID}" class="block mb-2 text-sm font-medium text-gray-900">Title</label>
                    <input type="text" name="title[]" id="title_${uniqueID}" placeholder="Title class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">

                    <label for="description_${uniqueID}" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                    <input id="description_${uniqueID}" type="hidden" name="description[]">
                    <trix-editor input="description_${uniqueID}"></trix-editor>
                </div>
            `;

            container.insertAdjacentHTML('beforeend', newItem);
        });
    </script>
</x-app-layout>
