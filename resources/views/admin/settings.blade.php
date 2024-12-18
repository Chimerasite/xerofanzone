<div class="w-full">
    <h3>General Settings</h3>
    <div class="mb-8">
        general settings go here:
         - turn off ability to upload
         - password for forage uploads
    </div>
    @if(Auth::user()->is_admin == 1)
        <h3>Permissions</h3>
        <form wire:submit.prevent="updatePermissions" onkeydown="return event.key != 'Enter';" class="px-6 pb-6">
            @csrf
            <div class="flex flex-wrap justify-around w-full">
                <div class="space-y-2">
                    <h4>Moderators</h4>
                    <div class="flex space-x-4 mt-4">
                        <x-input.label for="modsEditSettings">
                            {{ __('Moderators can edit settings') }}
                        </x-input.label>

                        <label class="inline-flex items-center me-5 cursor-pointer">
                            <input
                                wire:model="modsEditSettings"
                                type="checkbox"
                                name="modsEditSettings"
                                id="modsEditSettings"
                                class="sr-only peer"
                                {{ $modsEditSettings == 1 ? 'checked' : ''}}>
                            <div class="relative w-11 h-6 bg-stone-400 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-stone-50 after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-stone-50 after:border-stone-400 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-teal-500"></div>
                        </label>
                    </div>
                    <div class="flex space-x-4">
                        <x-input.label for="modsEditPosts">
                            {{ __('Moderators can edit all posts') }}
                        </x-input.label>

                        <label class="inline-flex items-center me-5 cursor-pointer">
                            <input
                                wire:model="modsEditPosts"
                                type="checkbox"
                                name="modsEditPosts"
                                id="modsEditPosts"
                                class="sr-only peer"
                                {{ $modsEditPosts == 1 ? 'checked' : ''}}>
                            <div class="relative w-11 h-6 bg-stone-400 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-stone-50 after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-stone-50 after:border-stone-400 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-teal-500"></div>
                        </label>
                    </div>
                    <div class="flex space-x-4">
                        <x-input.label for="modsEditLocations">
                            {{ __('Moderators can edit locations') }}
                        </x-input.label>

                        <label class="inline-flex items-center me-5 cursor-pointer">
                            <input
                                wire:model="modsEditLocations"
                                type="checkbox"
                                name="modsEditLocations"
                                id="modsEditLocations"
                                class="sr-only peer"
                                {{ $modsEditLocations == 1 ? 'checked' : ''}}
                            >
                            <div class="relative w-11 h-6 bg-stone-400 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-stone-50 after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-stone-50 after:border-stone-400 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-teal-500"></div>
                        </label>
                    </div>
                    <div class="flex space-x-4">
                        <x-input.label for="modsEditForaging">
                            {{ __('Moderators can edit foraging location data') }}
                        </x-input.label>

                        <label class="inline-flex items-center me-5 cursor-pointer">
                            <input
                                wire:model="modsEditForaging"
                                type="checkbox"
                                name="modsEditForaging"
                                id="modsEditForaging"
                                class="sr-only peer"
                                {{ $modsEditForaging == 1 ? 'checked' : ''}}
                            >
                            <div class="relative w-11 h-6 bg-stone-400 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-stone-50 after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-stone-50 after:border-stone-400 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-teal-500"></div>
                        </label>
                    </div>
                    <div class="flex space-x-4">
                        <x-input.label for="modsEditItems">
                            {{ __('Moderators can edit item data') }}
                        </x-input.label>

                        <label class="inline-flex items-center me-5 cursor-pointer">
                            <input
                                wire:model="modsEditItems"
                                type="checkbox"
                                name="modsEditItems"
                                id="modsEditItems"
                                class="sr-only peer"
                                {{ $modsEditItems == 1 ? 'checked' : ''}}
                            >
                            <div class="relative w-11 h-6 bg-stone-400 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-stone-50 after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-stone-50 after:border-stone-400 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-teal-500"></div>
                        </label>
                    </div>
                    <div class="flex space-x-4">
                        <x-input.label for="modsMassEditForaging">
                            {{ __('Moderators can mass edit foraging data') }}
                        </x-input.label>

                        <label class="inline-flex items-center me-5 cursor-pointer">
                            <input
                                wire:model="modsMassEditForaging"
                                type="checkbox"
                                name="modsMassEditForaging"
                                id="modsMassEditForaging"
                                class="sr-only peer"
                                {{ $modsMassEditForaging == 1 ? 'checked' : ''}}
                            >
                            <div class="relative w-11 h-6 bg-stone-400 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-stone-50 after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-stone-50 after:border-stone-400 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-teal-500"></div>
                        </label>
                    </div>
                </div>
                <div class="space-y-2">
                    <h4>Admins</h4>
                    <div class="flex space-x-4 mt-4">
                        <x-input.label for="adminEditPosts">
                            {{ __('Admins can edit all posts') }}
                        </x-input.label>

                        <label class="inline-flex items-center me-5 cursor-pointer">
                            <input
                                wire:model="adminEditPosts"
                                type="checkbox"
                                name="adminEditPosts"
                                id="adminEditPosts"
                                class="sr-only peer"
                                {{ $modsMassEditForaging == 1 ? 'checked' : ''}}
                            >
                            <div class="relative w-11 h-6 bg-stone-400 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-stone-50 after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-stone-50 after:border-stone-400 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-teal-500"></div>
                        </label>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-end items-center">
                @if (session()->has('postMessage'))
                    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show">
                        <div class="alert alert-success text-green-500 font-bold bg-stone-100 py-1 px-4 rounded-md" onload="timeout()" id="success">
                            {{ session('postMessage') }}
                        </div>
                    </div>
                @endif
                @if (session()->has('errorMessage'))
                    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show">
                        <div class="alert alert-error text-red-600 font-bold bg-stone-100 py-1 px-4 rounded-md" onload="timeout()" id="error">
                            {{ session('errorMessage') }}
                        </div>
                    </div>
                @endif

                <x-button.primary class="ml-3">
                    {{ __('Save') }}
                </x-button.primary>
            </div>
        </form>
    @endif
</div>
