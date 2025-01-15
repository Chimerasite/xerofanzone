<x-app-layout>
    <h2 class="text-center">
        {{ __('Profile Settings') }}
    </h2>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="text-stone-50">
                <div class="max-w-xl">
                    @include('settings.partials.update-profile-information-form')
                </div>
            </div>
            <hr>
            <div class="text-stone-50">
                <div class="max-w-xl">
                    @include('settings.partials.update-password-form')
                </div>
            </div>
            <hr>
            <div class="text-stone-50">
                <div class="max-w-xl">
                    @include('settings.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
