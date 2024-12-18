<div class="w-full">
    <h3>General Settings</h3>
    <div class="mb-8">
        <form wire:submit.prevent="updateSettings" onkeydown="return event.key != 'Enter';" class="px-6 pb-6">
            @csrf
            <div class="flex flex-wrap justify-around w-full">
                <div class="space-y-2 w-1/3">
                    <div class="flex space-x-4 mt-4">
                        <x-input.label for="uploadForages">
                            {{ __('Upload Forages') }}
                        </x-input.label>

                        <label class="inline-flex items-center me-5 cursor-pointer">
                            <input
                                wire:model="uploadForages"
                                type="checkbox"
                                name="uploadForages"
                                id="uploadForages"
                                class="sr-only peer"
                                {{ $uploadForages == 1 ? 'checked' : ''}}
                            >
                            <div class="relative w-11 h-6 bg-stone-400 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-stone-50 after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-stone-50 after:border-stone-400 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-teal-500"></div>
                        </label>
                    </div>
                    <div class="flex space-x-4">
                        <x-input.label for="uploadComets">
                            {{ __('Upload Comets') }}
                        </x-input.label>

                        <label class="inline-flex items-center me-5 cursor-pointer">
                            <input
                                wire:model="uploadComets"
                                type="checkbox"
                                name="uploadComets"
                                id="uploadComets"
                                class="sr-only peer"
                                {{ $uploadComets == 1 ? 'checked' : ''}}
                            >
                            <div class="relative w-11 h-6 bg-stone-400 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-stone-50 after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-stone-50 after:border-stone-400 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-teal-500"></div>
                        </label>
                    </div>
                    <div class="flex space-x-4">
                        <x-input.label for="createPosts">
                            {{ __('Create Posts') }}
                        </x-input.label>

                        <label class="inline-flex items-center me-5 cursor-pointer">
                            <input
                                wire:model="createPosts"
                                type="checkbox"
                                name="createPosts"
                                id="createPosts"
                                class="sr-only peer"
                                {{ $createPosts == 1 ? 'checked' : ''}}
                            >
                            <div class="relative w-11 h-6 bg-stone-400 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-stone-50 after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-stone-50 after:border-stone-400 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-teal-500"></div>
                        </label>
                    </div>
                    <div class="flex space-x-4">
                        <x-input.label for="editPosts">
                            {{ __('Edit Posts') }}
                        </x-input.label>

                        <label class="inline-flex items-center me-5 cursor-pointer">
                            <input
                                wire:model="editPosts"
                                type="checkbox"
                                name="editPosts"
                                id="editPosts"
                                class="sr-only peer"
                                {{ $editPosts == 1 ? 'checked' : ''}}
                            >
                            <div class="relative w-11 h-6 bg-stone-400 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-stone-50 after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-stone-50 after:border-stone-400 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-teal-500"></div>
                        </label>
                    </div>
                </div>
                <div class="space-y-2 w-1/3">
                    <div class="mt-4">
                        <x-input.label for="foragePassword">
                            {{ __('Forage upload password') }}
                        </x-input.label>
                        <x-input.text
                            wire:model="foragePassword"
                            type="text"
                            name="foragePassword"
                            id="foragePassword"
                            class="w-full text-stone-950"
                        />
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-end items-center">
                @if (session()->has('settingMessage'))
                    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show">
                        <div class="alert alert-success text-green-500 font-bold bg-stone-100 py-1 px-4 rounded-md" onload="timeout()" id="success">
                            {{ session('settingMessage') }}
                        </div>
                    </div>
                @endif
                @if (session()->has('settingErrorMessage'))
                    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show">
                        <div class="alert alert-error text-red-600 font-bold bg-stone-100 py-1 px-4 rounded-md" onload="timeout()" id="error">
                            {{ session('settingErrorMessage') }}
                        </div>
                    </div>
                @endif

                <x-button.primary class="ml-3">
                    {{ __('Save') }}
                </x-button.primary>
            </div>
        </form>
    </div>
    @if(Auth::user()->is_admin == 1)
        <h3>Permissions</h3>
        <form wire:submit.prevent="updatePermissions" onkeydown="return event.key != 'Enter';" class="px-6 pb-6">
            @csrf
            <div class="flex flex-wrap justify-around w-full">
                <div class="space-y-2 w-1/3">
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
                <div class="space-y-2 w-1/3">
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
