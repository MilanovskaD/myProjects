<x-app-layout>
    <h2 class="my-4 text-xl font-bold text-gray-900 text-center">Add New Employee</h2>
    <div class="bg-white container mx-auto rounded-lg">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
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
                    <div class="w-full">
                        <label for="job_title" class="block mb-2 text-sm font-medium text-gray-900">Job Title</label>
                        <input type="text" name="job_title" id="job_title" value="{{ old('job_title') }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                    </div>

                    <div class="w-full">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">First Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                    </div>

                    <div class="w-full">
                        <label for="surname" class="block mb-2 text-sm font-medium text-gray-900">Last Name</label>
                        <input type="text" name="surname" id="surname" value="{{ old('surname') }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                    </div>

                    <div class="sm:col-span-2">
                        <label for="short_bio" class="block mb-2 text-sm font-medium text-gray-900">Short Bio</label>
                        <textarea name="short_bio" id="short_bio" rows="4"
                                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">{{ old('short_bio') }}</textarea>
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

                        <label for="github" class="block mt-4 mb-2 text-sm font-medium text-gray-900">Facebook</label>
                        <input type="text" name="social_media[github]" id="github"
                               placeholder="https://facebook.com/username"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                    </div>

                    <div class="w-full">
                        <label for="profile_picture" class="block mb-2 text-sm font-medium text-gray-900">Profile
                            Picture</label>
                        <input type="file" name="profile_picture" id="profile_picture"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                    </div>
                </div>

                <button type="submit"
                        class=" mt-3 py-2.5 px-6 text-sm rounded-lg bg-gradient-to-r from-orange-500 to-orange-300 text-white font-semibold shadow-xs transition duration-500 hover:bg-gradient-to-l">
                    Create Employee
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
