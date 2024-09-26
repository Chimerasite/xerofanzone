<x-app-layout>
    <a href="{{ route('stats.comets') }}" class="absolute">
        <x-button.inline class="ml-3">
            <i class="fa-solid fa-chevron-left"></i>
        </x-button.inline>
    </a>
    <div class="text-center w-2/3 m-auto mb-8">
        <h2>Wish Shard Calculator</h2>
        <p>
            This is a tool to calculate the minimum, maximum and average amount of Wish Shards you can recieve from the Comet Clusters you are opening.
            The data is based on the current information collected on Comet Clusters in this system.
        </p>
        <hr class="mt-6 border-1 rounded-md">
    </div>

    @livewire('Comets.Calculator')
    <div class="w-full flex justify-end mt-6 ">
        <a href="{{ route('stats.comets') }}">
            <x-button.secondary class="ml-3">
                {{ __('Back to Comet Cluster Stats') }}
            </x-button.secondary>
        </a>
    </div>
</x-app-layout>
