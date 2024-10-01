<div class="lg:w-1/2 m-auto">
    <form wire:submit="createPost" class="px-6 pb-6">
        @csrf
        <div class="mt-6">
            <x-input.label for="name" value="{{ __('Name') }}*" />
            <x-input.text
                wire:model="amount"
                type="number"
                name="amount"
                id="amount"
                class="w-full text-stone-950"
                required
            />
        </div>

        <div class="mt-6 flex justify-end items-center">
            <a href="{{ route('fancreations') }}">
                <x-button.secondary class="ml-3">
                    {{ __('Back') }}
                </x-button.secondary>
            </a>

            <x-button.primary class="ml-3">
                {{ __('Add') }}
            </x-button.primary>
        </div>
    </form>
</div>

