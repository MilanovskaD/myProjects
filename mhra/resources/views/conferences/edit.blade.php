<x-app-layout>
    <h2 class="my-4 text-xl font-bold text-gray-900 text-center">Edit Event</h2>
    <br/>
    <div class="bg-white container mx-auto rounded-lg">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <form action="{{ route('conferences.update', $conferences->id) }}" method="POST">
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
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $conferences->title) }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    </div>
                    <div class="w-full">
                        <label for="theme" class="block mb-2 text-sm font-medium text-gray-900">Theme</label>
                        <input type="text" name="theme" id="theme" value="{{ old('theme', $conferences->theme) }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="description"
                               class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                        <textarea id="description" name="description" rows="8"
                                  class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300">{{ old('description', $conferences->description) }}</textarea>
                    </div>
                    <div class="w-full">
                        <label for="date" class="block mb-2 text-sm font-medium text-gray-900">Date</label>
                        <input type="date" name="date" id="date" value="{{ old('date', $conferences->date) }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    </div>
                    <div>
                        <label for="location" class="block mb-2 text-sm font-medium text-gray-900">Location</label>
                        <input type="text" name="location" id="location"
                               value="{{ old('location', $conferences->location) }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    </div>
                    <div class="w-full">
                        <label for="objective" class="block mb-2 text-sm font-medium text-gray-900">Objective</label>
                        <input type="text" name="objective" id="objective"
                               value="{{ old('objective', $conferences->objective) }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    </div>
                    <div>
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                        <input type="text" name="status" id="status" value="{{ old('status', $conferences->status) }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    </div>
                    <div>
                        <label for="speaker_id" class="block mb-2 text-sm font-medium text-gray-900">Choose a speaker
                            for this event</label>
                        <select name="speaker_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                id="speaker_id">
                            <option value="">None</option>
                            @foreach($speakers as $speaker)
                                <option value="{{ $speaker->id }}"
                                        @if(old('speaker_id', $conferences->speaker_id) == $speaker->id) selected @endif>
                                    @if ($speaker->is_special_guest)
                                        {{ $speaker->name }} {{ $speaker->surname }} - Special guest
                                    @else
                                        {{ $speaker->name }} {{ $speaker->surname }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button type="submit"
                        class="inline-flex items-center px-5 py-2.5 mt-4 mb-4 sm:mt-6 text-sm font-medium text-white bg-orange-500 rounded-lg">
                    Update Conference
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
