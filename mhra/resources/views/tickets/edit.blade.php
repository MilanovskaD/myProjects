<x-app-layout>
    <h2 class="my-4 text-xl font-bold text-gray-900 text-center">Edit ticket</h2>
    <br/>
    <div class="bg-white container mx-auto rounded-lg">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <form action="{{ route('tickets.update', $ticket->id)}}" method="POST">
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

                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="event" class="block mb-2 text-sm font-medium text-gray-900">Event</label>

                        <select id="event" name="event_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            @foreach($events as $event)
                                <option
                                    value="{{ $event->id }}" {{ $event->id == $ticket->event_id ? 'selected' : '' }}>
                                    {{ $event->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full">
                        <label for="price_per_person" class="block mb-2 text-sm font-medium text-gray-900">Price per
                            person</label>
                        <input type="number" name="price_per_person" id="price_per_person"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                               value="{{ old('price_per_person', $ticket->price_per_person) }}">
                    </div>
                    <div class="w-full">
                        <label for="price_per_company" class="block mb-2 text-sm font-medium text-gray-900">Price per
                            company</label>
                        <input type="number" name="price_per_company" id="price_per_company"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                               value="{{ old('price_per_company', $ticket->price_per_company) }}">
                    </div>
                    <button type="submit"
                            class=" mt-3 py-2.5 px-6 text-sm rounded-lg bg-gradient-to-r from-orange-500 to-orange-300 text-white font-semibold shadow-xs transition duration-500 hover:bg-gradient-to-l">
                        Update Ticket
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
