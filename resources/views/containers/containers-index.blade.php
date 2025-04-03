<div class="grow flex lg:flex-row flex-col text-stone-50 lg:space-x-6" x-data="{ open: false }">
    <!-- Primary subnav -->
    <div class="w-80 lg:flex hidden">
        <div class="bg-stone-600 w-full p-6 rounded-md">
            <h4 class="text-teal-500 uppercase text-center mb-4">{{ __('Container Stats') }}</h4>
            <hr>
            <div class="space-y-2 mt-4">
                @if( $config == 1 )
                    <p>
                        <a href="{{ route('stats.containers-update') }}" class="hover:text-teal-500">
                            Add Container Data <i class="fa-solid fa-plus fa-sm ml-1"></i>
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
                            <a href="{{ route('stats.containers') }}" class="hover:text-teal-500">
                                Close Mass Edit <i class="fa-solid fa-xmark fa-sm ml-1"></i>
                            </a>
                        </p>
                        <p>
                            <x-button.inline data="" x-on:click.prevent="$dispatch('open-modal', 'newContainer')">
                                {{ __('Create Container') }} <i class="fa-solid fa-box-open fa-sm ml-1"></i>
                            </x-button.inline>
                        </p>
                    @else
                        <p>
                            <a href="{{ route('stats.containers-edit') }}" class="hover:text-teal-500">
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
                <h4 class="text-teal-500 uppercase text-center mb-4 mt-4">{{ __('Container Stats') }}</h4>
                <hr>
                <div class="space-y-2 mt-4">
                    @if( $config == 1 )
                        <p>
                            <a href="{{ route('stats.containers-update') }}" class="hover:text-teal-500">
                                Add Container Data <i class="fa-solid fa-plus fa-sm ml-1"></i>
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
                                <a href="{{ route('stats.containers') }}" class="hover:text-teal-500">
                                    Close Mass Edit <i class="fa-solid fa-xmark fa-sm ml-1"></i>
                                </a>
                            </p>
                            <p>
                                <x-button.inline data="" x-on:click.prevent="$dispatch('open-modal', 'newContainer')">
                                    {{ __('Create Container') }} <i class="fa-solid fa-box-open fa-sm ml-1"></i>
                                </x-button.inline>
                            </p>
                        @else
                            <p>
                                <a href="{{ route('stats.containers-edit') }}" class="hover:text-teal-500">
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
            @foreach($containers as $container)
                <div class="col-span-1 my-4 rounded-md shadow-md px-2 py-4 bg-teal-500">
                    <div class="relative flex items-center pb-4">
                        <h4 class="text-center w-full text-stone-50">{{ $container->name }}</h4>
                        @if ($massedit)
                            @if ($container->type == 'items')
                                <span data="" x-on:click.prevent="$dispatch('open-modal', 'add{{ $container->id }}')" class="absolute right-5">
                                    <i class="fa-solid fa-circle-plus hover:text-stone-50"></i>
                                </span>
                            @endif
                            <span x-data="" x-on:click.prevent="$dispatch('open-modal', 'deleteContainer{{ $container->id }}')">
                                <i class="fa-solid fa-circle-xmark hover:text-red-800"></i>
                            </span>
                            <!-- Remove location modal -->
                            <x-modal name="deleteContainer{{ $container->id }}">
                                <div class="bg-red-600 text-white text-xl h-12 flex items-center justify-center">
                                    Delete
                                </div>
                                <div class="mt-6 text-center">
                                    {{ __('Remove') }} {{ $container->name }}?
                                </div>
                                <div class="my-6 mx-6 flex justify-end">
                                    <x-button.secondary x-on:click="$dispatch('close')">
                                        {{ __('Cancel') }}
                                    </x-button.secondary>

                                    <x-button.danger wire:click="deleteContainer({{ $container }})" x-on:click="$dispatch('close')" class="ml-3">
                                        {{ __('Delete') }}
                                    </x-button.danger>
                                </div>
                            </x-modal>
                        @endif
                    </div>
                    <table class="w-full">
                        @if($container->type == 'items')
                            @php
                                $total = 0;

                                $itemStatList = [];
                                $keylist = [];

                                if($container->splits != null) {
                                    foreach($container->splits as $key) {
                                        $partial = App\Models\ItemContainerStats::whereHas('item', function($query) use ($key) {
                                                    $query->where('name', 'like', '%' . $key . '%');
                                                })->get();

                                        array_push($itemStatList, $partial);
                                        array_push($keylist, $key);
                                    }
                                }

                                $final = $itemStats->whereHas('item', function($query) use ($keylist) {
                                    foreach($keylist as $item) {
                                        $query->whereNot('name', 'like', '%' . $item . '%');
                                    }
                                })->get()->sortBy('item.name');

                                array_push($itemStatList, $final);
                            @endphp

                            @foreach($itemStatList as $splitGroup)
                                @php
                                    $total = 0;

                                    foreach($splitGroup as $key) {
                                        $total = $total + $key->amount;
                                    }
                                @endphp
                                @foreach($splitGroup as $loot)
                                    <tr class="w-full {{ $loop->even ? 'bg-stone-50 bg-opacity-75' : 'bg-stone-50'}}">
                                        <td class="border-b border-stone-900 pl-2 w-6/12">{{ $loot->item->name }}</td>
                                        <td class="border-b border-x border-stone-900 text-center w-2/12">{{ $loot->amount }}</td>
                                        <td class="border-b border-stone-900 text-center w-2/12">
                                            @if(!$total == 0)
                                                {{ round($loot->amount/$total * 100) }}%
                                            @endif
                                        </td>
                                        @if ($massedit)
                                            <td class="w-2/12 text-center space-x-2 bg-teal-500">
                                                <span wire:click="add({{ $loot }})"><i class="fa-solid fa-circle-plus hover:text-green-600"></i></span>
                                                <span wire:click="substract({{ $loot }})"><i class="fa-solid fa-circle-minus hover:text-red-600"></i></span>
                                                <span x-data="" x-on:click.prevent="$dispatch('open-modal', 'deleteLoot{{ $loot->id }}')"><i class="fa-solid fa-circle-xmark hover:text-red-800"></i></span>
                                            </td>
                                        @endif
                                    </tr>
                                    <!-- Remove item from location modal -->
                                    <x-modal name="deleteLoot{{ $loot->id }}">
                                        <div class="bg-red-600 text-white text-xl h-12 flex items-center justify-center">
                                            Delete
                                        </div>
                                        <div class="mt-6 text-center">
                                            {{ __('Remove') }} {{ $loot->item->name }} {{ __('form the') }} {{ $container->name }}?
                                        </div>
                                        <div class="my-6 mx-6 flex justify-end">
                                            <x-button.secondary x-on:click="$dispatch('close')">
                                                {{ __('Cancel') }}
                                            </x-button.secondary>

                                            <x-button.danger wire:click="delete({{ $loot }})" x-on:click="$dispatch('close')" class="ml-3">
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
                            @endforeach

                            {{-- @foreach ( $itemStatList as $loot)
                                <tr class="w-full {{ $loop->even ? 'bg-stone-50 bg-opacity-75' : 'bg-stone-50'}}">
                                    <td class="border-b border-stone-900 pl-2 w-6/12">{{ $loot->item->name }}</td>
                                    <td class="border-b border-x border-stone-900 text-center w-2/12">{{ $loot->amount }}</td>
                                    <td class="border-b border-stone-900 text-center w-2/12">
                                        @if(!$total == 0)
                                            {{ round($loot->amount/$total * 100) }}%
                                        @endif
                                    </td>
                                    @if ($massedit)
                                        <td class="w-2/12 text-center space-x-2 bg-teal-500">
                                            <span wire:click="add({{ $loot }})"><i class="fa-solid fa-circle-plus hover:text-green-600"></i></span>
                                            <span wire:click="substract({{ $loot }})"><i class="fa-solid fa-circle-minus hover:text-red-600"></i></span>
                                            <span x-data="" x-on:click.prevent="$dispatch('open-modal', 'deleteLoot{{ $loot->id }}')"><i class="fa-solid fa-circle-xmark hover:text-red-800"></i></span>
                                        </td>
                                    @endif
                                </tr>
                                <!-- Remove item from location modal -->
                                <x-modal name="deleteLoot{{ $loot->id }}">
                                    <div class="bg-red-600 text-white text-xl h-12 flex items-center justify-center">
                                        Delete
                                    </div>
                                    <div class="mt-6 text-center">
                                        {{ __('Remove') }} {{ $loot->item->name }} {{ __('form the') }} {{ $container->name }}?
                                    </div>
                                    <div class="my-6 mx-6 flex justify-end">
                                        <x-button.secondary x-on:click="$dispatch('close')">
                                            {{ __('Cancel') }}
                                        </x-button.secondary>

                                        <x-button.danger wire:click="delete({{ $loot }})" x-on:click="$dispatch('close')" class="ml-3">
                                            {{ __('Delete') }}
                                        </x-button.danger>
                                    </div>
                                </x-modal>
                                @if($loop->iteration == $split)
                                    <tr class="h-1">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endif
                            @endforeach --}}
                        @elseif($container->type == 'currency')
                            @php
                                $min; $max; $total;

                                if($currencyStats->where('container_id', $container->id)->first() != null) {
                                    $min = $currencyStats->where('container_id', $container->id)->sortby('amount')->first()->amount;
                                    $max = $currencyStats->where('container_id', $container->id)->sortbydesc('amount')->first()->amount;

                                    $total = count($currencyStats->where('container_id', $container->id));

                                    $calc = 0;
                                    foreach($currencyStats->where('container_id', $container->id) as $key){
                                        $calc = $calc + $key->amount;
                                    }

                                    $avarage = round($calc / $total);
                                }
                            @endphp

                            <tr class="w-full bg-stone-50">
                                <td class="border-b border-stone-900 pl-2 w-2/3">{{ __('Minimum') }}</td>
                                <td class="border-b border-x border-stone-900 text-center w-1/3"> {{ $min ?? '' }} </td>
                            </tr>
                            <tr class="w-full bg-stone-50 bg-opacity-75">
                                <td class="border-b border-stone-900 pl-2 w-2/3">{{ __('Maximum') }}</td>
                                <td class="border-b border-x border-stone-900 text-center w-1/3"> {{ $max ?? '' }} </td>
                            </tr>
                            <tr class="w-full bg-stone-50">
                                <td class="border-b border-stone-900 pl-2 w-2/3">{{ __('Average') }}</td>
                                <td class="border-b border-x border-stone-900 text-center w-1/3"> {{ $avarage ?? '' }} </td>
                            </tr>
                            <tr class="h-2">
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endif
                        <tr class="bg-white">
                            <td class="border-t border-gray-900 pl-2">Total Opened</td>
                            <td class="border-t border-x border-gray-900 text-center"> {{ $total ?? '' }} </td>
                            @if ($container->type == 'items')
                                <td class="border-t border-gray-900"></td>
                            @endif
                        </tr>
                    </table>
                </div>
                @php
                    unset($min, $max, $avarage, $total);
                @endphp

                <!-- Add item to container modal -->
                <x-modal name="add{{ $container->id }}">
                    @php
                        $exist = [];

                        foreach($items->where('container_id', $container->id) as $loot) {
                            array_push($exist, $loot->item->id);
                        }
                    @endphp

                    <div class="text-xl h-12 flex items-center justify-center">
                        {{ __('Add Item') }}
                    </div>
                    <form wire:submit="addItem({{ $container->id }})" class="px-6 pb-6">
                        @csrf
                        <div class="mt-6">
                            <x-input.label for="name" value="{{ __('Name') }}"/>

                            <select wire:model.defer="id" id="name" name="name" class="block w-full rounded border-0 shadow-sm ring-1 ring-inset ring-slate-400 focus:ring-2 focus:ring-inset focus:ring-midnight-500">
                                @foreach ($items->whereNotIn('id', $exist) as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
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

         <!-- Create new container modal -->
         <x-modal name="newContainer">
            <div class="text-xl h-12 flex items-center justify-center">
                {{ __('New Container') }}
            </div>
            <form wire:submit="newContainer" class="px-6 pb-6">
                @csrf
                <div class="mt-6">
                    <x-input.label class="mt-2" for="name" value="{{ __('Name') }}*" />

                    <x-input.text
                        wire:model="name"
                        type="text"
                        name="name"
                        id="name"
                        class="w-full"
                    />
                    <x-input.label class="mt-2" for="item" value="{{ __('Linked Item') }}" />

                    <select wire:model.defer="item" id="item" name="item" class="block w-full rounded border-0 shadow-sm ring-1 ring-inset ring-slate-400 focus:ring-2 focus:ring-inset focus:ring-midnight-500">
                        <option value="null">-- None --</option>
                        @foreach ($items as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>

                    <x-input.label class="mt-2" for="type" value="{{ __('Type') }}*" />

                    <select wire:model.defer="type" id="type" name="type" class="block w-full rounded border-0 shadow-sm ring-1 ring-inset ring-slate-400 focus:ring-2 focus:ring-inset focus:ring-midnight-500">
                        <option value="items">Items</option>
                        <option value="currency">Currency</option>
                    </select>


                    <x-input.label class="mt-2" for="split" value="{{ __('Splits') }}" />

                    <x-input.text
                        wire:model="split"
                        type="text"
                        name="split"
                        id="split"
                        class="w-full text-stone-950"
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
        </x-modal>

    </div>
</div>
