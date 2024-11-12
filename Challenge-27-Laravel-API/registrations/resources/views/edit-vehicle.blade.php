<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Vehicle') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('update-vehicle', $vehicle->id) }}" method="POST" id="vehicleEditForm">
                        @csrf
                        @method('PATCH')

                        <input type="hidden" name="vehicle_id" id="vehicle_id" value="{{ $vehicle->id }}">

                        <div>
                            <label for="brand"
                                   class="block text-sm font-medium text-gray-700 dark:text-gray-300">Brand</label>
                            <input type="text" id="brand" name="brand" value="{{ old('brand', $vehicle->brand) }}"
                                   class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md text-gray-600">
                        </div>

                        <div class="mt-4">
                            <label for="model"
                                   class="block text-sm font-medium text-gray-700 dark:text-gray-300">Model</label>
                            <input type="text" id="model" name="model" value="{{ old('model', $vehicle->model) }}"
                                   class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md text-gray-600">
                        </div>

                        <div class="mt-4">
                            <label for="plate_number"
                                   class="block text-sm font-medium text-gray-700 dark:text-gray-300">Plate
                                Number</label>
                            <input type="text" id="plate_number" name="plate_number"
                                   value="{{ old('plate_number', $vehicle->plate_number) }}"
                                   class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md text-gray-600">
                        </div>

                        <div class="mt-4">
                            <label for="insurance_date"
                                   class="block text-sm font-medium text-gray-700 dark:text-gray-300">Insurance
                                Date</label>
                            <input type="date" id="insurance_date" name="insurance_date"
                                   value="{{ old('insurance_date', $vehicle->insurance_date) }}"
                                   class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md text-gray-600">
                        </div>
                        <div class="mt-6">
                            <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update Vehicle
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
