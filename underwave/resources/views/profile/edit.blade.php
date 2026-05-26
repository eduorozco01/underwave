<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif text-3xl font-extrabold text-uw-text leading-tight uppercase border-b-4 border-uw-border pb-2 inline-block">
            {{ __('Terminal de Perfil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="p-4 sm:p-8 bg-uw-card border-4 border-uw-border shadow-brutal text-uw-text">
                <div class="max-w-xl font-mono">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-uw-card border-4 border-uw-border shadow-brutal text-uw-text">
                <div class="max-w-xl font-mono">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-uw-card border-4 border-uw-border shadow-brutal text-uw-text">
                <div class="max-w-xl font-mono">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
