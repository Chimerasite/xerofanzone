<div class="flex lg:flex-row flex-col text-stone-50 lg:space-x-6" x-data="{ open: false }">
    <!-- Primary subnav -->
    <div class="w-80 lg:flex hidden">
        <div class="bg-stone-600 w-full p-6 rounded-md">
            <h4 class="text-teal-500 uppercase text-center mb-4">{{ __('Comet Cluster Stats') }}</h4>
            <div class="w-full space-y-2 mb-4">

            </div>
            <hr>
            <div class="space-y-2 mt-4">
                <p>
                    <a href="{{ route('stats.comets-math') }}" class="hover:text-teal-500">
                        Wish Shard Calculator <i class="fa-solid fa-calculator fa-sm ml-1"></i>
                    </a>
                </p>
            </div>
            {{-- @if (Auth::user()) --}}
                <div class="space-y-2 mt-4">
                    @if( $config == 1 )
                        <p>
                            <a href="{{ route('stats.comets-update') }}" class="hover:text-teal-500">
                                Add Comet Cluster Data <i class="fa-solid fa-plus fa-sm ml-1"></i>
                            </a>
                        </p>
                    @elseif ( $config == 0 )
                        <p>
                            <i>Uploads are currently closed</i>
                        </p>
                    @endif
                </div>
            {{-- @else
                <div class="mt-4">
                    Please Login to add data.
                </div>
            @endif --}}
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
            <div class="flex flex-col space-y-3 mx-10 my-6">
                <h4 class="text-teal-500 uppercase text-center mb-4">{{ __('Comet Cluster Stats') }}</h4>
                <div class="w-full mb-4">

                </div>
                <hr>
                <div class="space-y-2 mt-4">
                    <p>
                        <a href="{{ route('stats.comets-math') }}" class="hover:text-teal-500">
                            Wish Shard Calculator <i class="fa-solid fa-calculator fa-sm ml-1"></i>
                        </a>
                    </p>
                </div>
                {{-- @if (Auth::user()) --}}
                    <div class="space-y-2 mt-4">
                        @if( $config == 1 )
                            <p>
                                <a href="{{ route('stats.comets-update') }}" class="hover:text-teal-500">
                                    Add Comet Cluster Data <i class="fa-solid fa-plus fa-sm ml-1"></i>
                                </a>
                            </p>
                        @elseif ( $config == 0 )
                            <p>
                                <i>Uploads are currently closed</i>
                            </p>
                        @endif
                    </div>
                {{-- @else
                    <div class="mt-4">
                        Please Login to add data.
                    </div>
                @endif --}}
            </div>
        </div>
    </div>
    <div class="w-full lg:px-0 px-5 lg:my-0 my-6 text-stone-950">
        <div class="bg-stone-500 rounded-md p-6 grid xl:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-8 w-full">
            @foreach($cometTypes as $cometType)
                @php
                    $min = $cometStats->where('item_id', $cometType->id)->sortby('amount')->first()->amount;
                    $max = $cometStats->where('item_id', $cometType->id)->sortbydesc('amount')->first()->amount;

                    $total = count($cometStats->where('item_id', $cometType->id));

                    $calc = 0;
                    foreach($cometStats->where('item_id', $cometType->id) as $key){
                        $calc = $calc + $key->amount;
                    }

                    $avarage = round($calc / $total);


                @endphp

                <div class="col-span-1 my-4 rounded-md shadow-md px-2 py-4 bg-teal-500">
                    <div class="relative flex items-center pb-4">
                        <h4 class="text-center w-full text-stone-50">{{ $cometType->name }}</h4>
                    </div>
                    <table class="w-full">
                        <tr class="w-full bg-stone-50">
                            <td class="border-b border-stone-900 pl-2 w-2/3">{{ __('Minimum Wish Shards') }}</td>
                            <td class="border-b border-x border-stone-900 text-center w-1/3"> {{  $min }} </td>
                        </tr>
                        <tr class="w-full bg-stone-50 bg-opacity-75">
                            <td class="border-b border-stone-900 pl-2 w-2/3">{{ __('Maximum Wish Shards') }}</td>
                            <td class="border-b border-x border-stone-900 text-center w-1/3"> {{  $max }} </td>
                        </tr>
                        <tr class="w-full bg-stone-50">
                            <td class="border-b border-stone-900 pl-2 w-2/3">{{ __('Average Wish Shards') }}</td>
                            <td class="border-b border-x border-stone-900 text-center w-1/3"> {{ $avarage }} </td>
                        </tr>
                        <tr class="h-2">
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="border-t border-gray-900 pl-2">Total Opened</td>
                            <td class="border-t border-x border-gray-900 text-center"> {{ $total }} </td>
                        </tr>
                    </table>
                </div>
            @endforeach
        </div>
    </div>
</div>
