<x-app-layout>
    <h2 class="text-xl font-bold text-gray-900 text-center my-4">General Info</h2>
    <div class="bg-white container mx-auto rounded-lg">
        <div class="py-8 px-4 mx-auto max-w-4xl lg:py-16">
            <div class="mb-6">
                @if ($generalInfo)
                    <h3 class="text-lg font-medium">Hero Image</h3>
                    <div class="border rounded-lg p-4 mb-4">
                        @if ($generalInfo->hero_image_path)
                            <img src="{{ Storage::url($generalInfo->hero_image_path) }}" alt="Hero Image" class="w-full h-auto">

                        @else
                            <p>No Hero Image Uploaded</p>
                        @endif
{{--                            {{ dd(Storage::url($generalInfo->hero_image_path)) }}--}}

                    </div>

                    <h3 class="text-lg font-medium">Social Media Links</h3>
                    <div class="border rounded-lg p-4 mb-4">
                        @php $socialLinks = json_decode($generalInfo->social_media_links, true) @endphp
                        <ul>
                            @if($socialLinks)
                                @foreach($socialLinks as $platform => $link)
                                    <li><strong>{{ ucfirst($platform) }}:</strong> <a href="{{ $link }}" target="_blank"
                                                                                      class="text-blue-600">{{ $link }}</a>
                                    </li>
                                @endforeach
                            @else
                                <p>No Social Media Links Added</p>
                            @endif
                        </ul>
                    </div>

                    <h3 class="text-lg font-medium">General Information</h3>
                    <div class="border rounded-lg p-4">
                        <p>{{ $generalInfo->general ?: 'No general information provided.' }}</p>
                    </div>

                    <div class="mt-6 text-center">
                        <a href="{{ route('generalInfo.edit', $id = $generalInfo['id'] ) }}"
                           class="py-2.5 px-6 text-sm rounded-lg bg-gradient-to-r from-orange-500 to-orange-300 text-white font-semibold shadow-xs transition duration-500 hover:bg-gradient-to-l">Edit General Info</a>
                    </div>
                @else
                    <p>No general information found. <a
                            href="{{ route('generalInfo.edit' , $id = $generalInfo['id']) }}" class="text-blue-600">Create</a>
                        the general information.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

