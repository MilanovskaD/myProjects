<x-app-layout>
    <h2 class="text-xl font-bold text-gray-900 text-center my-4">Edit General Info</h2>
    <div class="bg-white container mx-auto rounded-lg">
        <div class="py-8 px-4 mx-auto max-w-4xl lg:py-16">
            <form action="{{ route('generalInfo.update', $generalInfo->id) }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">

                    <div class="w-full">
                        <label for="hero_image" class="block mb-2 text-sm font-medium text-gray-900">Hero Image</label>
                        <input type="file" name="hero_image" id="hero_image"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                    </div>

                    <div class="sm:col-span-2">
                        <label for="social_media_links" class="block mb-2 text-sm font-medium text-gray-900">Social
                            Media Links</label>

                        <label for="instagram" class="block mb-2 text-sm font-medium text-gray-900">Instagram</label>
                        <input type="text" name="social_media_links[instagram]" id="instagram"
                               value="{{ old('social_media_links.instagram', json_decode($generalInfo->social_media_links)->instagram ?? '') }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">

                        <label for="facebook" class="block mb-2 text-sm font-medium text-gray-900">Facebook</label>
                        <input type="text" name="social_media_links[facebook]" id="facebook"
                               value="{{ old('social_media_links.facebook', json_decode($generalInfo->social_media_links)->facebook ?? '') }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">

                        <label for="youtube" class="block mb-2 text-sm font-medium text-gray-900">YouTube</label>
                        <input type="text" name="social_media_links[youtube]" id="youtube"
                               value="{{ old('social_media_links.youtube', json_decode($generalInfo->social_media_links)->youtube ?? '') }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">

                        <label for="linkedin" class="block mb-2 text-sm font-medium text-gray-900">LinkedIn</label>
                        <input type="text" name="social_media_links[linkedin]" id="linkedin"
                               value="{{ old('social_media_links.linkedin', json_decode($generalInfo->social_media_links)->linkedin ?? '') }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                    </div>

                    <div class="sm:col-span-2">
                        <label for="general" class="block mb-2 text-sm font-medium text-gray-900">General
                            Information</label>
                        <textarea name="general" id="general" rows="6"
                                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">{{ old('general', $generalInfo->general) }}</textarea>
                    </div>
                </div>

                <button type="submit"
                        class=" mt-3 py-2.5 px-6 text-sm rounded-lg bg-gradient-to-r from-orange-500 to-orange-300 text-white font-semibold shadow-xs transition duration-500 hover:bg-gradient-to-l">
                    Update Info
                </button>
            </form>
        </div>
    </div>
</x-app-layout>

