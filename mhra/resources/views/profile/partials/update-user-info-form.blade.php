{{--<section>--}}
{{--    <header>--}}
{{--        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">--}}
{{--            {{ __('Additional Profile Information') }}--}}
{{--        </h2>--}}

{{--        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">--}}
{{--            {{ __("Update your account's additional profile information.") }}--}}
{{--        </p>--}}
{{--    </header>--}}

{{--    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">--}}
{{--        @csrf--}}
{{--        @method('patch')--}}

{{--        <div>--}}
{{--            <x-input-label for="bio" :value="__('Bio')" />--}}
{{--            <textarea id="bio" name="bio" class="mt-1 block w-full" rows="3">{{ old('bio', $user->bio) }}</textarea>--}}
{{--            <x-input-error class="mt-2" :messages="$errors->get('bio')" />--}}
{{--        </div>--}}

{{--        <div>--}}
{{--            <x-input-label for="title" :value="__('Title')" />--}}
{{--            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $user->title)" />--}}
{{--            <x-input-error class="mt-2" :messages="$errors->get('title')" />--}}
{{--        </div>--}}

{{--        <div>--}}
{{--            <x-input-label for="phone" :value="__('Phone')" />--}}
{{--            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user->phone)" />--}}
{{--            <x-input-error class="mt-2" :messages="$errors->get('phone')" />--}}
{{--        </div>--}}

{{--        <div>--}}
{{--            <x-input-label for="city" :value="__('City')" />--}}
{{--            <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" :value="old('city', $user->city)" />--}}
{{--            <x-input-error class="mt-2" :messages="$errors->get('city')" />--}}
{{--        </div>--}}

{{--        <div>--}}
{{--            <x-input-label for="country" :value="__('Country')" />--}}
{{--            <x-text-input id="country" name="country" type="text" class="mt-1 block w-full" :value="old('country', $user->country)" />--}}
{{--            <x-input-error class="mt-2" :messages="$errors->get('country')" />--}}
{{--        </div>--}}

{{--        <div>--}}
{{--            <x-input-label for="cv_upload_path" :value="__('CV Upload')" />--}}
{{--            <input id="cv_upload_path" name="cv_upload_path" type="file" class="mt-1 block w-full" />--}}
{{--            <x-input-error class="mt-2" :messages="$errors->get('cv_upload_path')" />--}}
{{--        </div>--}}

{{--        <div>--}}
{{--            <x-input-label for="photo_upload_path" :value="__('Profile Picture')" />--}}
{{--            <input id="photo_upload_path" name="photo_upload_path" type="file" class="mt-1 block w-full" />--}}
{{--            <x-input-error class="mt-2" :messages="$errors->get('photo_upload_path')" />--}}
{{--        </div>--}}

{{--        <div class="flex items-center gap-4">--}}
{{--            <x-primary-button>{{ __('Save') }}</x-primary-button>--}}

{{--            @if (session('status') === 'profile-updated')--}}
{{--                <p--}}
{{--                    x-data="{ show: true }"--}}
{{--                    x-show="show"--}}
{{--                    x-transition--}}
{{--                    x-init="setTimeout(() => show = false, 2000)"--}}
{{--                    class="text-sm text-gray-600 dark:text-gray-400"--}}
{{--                >{{ __('Saved.') }}</p>--}}
{{--            @endif--}}
{{--        </div>--}}
{{--    </form>--}}
{{--</section>--}}
