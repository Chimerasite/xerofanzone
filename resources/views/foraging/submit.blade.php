<div class="lg:w-1/2 m-auto">
    <form wire:submit="addItems" class="px-6 pb-6">
        @csrf
        <div class="mt-6">
            <x-input.label for="location" value="{{ __('Location') }}*" />

            <select wire:model.defer="location" id="location" name="location" class="block w-full rounded-md border-0 shadow-sm ring-1 ring-inset ring-stone-400 focus:ring-2 focus:ring-inset focus:ring-teal-500 text-stone-950">
                @foreach ($locations as $location)
                    <option class="text-stone-950" value="{{ $location->id }}">{{ $location->name }}</option>
                @endforeach
            </select>

            <x-input.label class="mt-2" for="forageable" value="{{ __('Item') }}*" />

            <select wire:model.defer="forageable" id="forageable" name="forageable" class="block w-full rounded-md border-0 shadow-sm ring-1 ring-inset ring-stone-400 focus:ring-2 focus:ring-inset focus:ring-teal-500 text-stone-950">
                @foreach ($forageables as $forageable)
                    <option class="text-stone-950" value="{{ $forageable->id }}">{{ $forageable->name }}</option>
                @endforeach
            </select>

            <x-input.label class="mt-2" for="amount" value="{{ __('Amount') }}" />
            {{-- <span>*When foraging Astatine or Prestige, select the right amount in the Item tab. Do not put the amount here! </span> --}}

                <x-input.text
                    wire:model="amount"
                    type="number"
                    name="amount"
                    id="amount"
                    class="w-full text-stone-950"
                />
        </div>

        <div class="mt-6 flex justify-end items-center">
            @if (session()->has('message'))
                <div x-data="{show: true}" x-init="setTimeout(() => show = false, 1000)" x-show="show">
                    <div class="alert alert-success" onload="timeout()" id="success">
                        {{ session('message') }}
                    </div>
                </div>
            @endif
            <a href="{{ route('stats.foraging') }}">
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
