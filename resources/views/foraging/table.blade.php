<x-slot:subnav>
    <h2 class="text-teal-500 uppercase text-center text-lg mb-4">{{ __('Foraging Stats') }}</h2>
    <div class="w-full space-y-2 mb-4">
        <div>
            @php
                $total = 0;

                foreach($forages as $key){
                    $total = $total + $key->amount;
                }
            @endphp

            <h4>Total Forages: </h4>
            <p class="text-center text-lg font-bold"> {{ $total }} </p>
        </div>
        <div>
            <h4>Latest Update: </h4>
            <p class="text-center text-lg font-bold">{{ $updated ? $updated->diffForHumans() : ''}}</p>
        </div>
        <div>
            <h4>Highest Average Value: </h4>
            <p class="text-center text-lg font-bold">{{ $bestVal }}</p>
        </div>
    </div>
    <hr>
    @if (Auth::user())
        <div class="space-x-3 text-xl mt-4">
            <a href="{{ route('stats.foraging-add') }}">
                <i class="fa-solid fa-circle-plus hover:text-baby-300"></i>
            </a>
            @if (Auth::user() && Auth::user()->is_admin == 1)
                <a href="{{ route('stats.foraging-edit') }}">
                    <i class="fa-solid fa-edit hover:text-baby-300"></i>
                </a>
            @endif
        </div>
    @else
        <div class="mt-4">
            Please Login to add data.
        </div>
    @endif
</x-slot>

