<div class="flex w-full lg:flex-row flex-col">
    <div class="lg:w-1/2 lg:pr-12">
        <h3 class="mb-6">Amount of Comet Clusters</h3>
        <div>
            <x-input.label class="mt-2" for="small" value="{{ __('Small Comet Clusters') }}" />
            <x-input.text
                wire:model="small"
                type="text"
                placeholder="0"
                class="w-full text-stone-950"
            />
            <x-input.label class="mt-2" for="medium" value="{{ __('Medium Comet Clusters') }}" />
            <x-input.text
                wire:model="medium"
                type="text"
                placeholder="0"
                class="w-full text-stone-950"
            />
            <x-input.label class="mt-2" for="large" value="{{ __('Large Comet Clusters') }}" />
            <x-input.text
                wire:model="large"
                type="text"
                placeholder="0"
                class="w-full text-stone-950"
            />
        </div>

        <div class="w-full text-right mt-6">
            <x-button.primary wire:click="calculate">Calculate Wish Shards</x-button.primary>
        </div>
    </div>
    <div class="space-y-2 lg:ml-4 lg:mt-0 mt-8">
        <h3 class="mb-6">Wish Shards you will recieve</h3>
        <p class="ml-4">
            <span class="text-lg font-bold"> Minimum amount of Wish Shards: </span>
            <span class="ml-2">{{ $minimum }}</span>
        </p>
        <p class="ml-4">
            <span class="text-lg font-bold"> Maximum amount of Wish Shards: </span>
            <span class="ml-2">{{ $maximum }}</span>
        </p>
        <p class="ml-4">
            <span class="text-lg font-bold"> Average amount of Wish Shards: </span>
            <span class="ml-2">{{ $average }}</span>
        </p>
    </div>
</div>
