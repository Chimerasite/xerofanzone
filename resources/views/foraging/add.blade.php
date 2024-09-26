<x-app-layout>
    <a href="{{ route('stats.foraging') }}" class="absolute">
        <x-button.inline class="ml-3">
            <i class="fa-solid fa-chevron-left"></i>
        </x-button.inline>
    </a>
    <div class="bg-red-600 border border-stone-50 rounded-md shadow-md lg:w-1/2 m-auto text-stone-50 p-4 text-center">
        <i class="fa-solid fa-triangle-exclamation mr-2"></i>
            Please do not add data from before February 1st 2024
        <i class="fa-solid fa-triangle-exclamation ml-2"></i>
    </div>
    @livewire('Foraging.Submit')
</x-app-layout>
