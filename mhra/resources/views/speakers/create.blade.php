<x-app-layout>
    <h2 class="my-4 text-xl font-bold text-gray-900 text-center">Add a new speaker</h2>
    <br/>
    <div class="bg-white container mx-auto rounded-lg">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <form action="{{route('speakers.store')}}" method="POST">
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

                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                        <input type="text" name="name" id="name"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Name">
                    </div>
                    <div class="w-full">
                        <label for="surname" class="block mb-2 text-sm font-medium text-gray-900">Surname</label>
                        <input type="text" name="surname" id="surname"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Surname">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Title</label>
                        <input type="text" id="title" name="title"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Title">
                    </div>
                    <div class="w-full">
                        <label for="job_type" class="block mb-2 text-sm font-medium text-gray-900">Job type</label>
                        <input type="text" name="job_type" id="job_type"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Job type">
                    </div>
                    <div class="w-full">
                        <label class="block mb-2 text-sm font-medium text-gray-900">Special guest:</label>
                        <div class="flex justify-between">
                            <label for="yes" class="block mb-2 text-sm font-medium text-gray-900">Yes</label>
                            <input type="radio" name="is_special_guest" id="yes" value="1" >

                            <label for="no" class="block mb-2 text-sm font-medium text-gray-900">No</label>
                            <input type="radio" name="is_special_guest" id="no" value="0">
                        </div>
                    </div>

                    <!-- Social Media Section -->
                    <div class="sm:col-span-2">
                        <h3 class="block mb-2 text-sm font-medium text-gray-900">Social Media</h3>

                        <label for="twitter" class="block mb-2 text-sm font-medium text-gray-900">Twitter</label>
                        <input type="text" name="social_media[twitter]" id="twitter"
                               placeholder="https://twitter.com/username"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">

                        <label for="linkedin" class="block mt-4 mb-2 text-sm font-medium text-gray-900">LinkedIn</label>
                        <input type="text" name="social_media[linkedin]" id="linkedin"
                               placeholder="https://linkedin.com/in/username"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">

                        <label for="facebook" class="block mt-4 mb-2 text-sm font-medium text-gray-900">Facebook</label>
                        <input type="text" name="social_media[facebook]" id="facebook"
                               placeholder="https://facobook.com/username"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                    </div>
                </div>

                <button type="submit"
                        class="mt-3 py-2.5 px-6 text-sm rounded-lg bg-gradient-to-r from-orange-500 to-orange-300 text-white font-semibold shadow-xs transition duration-500 hover:bg-gradient-to-l">
                    Create Speaker
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
