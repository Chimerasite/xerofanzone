<div class="w-full">
    <div class="flex flex-wrap justify-around space-x-4 w-full">
        <div class="space-y-2 w-1/3">
            <form wire:submit.prevent="updateLocation" onkeydown="return event.key != 'Enter';" class="px-6 pb-6 space-y-2">
                @csrf
                <h4>Update Location</h4>
                <div>
                    <x-input.label for="locationId">
                        {{ __('Location') }}
                    </x-input.label>
                    <select wire:model.defer="locationId" wire:change="addValues" id="locationId" name="locationId" class="block w-full rounded-md border-0 shadow-sm ring-1 ring-inset ring-stone-400 focus:ring-2 focus:ring-inset focus:ring-teal-500 text-stone-950 cursor-pointer">
                        <option>Choose a location</option>
                        @foreach($locations as $location)
                            <option class="text-stone-950" value="{{ $location->id }}">{{ $location->name }}</option>
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
                    <x-input.label for="link">
                        {{ __('Link') }}
                    </x-input.label>
                    <x-input.text
                        wire:model="link"
                        type="text"
                        name="link"
                        id="link"
                        class="w-full text-stone-950"
                    />
                </div>
                <div>
                    <x-input.label for="type">
                        {{ __('Type') }}
                    </x-input.label>
                    <x-input.text
                        wire:model="type"
                        type="text"
                        name="type"
                        id="type"
                        class="w-full text-stone-950"
                    />
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
        <div class="space-y-2 w-1/3">
            <form wire:submit.prevent="newLocation" onkeydown="return event.key != 'Enter';" class="px-6 pb-6 space-y-2">
                @csrf
                <h4>New Location</h4>
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
                    <x-input.label for="newLink">
                        {{ __('Link') }}
                    </x-input.label>
                    <x-input.text
                        wire:model="newLink"
                        type="text"
                        name="newLink"
                        id="newLink"
                        class="w-full text-stone-950"
                    />
                </div>
                <div>
                    <x-input.label for="newType">
                        {{ __('Type') }}
                    </x-input.label>
                    <x-input.text
                        wire:model="newType"
                        type="text"
                        name="newType"
                        id="newType"
                        class="w-full text-stone-950"
                    />
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
    <table class="w-2/3 m-auto text-stone-900 mt-8">
        <tr class="bg-teal-500 text-stone-50">
            <th class="border-b border-stone-900 pl-2 w-4/12">Name</th>
            <th class="border-b border-x border-stone-900 text-center w-4/12">Link</th>
            <th class="border-b border-x border-stone-900 text-center w-2/12">Type</th>
        </tr>
        @foreach( $locations as $location)
            <tr class="w-full {{ $loop->even ? 'bg-stone-300' : 'bg-stone-50'}}">
                <td class="border-b border-stone-900 text-center w-4/12">{{ $location->name }}</td>
                <td class="border-b border-x border-stone-900 text-center w-4/12"><a href="{{ $location->link }}" class="hover:underline">{{ $location->link }}</a></td>
                <td class="border-b border-x border-stone-900 text-center w-2/12">{{ $location->type }}</td>
            </tr>
        @endforeach
    </table>
</div>
