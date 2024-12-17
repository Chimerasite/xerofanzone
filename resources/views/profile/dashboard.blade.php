<x-app-layout>
            <div class="text-center mb-4">
                <h1>
                    {{ __("Welcome") }} {{ Auth()->user()->name }}!
                </h1>
            </div>
            <hr class="m-auto" style="width: 50%;">
            <div class="mt-4">
                <h2>My Posts</h2>
                <div class="flex flex-wrap justify-center w-full">
                    @livewire('profile.partials.posts')
                </div>
            </div>
</x-app-layout>
