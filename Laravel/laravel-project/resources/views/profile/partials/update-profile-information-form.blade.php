<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information, photo, and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- Profile photo --}}
        <div
            x-data="{
                preview: null,
                existing: @js($user->image ? Storage::url($user->image) : null),
                showExisting() { return !this.preview && this.existing; },
                showInitial() { return !this.preview && !this.existing; },
            }"
            class="rounded-xl border border-gray-200 bg-gray-50 p-5"
        >
            <x-input-label for="image" :value="__('Profile photo')" />

            <div class="mt-4 flex flex-col sm:flex-row sm:items-center gap-5">
                <div class="shrink-0">
                    <img x-show="preview" :src="preview" alt="Preview" class="h-24 w-24 rounded-full object-cover ring-2 ring-white shadow-md" />
                    <img x-show="showExisting()" :src="existing" alt="{{ $user->name }}" class="h-24 w-24 rounded-full object-cover ring-2 ring-white shadow-md" />
                    <div x-show="showInitial()" class="flex h-24 w-24 items-center justify-center rounded-full bg-blue-600 text-3xl font-bold text-white shadow-md ring-2 ring-white">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                </div>

                <div class="flex-1 space-y-3">
                    <input
                        id="image"
                        name="image"
                        type="file"
                        accept="image/jpeg,image/jpg,image/png,image/gif,image/webp"
                        class="block w-full text-sm text-gray-600 file:mr-4 file:rounded-lg file:border-0 file:bg-gray-800 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-gray-700"
                        @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null"
                    />
                    <p class="text-xs text-gray-500">JPG, PNG, GIF or WebP. Max 2 MB. Saved as a 200×200 avatar.</p>

                    @if ($user->image)
                        <label class="inline-flex items-center gap-2 text-sm text-gray-600 cursor-pointer">
                            <input type="checkbox" name="remove_image" value="1" class="rounded border-gray-300 text-red-600 focus:ring-red-500"
                                   @change="if ($event.target.checked) { preview = null; existing = null; }">
                            Remove current photo
                        </label>
                    @endif

                    <x-input-error class="mt-1" :messages="$errors->get('image')" />
                </div>
            </div>
        </div>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" :value="old('username', $user->username)" required autocomplete="username" />
            <p class="mt-1 text-xs text-gray-500">Public profile: {{ url('/@') }}{{ old('username', $user->username) }}</p>
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <div>
            <x-input-label for="bio" :value="__('Bio')" />
            <textarea id="bio" name="bio" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4" placeholder="Tell readers a little about yourself...">{{ old('bio', $user->bio) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 font-medium"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
