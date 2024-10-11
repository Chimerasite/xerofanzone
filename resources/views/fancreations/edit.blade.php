<x-app-layout>
    <a href="{{ route('fancreations-show', $post->slug) }}" class="absolute">
        <x-button.inline class="ml-3">
            <i class="fa-solid fa-chevron-left"></i>
        </x-button.inline>
    </a>
    @livewire('Fancreations.post-edit', ['post' => $post])
</x-app-layout>
