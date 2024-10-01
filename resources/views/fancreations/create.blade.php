<x-app-layout>
    <a href="{{ route('fancreations') }}" class="absolute">
        <x-button.inline class="ml-3">
            <i class="fa-solid fa-chevron-left"></i>
        </x-button.inline>
    </a>
    @livewire('Fancreations.Submit')
</x-app-layout>
