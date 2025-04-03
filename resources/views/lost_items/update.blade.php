<x-app-layout>
    <a href="{{ route('stats.lostItems') }}" class="absolute">
        <x-button.inline class="ml-3">
            <i class="fa-solid fa-chevron-left"></i>
        </x-button.inline>
    </a>
    @livewire('Lostitems.lostitems-update')
</x-app-layout>
