<div class="grow flex lg:flex-row flex-col text-stone-50 lg:space-x-6" x-data="{ open: false }">
    <!-- Primary subnav -->
    <div class="w-80 lg:flex hidden">
        <div class="bg-stone-600 w-full p-6 rounded-md">
            <h4 class="text-teal-500 uppercase text-center mb-4">{{ __('Lost Item Stats') }}</h4>
            <hr>
            <div class="space-y-2 mt-4">
                @if( $config == 1 )
                    <p>
                        <a href="{{ route('stats.lostItems-update') }}" class="hover:text-teal-500">
                            Add Lost Item Data <i class="fa-solid fa-plus fa-sm ml-1"></i>
                        </a>
                    </p>
                @elseif ( $config == 0 )
                    <p>
                        <i>Uploads are currently closed</i>
                    </p>
                @endif
                @if (Auth::user() && (Auth::user()->is_admin == 1 || $role == 1 ))
                    @if ($massedit)
                        <p>
                            <a href="{{ route('stats.lostItems') }}" class="hover:text-teal-500">
                                Close Mass Edit <i class="fa-solid fa-xmark fa-sm ml-1"></i>
                            </a>
                        </p>
                    @else
                        <p>
                            <a href="{{ route('stats.lostItems-edit') }}" class="hover:text-teal-500">
                                Mass Edit <i class="fa-solid fa-edit fa-sm ml-1"></i>
                            </a>
                        </p>
                    @endif
                @endif
            </div>
        </div>
    </div>
    <!-- Responsive subnav -->
    <div class="lg:hidden flex bg-stone-600">
        <!-- Hamburger -->
        <div class="flex items-center h-12 justify-start w-screen text-stone-50 px-4 z-30">
            <button @click="open = ! open" onclick="lockscroll()">
                <span :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex items-center px-4 py-2 border border-stone-50 rounded-md font-semibold text-xs text-stone-50 uppercase tracking-widest">Menu<i class="fa-solid fa-caret-right ml-1"></i></span>
                <span :class="{'hidden': ! open, 'inline-flex': open }" class="inline-flex items-center px-4 py-2 bg-teal-500 rounded-md font-semibold text-xs text-stone-50 uppercase tracking-widest">Menu<i class="fa-solid fa-caret-left ml-1"></i></span>
            </button>
        </div>
        <div x-cloak x-show="open" class="absolute z-20 flex flex-col justify-between w-screen h-screen bg-stone-600 text-white">
            <!-- Navigation Links -->
            <div class="flex flex-col space-y-3 mx-10 my-8">
                <h4 class="text-teal-500 uppercase text-center mb-4 mt-4">{{ __('Lost Item Stats') }}</h4>
                <hr>
                <div class="space-y-2 mt-4">
                    @if( $config == 1 )
                        <p>
                            <a href="{{ route('stats.lostItems-update') }}" class="hover:text-teal-500">
                                Add Lost Item Data <i class="fa-solid fa-plus fa-sm ml-1"></i>
                            </a>
                        </p>
                    @elseif ( $config == 0 )
                        <p>
                            <i>Uploads are currently closed</i>
                        </p>
                    @endif
                    @if (Auth::user() && Auth::user()->is_admin == 1)
                        @if ($massedit)
                            <p>
                                <a href="{{ route('stats.lostItems') }}" class="hover:text-teal-500">
                                    Close Mass Edit <i class="fa-solid fa-xmark fa-sm ml-1"></i>
                                </a>
                            </p>
                        @else
                            <p>
                                <a href="{{ route('stats.lostItems-edit') }}" class="hover:text-teal-500">
                                    Mass Edit <i class="fa-solid fa-edit fa-sm ml-1"></i>
                                </a>
                            </p>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="w-full lg:px-0 px-5 lg:my-0 my-6 text-stone-950">
        <div class="bg-stone-500 rounded-md p-6 grid xl:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-8 w-full h-full">
            @foreach($lostItemTypes as $lostItemType)
                @php
                    $count = 0;

                    foreach($lostItemStats->where('lost_item_id', $lostItemType->id) as $key){
                        $count = $count + $key->amount;
                    }
                @endphp
                <div class="col-span-1 my-4 rounded-md shadow-md px-2 py-4 bg-teal-500">
                    <div class="relative flex items-center pb-4">
                        <h4 class="text-center w-full text-stone-50">{{ $lostItemType->name }}</h4>
                        @if ($massedit)
                            <span data="" x-on:click.prevent="$dispatch('open-modal', 'add{{ $lostItemType->id }}')" class="absolute right-5">
                                <i class="fa-solid fa-circle-plus hover:text-stone-50"></i>
                            </span>
                        @endif
                    </div>
                    <table class="w-full">
                        @foreach ($lostItemStats->where('lost_item_id', $lostItemType->id) as $recievedItem)
                            <tr class="w-full {{ $loop->even ? 'bg-stone-50 bg-opacity-75' : 'bg-stone-50'}}">
                                <td class="border-b border-stone-900 pl-2 w-6/12">{{ $recievedItem->item->name }}</td>
                                <td class="border-b border-x border-stone-900 text-center w-2/12">{{ $recievedItem->amount }}</td>
                                <td class="border-b border-stone-900 text-center w-2/12">
                                    @if(!$count == 0)
                                        {{ round($recievedItem->amount/$count * 100) }}%
                                    @endif
                                </td>
                                @if ($massedit)
                                    <td class="w-2/12 text-center space-x-2 bg-teal-500">
                                        <span wire:click="add({{ $recievedItem }})"><i class="fa-solid fa-circle-plus hover:text-green-600"></i></span>
                                        <span wire:click="substract({{ $recievedItem }})"><i class="fa-solid fa-circle-minus hover:text-red-600"></i></span>
                                        <span x-data="" x-on:click.prevent="$dispatch('open-modal', 'delete{{ $recievedItem->id }}')"><i class="fa-solid fa-circle-xmark hover:text-red-800"></i></span>
                                    </td>
                                @endif
                            </tr>
                            <!-- Remove item from lost item modal -->
                            <x-modal name="delete{{ $recievedItem->id }}">
                                <div class="bg-red-600 text-white text-xl h-12 flex items-center justify-center">
                                    Delete
                                </div>
                                <div class="mt-6 text-center">
                                    {{ __('Remove') }} {{ $recievedItem->item->name }} {{ __('form the') }} {{ $lostItemType->name }}?
                                </div>
                                <div class="my-6 mx-6 flex justify-end">
                                    <x-button.secondary x-on:click="$dispatch('close')">
                                        {{ __('Cancel') }}
                                    </x-button.secondary>

                                    <x-button.danger wire:click="delete({{ $recievedItem }})" x-on:click="$dispatch('close')" class="ml-3">
                                        {{ __('Delete') }}
                                    </x-button.danger>
                                </div>
                            </x-modal>
                        @endforeach
                        <tr class="h-2">
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="border-t border-gray-900 pl-2">Total Opened</td>
                            <td class="border-t border-x border-gray-900 text-center"> {{ $count }} </td>
                            <td class="border-t border-gray-900"></td>
                        </tr>
                    </table>
                </div>

                <!-- Add item to lost item modal -->
                <x-modal name="add{{ $lostItemType->id }}">
                    @php
                        $exist = [];
                        foreach($lostItemStats->where('lost_item_id', $lostItemType->id) as $forage) {
                            array_push($exist, $recievedItem->item->id);
                        }
                    @endphp

                    <div class="text-xl h-12 flex items-center justify-center">
                        {{ __('Add Item') }}
                    </div>
                    <form wire:submit="addItem({{ $lostItemType->id }})" class="px-6 pb-6">
                        @csrf
                        <div class="mt-6">
                            <x-input.label for="name" value="{{ __('Name') }}"/>

                            <div class="flex">
                                <select wire:model.defer="id" id="name" name="name" class="block w-full rounded border-0 shadow-sm ring-1 ring-inset ring-slate-400 focus:ring-2 focus:ring-inset focus:ring-midnight-500">
                                    @foreach ($items->whereNotIn('id', $exist) as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
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
                </x-modal>
            @endforeach
        </div>
    </div>
</div>
