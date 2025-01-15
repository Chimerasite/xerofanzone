<div class="w-full">
    <div class="flex flex-wrap justify-around md:space-x-4 w-full">
        <div class="space-y-2 md:w-1/3 w-full">
            <form wire:submit.prevent="updateItem" onkeydown="return event.key != 'Enter';" class="px-6 pb-6 space-y-2">
                @csrf
                <h4>Update Item</h4>
                <div>
                    <x-input.label for="itemId">
                        {{ __('Item') }}
                    </x-input.label>
                    <select wire:model.defer="itemId" wire:change="addValues" id="itemId" name="itemId" class="block w-full rounded-md border-0 shadow-sm ring-1 ring-inset ring-stone-400 focus:ring-2 focus:ring-inset focus:ring-teal-500 text-stone-950 cursor-pointer">
                        <option>Choose a item</option>
                        @foreach($items as $item)
                            <option class="text-stone-950" value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <x-input.label for="name">
                        {{ __('Name') }}
                    </x-input.label>
                    <x-input.text
                        wire:model="name"
                        type="text"
                        name="name"
                        id="name"
                        class="w-full text-stone-950"
                    />
                </div>
                <div>
                    <x-input.label for="value">
                        {{ __('Value') }}
                    </x-input.label>
                    <x-input.text
                        wire:model="value"
                        type="text"
                        name="value"
                        id="value"
                        class="w-full text-stone-950"
                    />
                </div>
                <div>
                    <x-input.label for="forageable">
                        {{ __('Forageable') }}
                    </x-input.label>
                    <select wire:model.defer="forageable" id="forageable" name="forageable" class="block w-full rounded-md border-0 shadow-sm ring-1 ring-inset ring-stone-400 focus:ring-2 focus:ring-inset focus:ring-teal-500 text-stone-950 cursor-pointer">
                        <option class="text-stone-950" value="1">yes</option>
                        <option class="text-stone-950" value="0">no</option>
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
            <form wire:submit.prevent="newItem" onkeydown="return event.key != 'Enter';" class="px-6 pb-6 space-y-2">
                @csrf
                <h4>New Item</h4>
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
                    <x-input.label for="newValue">
                        {{ __('Value') }}
                    </x-input.label>
                    <x-input.text
                        wire:model="newValue"
                        type="text"
                        name="newValue"
                        id="newValue"
                        class="w-full text-stone-950"
                    />
                </div>
                <div>
                    <x-input.label for="newForageable">
                        {{ __('Forageable') }}
                    </x-input.label>
                    <select wire:model.defer="newForageable" id="newForageable" name="newForageable" class="block w-full rounded-md border-0 shadow-sm ring-1 ring-inset ring-stone-400 focus:ring-2 focus:ring-inset focus:ring-teal-500 text-stone-950 cursor-pointer">
                        <option class="text-stone-950" value="1">yes</option>
                        <option class="text-stone-950" value="0">no</option>
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
            <th class="border-b border-x border-stone-900 text-center">Value</th>
            <th class="border-b border-x border-stone-900 text-center">Forageable</th>
        </tr>
        @foreach( $items as $item)
            <tr class="w-full {{ $loop->even ? 'bg-stone-300' : 'bg-stone-50'}}">
                <td class="border-b border-stone-900 text-center w-3/6">{{ $item->name }}</td>
                <td class="border-b border-x border-stone-900 text-center w-2/6">{{ $item->value }}</td>
                <td class="border-b border-x border-stone-900 text-center w-1/6">{{ $item->forageable == 1 ? 'yes' : 'no'}}</td>
            </tr>
        @endforeach
    </table>
</div>
