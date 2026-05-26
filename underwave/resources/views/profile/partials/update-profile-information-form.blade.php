<section>
    <header>
        <h2 class="text-lg font-medium text-uw-text font-serif uppercase tracking-tighter">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-uw-text/70">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="flex items-center gap-6">
            <div class="shrink-0">
                @if($user->avatar_path)
                    <img src="{{ $user->avatar_path }}" alt="Avatar" class="h-16 w-16 object-cover border-2 border-uw-border bg-uw-card shadow-brutal-sm">
                @else
                    <div class="h-16 w-16 flex items-center justify-center border-2 border-uw-border bg-uw-card text-uw-text font-mono font-bold shadow-brutal-sm">
                        UW
                    </div>
                @endif
            </div>
            <div class="flex-1">
                <x-input-label for="avatar" :value="__('Avatar (JPG/PNG, Max 2MB)')" />
                <input id="avatar" name="avatar" type="file" accept=".jpg,.jpeg,.png" class="mt-1 block w-full text-sm text-uw-text file:mr-4 file:py-2 file:px-4 file:rounded-none file:border-2 file:border-uw-border file:text-xs file:font-black file:font-mono file:bg-uw-accent file:text-black hover:file:bg-black hover:file:text-uw-accent file:transition-all cursor-pointer focus:outline-none" />
                <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
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
                    <p class="text-sm mt-2 text-uw-text">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-uw-text/70 hover:text-uw-text rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-uw-text/70"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
