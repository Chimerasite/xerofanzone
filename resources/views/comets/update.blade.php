<x-app-layout>
    <a href="{{ route('stats.comets') }}" class="absolute">
        <x-button.inline class="ml-3">
            <i class="fa-solid fa-chevron-left"></i>
        </x-button.inline>
    </a>
    @livewire('Comets.Submit')
</x-app-layout>
