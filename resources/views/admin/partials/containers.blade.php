<div class="w-full">
    <div class="flex flex-wrap justify-around md:space-x-4 w-full">
        <div class="space-y-2 md:w-1/3 w-full">
            <form wire:submit.prevent="updateContainer" onkeydown="return event.key != 'Enter';" class="px-6 pb-6 space-y-2">
                @csrf
                <h4>Update Container</h4>
                <div>
                    <x-input.label for="containerId">
                        {{ __('Container') }}
                    </x-input.label>
                    <select wire:model.defer="containerId" wire:change="addValues" id="containerId" name="containerId" class="block w-full rounded-md border-0 shadow-sm ring-1 ring-inset ring-stone-400 focus:ring-2 focus:ring-inset focus:ring-teal-500 text-stone-950 cursor-pointer">
                        <option>Choose a container</option>
                        @foreach($containers as $container)
                            <option class="text-stone-950" value="{{ $container->id }}">{{ $container->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <x-input.label for="itemId">
                        {{ __('Linked Item') }}
                    </x-input.label>
                    <select wire:model.defer="itemId" id="itemId" name="itemId" class="block w-full rounded-md border-0 shadow-sm ring-1 ring-inset ring-stone-400 focus:ring-2 focus:ring-inset focus:ring-teal-500 text-stone-950 cursor-pointer">
                        <option value="null">-- None --</option>
                        @foreach($items as $item)
                            <option class="text-stone-950" value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <x-input.label for="type">
                        {{ __('Type') }}
                    </x-input.label>
                    <select wire:model.defer="type" id="type" name="type" class="block w-full rounded-md border-0 shadow-sm ring-1 ring-inset ring-stone-400 focus:ring-2 focus:ring-inset focus:ring-teal-500 text-stone-950 cursor-pointer">
                        <option class="text-stone-950" value="items">Items</option>
                        <option class="text-stone-950" value="currency">Currency</option>
                    </select>
                </div>
                <div>
                    <x-input.label for="split">
                        {{ __('Splits') }}
                    </x-input.label>
                    <x-input.text
                        wire:model="split"
                        type="text"
                        name="split"
                        id="split"
                        class="w-full text-stone-950"
                    />
                </div>
                <div>
                    <x-input.label for="active">
                        {{ __('Active') }}
                    </x-input.label>
                    <select wire:model.defer="active" id="active" name="active" class="block w-full rounded-md border-0 shadow-sm ring-1 ring-inset ring-stone-400 focus:ring-2 focus:ring-inset focus:ring-teal-500 text-stone-950 cursor-pointer">
                        <option class="text-stone-950" value="1">Yes</option>
                        <option class="text-stone-950" value="0">No</option>
                    </select>
                </div>

                <div class="mt-6 flex justify-end items-center">
                    @if (session()->has('updateMessage'))
                        <div x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show">
                            <div class="alert alert-success text-green-500 font-bold bg-stone-100 py-1 px-4 rounded-md" onload="timeout()" id="success">
                                {{ session('updateMessage') }}
                            </div>
                        </div>
                    @endif
                    @if (session()->has('updateErrorMessage'))
                        <div x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show">
                            <div class="alert alert-error text-red-600 font-bold bg-stone-100 py-1 px-4 rounded-md" onload="timeout()" id="error">
                                {{ session('updateErrorMessage') }}
                            </div>
                        </div>
                    @endif

                    <x-button.primary class="ml-3">
                        {{ __('Update') }}
                    </x-button.primary>
                </div>
            </form>
        </div>
        <div class="space-y-2 md:w-1/3 w-full">
            <form wire:submit.prevent="newContainer" onkeydown="return event.key != 'Enter';" class="px-6 pb-6 space-y-2">
                @csrf
                <h4>New Container</h4>
                <div>
                    <x-input.label for="newName">
                        {{ __('Name') }}
                    </x-input.label>
                    <x-input.text
                        wire:model="newName"
                        type="text"
                        name="newName"
                        id="newName"
                        class="w-full text-stone-950"
                    />
                </div>
                <div>
                    <x-input.label for="newItemId">
                        {{ __('Linked Item') }}
                    </x-input.label>
                    <select wire:model.defer="newItemId" id="newItemId" name="newItemId" class="block w-full rounded-md border-0 shadow-sm ring-1 ring-inset ring-stone-400 focus:ring-2 focus:ring-inset focus:ring-teal-500 text-stone-950 cursor-pointer">
                        <option value="null">-- None --</option>
                        @foreach($items as $item)
                            <option class="text-stone-950" value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <x-input.label for="newType">
                        {{ __('Type') }}
                    </x-input.label>
                    <select wire:model.defer="newType" id="newType" name="newType" class="block w-full rounded-md border-0 shadow-sm ring-1 ring-inset ring-stone-400 focus:ring-2 focus:ring-inset focus:ring-teal-500 text-stone-950 cursor-pointer">
                        <option class="text-stone-950" value="items">Items</option>
                        <option class="text-stone-950" value="currency">Currency</option>
                    </select>
                </div>
                <div>
                    <x-input.label for="newSplit">
                        {{ __('Splits') }}
                    </x-input.label>
                    <x-input.text
                        wire:model="newSplit"
                        type="text"
                        name="newSplit"
                        id="newSplit"
                        class="w-full text-stone-950"
                    />
                </div>
                <div>
                    <x-input.label for="newActive">
                        {{ __('Active') }}
                    </x-input.label>
                    <select wire:model.defer="newActive" id="newActive" name="newActive" class="block w-full rounded-md border-0 shadow-sm ring-1 ring-inset ring-stone-400 focus:ring-2 focus:ring-inset focus:ring-teal-500 text-stone-950 cursor-pointer">
                        <option class="text-stone-950" value="1">Yes</option>
                        <option class="text-stone-950" value="0">No</option>
                    </select>
                </div>

                <div class="mt-6 flex justify-end items-center">
                    @if (session()->has('newMessage'))
                        <div x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show">
                            <div class="alert alert-success text-green-500 font-bold bg-stone-100 py-1 px-4 rounded-md" onload="timeout()" id="success">
                                {{ session('newMessage') }}
                            </div>
                        </div>
                    @endif
                    @if (session()->has('newErrorMessage'))
                        <div x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show">
                            <div class="alert alert-error text-red-600 font-bold bg-stone-100 py-1 px-4 rounded-md" onload="timeout()" id="error">
                                {{ session('newErrorMessage') }}
                            </div>
                        </div>
                    @endif

                    <x-button.primary class="ml-3">
                        {{ __('Create') }}
                    </x-button.primary>
                </div>
            </form>
        </div>
    </div>
    <table class="md:w-2/3 w-full m-auto text-stone-900 mt-8">
        <tr class="bg-teal-500 text-stone-50">
            <th class="border-b border-stone-900 pl-2">Name</th>
            <th class="border-b border-x border-stone-900 text-center">Linked Item</th>
            <th class="border-b border-x border-stone-900 text-center">Type</th>
            <th class="border-b border-x border-stone-900 text-center">Splits</th>
            <th class="border-b border-x border-stone-900 text-center">Active</th>
        </tr>
        @foreach( $containers as $container)
            @php
                if($container->splits == null) {
                    $container->splits = [];
                }
            @endphp
            <tr class="w-full {{ $loop->even ? 'bg-stone-300' : 'bg-stone-50'}}">
                <td class="border-b border-stone-900 text-center w-2/6">{{ $container->name }}</td>
                <td class="border-b border-x border-stone-900 text-center w-1/6">{{ $container->item->name ?? ''}}</td>
                <td class="border-b border-x border-stone-900 text-center w-1/6">{{ $container->type}}</td>
                <th class="border-b border-x border-stone-900 text-center w-1/6"">{{ implode(", ", $container->splits) ?? ''}}</th>
                <td class="border-b border-x border-stone-900 text-center w-1/6">{{ $container->active == 1 ? 'yes' : 'no'}}</td>
            </tr>
        @endforeach
    </table>
</div>
