<x-app-layout>
    <a href="{{ route('fancreations') }}" class="absolute">
        <x-button.inline class="ml-3">
            <i class="fa-solid fa-chevron-left"></i>
        </x-button.inline>
    </a>
    <div class="lg:mt-0 mt-8">
        @livewire('Fancreations.post-create')
    </div>
</x-app-layout>
