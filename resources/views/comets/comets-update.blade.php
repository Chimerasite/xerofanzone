<div class="lg:w-1/2 m-auto">
    @if( $config == 1 )
        <form wire:submit="addCometStats" class="px-6 pb-6">
            @csrf
            <div class="mt-6">
                <x-input.label for="comet" value="{{ __('Comet Cluster type') }}*" />

                <select wire:model.defer="comet" id="comet" name="comet" class="block w-full rounded-md border-0 shadow-sm ring-1 ring-inset ring-stone-400 focus:ring-2 focus:ring-inset focus:ring-teal-500 text-stone-950">
                    @foreach ($cometTypes as $cometType)
                        <option class="text-stone-950" value="{{ $cometType->id }}">{{ $cometType->name }}</option>
                    @endforeach
                </select>

                <x-input.label class="mt-2" for="amount" value="{{ __('Amount of Wish Shards') }}" />

                <x-input.text
                    wire:model="amount"
                    type="number"
                    name="amount"
                    id="amount"
                    class="w-full text-stone-950"
                    required
                />

                @if(! Auth::user())
                    <x-input.label class="mt-2" for="passcode">
                        {{ __('Passcode') }} <x-input.tip value="None logged in users can only upload data using the passcode. This can be found on the Project Xero Discord." />
                    </x-input.label>

                    <x-input.text
                        wire:model="passcode"
                        type="text"
                        name="passcode"
                        id="passcode"
                        class="w-full text-stone-950"
                    />
                @endif
            </div>

            <div class="mt-6 flex justify-end items-center">
                <div x-data="{ shown: false, timeout: null }"
                    x-init="@this.on('comets-added', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 2000); })"
                    x-show.transition.opacity.out.duration.1500ms="shown"
                    style="display: none;">
                    <div class="alert" id="success">
                        {{ __('Comet Cluster added succesfully.') }}
                    </div>
                </div>

                <div x-data="{ shown: false, timeout: null }"
                    x-init="@this.on('incorrect-password', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 2000); })"
                    x-show.transition.opacity.out.duration.1500ms="shown"
                    style="display: none;">
                    <div class="alert" id="error">
                        {{ __('Incorrect Passcode.') }}
                    </div>
                </div>

                <a href="{{ route('stats.comets') }}">
                    <x-button.secondary class="ml-3">
                        {{ __('Back') }}
                    </x-button.secondary>
                </a>

                <x-button.primary class="ml-3">
                    {{ __('Add') }}
                </x-button.primary>
            </div>
        </form>
    @elseif ( $config == 0 )
        <div class="mt-6 text-center font-bold text-xl">
            Comet Cluster uploads are currently closed
        </div>
    @endif
</div>