<div class="text-stone-950">
    @if ($massedit)
        <div class="text-right space-x-4 mb-6">
            <x-button.primary data="" x-on:click.prevent="$dispatch('open-modal', 'newLocation')">
                {{ __('Create Location') }}
            </x-button.primary>
            <x-button.primary data="" x-on:click.prevent="$dispatch('open-modal', 'createItem')">
                {{ __('Create Item') }}
            </x-button.primary>
        </div>
    @endif
    <div class="grid xl:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-8 w-full">
        @foreach($locations as $location)
            @php
                $count = 0;
                $eventShow = '';

                foreach($forages->where('foraging_location_id', $location->id) as $key){
                    $count = $count + $key->amount;
                }

                if($location->type == 'Event'){
                    $today = date('m-d');
                    $start = substr($location->start_date, 5);
                    $end = substr($location->end_date, 5);

                    if(($today >= $start) && ($today <= $end)){
                        $eventShow = true;
                    } else {
                        $eventShow = false;
                    }
                }
            @endphp
            @if(($massedit) || (in_array($location->type, ['Standard', 'Monthly']) || ($location->type == 'event' && $eventShow == true)))
                <div class="col-span-1 my-4 rounded-md shadow-md px-2 py-4" style="background-color: {{ $location->color }}">
                    <div class="relative flex items-center pb-4">
                        <h4 class="text-lg text-center w-full font-semibold text-white">{{ $location->name }}</h4>
                        @if ($massedit)
                            <span data="" x-on:click.prevent="$dispatch('open-modal', 'add{{ $location->id }}')" class="absolute right-5">
                                <i class="fa-solid fa-circle-plus hover:text-white"></i>
                            </span>
                        @endif
                    </div>
                    <table class="w-full">
                        @foreach($forages->where('foraging_location_id', $location->id) as $forage)
                            <tr class="w-full {{ $loop->even ? 'bg-white bg-opacity-75' : 'bg-white'}}">
                                <td class="border-b border-gray-900 pl-2 w-6/12">{{ $forage->item->name }}</td>
                                <td class="border-b border-x border-gray-900 text-center w-2/12">{{ $forage->amount }}</td>
                                <td class="border-b border-gray-900 text-center w-2/12">
                                    @if(!$count == 0)
                                        {{ round($forage->amount/$count * 100) }}%
                                    @endif
                                </td>
                                @if ($massedit)
                                    <td class="w-2/12 text-center space-x-2" style="background-color: {{ $location->color }}">
                                        <span wire:click="add({{ $forage }})"><i class="fa-solid fa-circle-plus hover:text-green-600"></i></span>
                                        <span wire:click="substract({{ $forage }})"><i class="fa-solid fa-circle-minus hover:text-red-600"></i></span>
                                        <span x-data="" x-on:click.prevent="$dispatch('open-modal', 'delete{{ $forage->id }}')"><i class="fa-solid fa-circle-xmark hover:text-red-800"></i></span>
                                    </td>
                                @endif
                            </tr>
                            {{-- <x-modal name="delete{{ $forage->id }}">
                                <div class="bg-red-600 text-white text-xl h-12 flex items-center justify-center">
                                    Delete
                                </div>
                                <div class="mt-6 text-center">
                                    {{ __('Remove') }} {{ $forage->forageable->name }} {{ __('form the') }} {{ $location->name }}?
                                </div>
                                <div class="my-6 mx-6 flex justify-end">
                                    <x-button.secondary x-on:click="$dispatch('close')">
                                        {{ __('Cancel') }}
                                    </x-button.secondary>

                                    <x-button.danger wire:click="delete({{ $forage }})" x-on:click="$dispatch('close')" class="ml-3">
                                        {{ __('Delete') }}
                                    </x-button.danger>
                                </div>
                            </x-modal> --}}
                        @endforeach
                        <tr class="h-2">
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="border-t border-gray-900 pl-2">Total Forages</td>
                            <td class="border-t border-x border-gray-900 text-center">{{ $count }}</td>
                            <td class="border-t border-gray-900"></td>
                        </tr>
                    </table>
                </div>
            @endif

            {{-- Add item to location modal --}}
            {{-- <x-modal name="add{{ $location->id }}">
                @php
                    $exist = [];
                    foreach($forages->where('foraging_location_id', $location->id) as $forage) {
                        array_push($exist, $forage->forageable->id);
                    }
                @endphp

                <div class="text-xl h-12 flex items-center justify-center">
                    {{ __('Add Item') }}
                </div>
                <form wire:submit="addItem({{ $location->id }})" class="px-6 pb-6">
                    @csrf
                    <div class="mt-6">
                        <x-input.label for="name" value="{{ __('Name') }}"/>

                        <div class="flex">
                            <select wire:model.defer="id" id="name" name="name" class="block w-full rounded border-0 shadow-sm ring-1 ring-inset ring-slate-400 focus:ring-2 focus:ring-inset focus:ring-midnight-500">
                                @foreach ($forageables->whereNotIn('id', $exist) as $forageable)
                                    <option value="{{ $forageable->id }}">{{ $forageable->name }}</option>
                                @endforeach
                            </select>
                            <button data="" x-on:click.prevent="$dispatch('open-modal', 'createItem')" class="ml-2 w-12 block rounded border-0 shadow-sm ring-1 ring-inset ring-slate-400 focus:ring-2 focus:ring-inset focus:ring-midnight-500">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-button.secondary x-on:click="$dispatch('close')">
                            {{ __('Cancel') }}
                        </x-button.secondary>

                        <x-button.primary class="ml-3" x-on:click="$dispatch('close')">
                            {{ __('Add') }}
                        </x-button.primary>
                    </div>
                </form>
            </x-modal> --}}
        @endforeach
    </div>

    {{-- Create new location modal --}}
    {{-- <x-modal name="newLocation">
        <div class="text-xl h-12 flex items-center justify-center">
            {{ __('New Location') }}
        </div>
        <form wire:submit="newLocation" class="px-6 pb-6">
            @csrf
            <div class="mt-6">
                <x-input.label class="mt-2" for="name" value="{{ __('Name') }}*" />

                <x-input.text
                    wire:model="name"
                    type="text"
                    name="name"
                    id="name"
                    class="w-1/2"
                />
                <x-input.label class="mt-2" for="type" value="{{ __('Type') }}*" />

                <x-input.text
                    wire:model="type"
                    type="text"
                    name="type"
                    id="type"
                    class="w-1/2"
                />

                <x-input.label class="mt-2" for="start" value="{{ __('Start Date') }}*" />

                <x-input.text
                    wire:model="start"
                    type="date"
                    name="start"
                    id="start"
                    class="w-1/2"
                />

                <x-input.label class="mt-2" for="end" value="{{ __('End Date') }}*" />

                <x-input.text
                    wire:model="end"
                    type="date"
                    name="end"
                    id="end"
                    class="w-1/2"
                />

                <x-input.label class="mt-2" for="color" color="{{ __('Color') }}" />

                <x-input.text
                    wire:model="color"
                    type="color"
                    name="color"
                    id="color"
                    class="w-1/2 h-12"
                />
            </div>

            <div class="mt-6 flex justify-end">
                <x-button.secondary x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-button.secondary>

                <x-button.primary class="ml-3" x-on:click="$dispatch('close')">
                    {{ __('Create') }}
                </x-button.primary>
            </div>
        </form>
    </x-modal> --}}

    {{-- Create new item modal --}}
    {{-- <x-modal name="createItem">
        <div class="text-xl h-12 flex items-center justify-center">
            {{ __('Create Item') }}
        </div>
        <form wire:submit="createItem" class="px-6 pb-6">
            @csrf
            <div class="mt-6">
                <x-input.label for="name" value="{{ __('Name') }}*" />

                <x-input.text
                    wire:model="name"
                    type="text"
                    name="name"
                    id="name"
                    class="w-1/2"
                />

                <x-input.label class="mt-2" for="value" value="{{ __('Prestige Value') }}" />

                <x-input.text
                    wire:model="value"
                    type="number"
                    name="value"
                    id="value"
                    class="w-1/2"
                />
            </div>

            <div class="mt-6 flex justify-end">
                <x-button.secondary x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-button.secondary>

                <x-button.primary class="ml-3" x-on:click="$dispatch('close')">
                    {{ __('Create') }}
                </x-button.primary>
            </div>
        </form>
    </x-modal> --}}
</div>
