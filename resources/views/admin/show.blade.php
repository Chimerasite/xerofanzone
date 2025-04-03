<x-app-layout>
    <div class="text-center mb-4">
        <h1>
            {{ __("Admin Panel") }}
        </h1>
    </div>
    <hr class="m-auto" style="width: 50%;">
    <div class="mt-4" x-data="{ element: '{{ Auth::user()->is_admin == 1 ? 'settings' : ($role->where('is_admin', 2)->first()->edit_settings == 1 ? 'settings' : ($role->where('is_admin', 2)->first()->edit_locations == 1 ? 'locations' : ($role->where('is_admin', 2)->first()->edit_foraging_locations == 1 ? 'foraging' : ($role->where('is_admin', 2)->first()->edit_items == 1 ? 'items' : '' )))) }}' }">
        <div class="flex md:flex-row flex-col justify-around bg-stone-600 rounded-md w-full md:h-8 mb-8 md:space-y-0 space-y-1">
            @if( $role->where('is_admin', 2)->first()->edit_settings == 1 || Auth::user()->is_admin == 1)
                <button :class=" element == 'settings' ? 'bg-teal-500' : ''" class="w-full rounded-md" x-on:click="element = 'settings'">Settings</button>
            @endif
            @if( $role->where('is_admin', 2)->first()->edit_locations == 1 || Auth::user()->is_admin == 1 )
                <button :class=" element == 'locations' ? 'bg-teal-500' : ''" class="w-full rounded-md" x-on:click="element = 'locations'">Locations</button>
            @endif
            @if( $role->where('is_admin', 2)->first()->edit_foraging_locations == 1 || Auth::user()->is_admin == 1 )
                <button :class=" element == 'foraging' ? 'bg-teal-500' : ''" class="w-full rounded-md" x-on:click="element = 'foraging'">Foraging Spots</button>
            @endif
            @if( $role->where('is_admin', 2)->first()->edit_items == 1 || Auth::user()->is_admin == 1 )
                <button :class=" element == 'items' ? 'bg-teal-500' : ''" class="w-full rounded-md" x-on:click="element = 'items'">Items</button>
            @endif
            @if( $role->where('is_admin', 2)->first()->edit_containers == 1 || Auth::user()->is_admin == 1 )
                <button :class=" element == 'containers' ? 'bg-teal-500' : ''" class="w-full rounded-md" x-on:click="element = 'containers'">Containers</button>
            @endif
        </div>
        @if( $role->where('is_admin', 2)->first()->edit_settings == 1 || Auth::user()->is_admin == 1 )
            <div class="mt-4" x-show="element == 'settings'" x-cloak>
                <div class="flex flex-wrap justify-start w-full">
                    @livewire('admin.settings')
                </div>
            </div>
        @endif
        @if( $role->where('is_admin', 2)->first()->edit_locations == 1 || Auth::user()->is_admin == 1 )
            <div class="mt-4" x-show="element == 'locations'" x-cloak">
                <div class="flex flex-wrap justify-start w-full">
                    @livewire('admin.locations')
                </div>
            </div>
        @endif
        @if( $role->where('is_admin', 2)->first()->edit_foraging_locations == 1 || Auth::user()->is_admin == 1 )
            <div class="mt-4" x-show="element == 'foraging'" x-cloak">
                <div class="flex flex-wrap justify-start w-full">
                    @livewire('admin.foraging')
                </div>
            </div>
        @endif
        @if( $role->where('is_admin', 2)->first()->edit_items == 1 || Auth::user()->is_admin == 1 )
            <div class="mt-4" x-show="element == 'items'" x-cloak">
                <div class="flex flex-wrap justify-start w-full">
                    @livewire('admin.items')
                </div>
            </div>
        @endif
        @if( $role->where('is_admin', 2)->first()->edit_containers == 1 || Auth::user()->is_admin == 1 )
            <div class="mt-4" x-show="element == 'containers'" x-cloak">
                <div class="flex flex-wrap justify-start w-full">
                    @livewire('admin.containers')
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
