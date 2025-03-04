<div class="xl:w-1/2 md:w-3/4 m-auto" x-data="{ element: 'main' }">
    @if( $config == 1 )
        <div class="flex md:flex-row flex-col justify-around bg-stone-600 rounded-md w-full md:h-8 md:space-y-0 space-y-1">
            <button :class=" element == 'main' ? 'bg-teal-500' : ''" class="w-full rounded-md" x-on:click="element = 'main'">Main</button>
            <button :class=" element == 'info' ? 'bg-teal-500' : ''" class="w-full rounded-md" x-on:click="element = 'info'">Info</button>
            <button :class=" element == 'extra' ? 'bg-teal-500' : ''" class="w-full rounded-md" x-on:click="element = 'extra'">Extra</button>
            <button :class=" element == 'linked' ? 'bg-teal-500' : ''" class="w-full rounded-md" x-on:click="element = 'linked'">Link Characters</button>
            <button :class=" element == 'gallery' ? 'bg-teal-500' : ''" class="w-full rounded-md" x-on:click="element = 'gallery'">Gallery</button>
        </div>

        <form wire:submit.prevent="createPost" onkeydown="return event.key != 'Enter';" class="px-6 pb-6">
            @csrf
            <div x-show="element == 'main'" x-cloak>
                <div class="mt-4">
                    <x-input.label for="name" value="{{ __('Title') }}*" />
                    <x-input.text
                        wire:model="name"
                        wire:keyup="generateSlug"
                        type="text"
                        name="name"
                        id="name"
                        class="w-full text-stone-950"
                    />
                </div>

                <div class="mt-4">
                    <x-input.label for="slug">
                        {{ __('Slug') }}* <x-input.tip value="The slug is the part that shows at the end of the link to your post. It has to be unique and can't be the same in multiple post." />
                    </x-input.label>
                    <x-input.text
                        wire:model="slug"
                        type="text"
                        name="slug"
                        id="slug"
                        class="w-full text-stone-950"
                    />
                </div>

                <div class="mt-4">
                    <x-input.label for="thumbnail">
                        {{ __('Thumbnail') }} <x-input.tip value="Put a link to you image in here. This image will show on the list of all posts and as main image on your posts individual page." />
                    </x-input.label>
                    <x-input.text
                        wire:model="thumbnail"
                        type="url"
                        name="thumbnail"
                        id="thumbnail"
                        class="w-full text-stone-950"
                    />

                </div>
            </div>

            <div x-show="element == 'info'" x-cloak>
                <div class="mt-4">
                    <x-input.label for="tags">
                        {{ __('Tags') }} <x-input.tip value="Tags can be used to sort Posts based on their function or type." />
                    </x-input.label>

                    <div class="tags-input">
                        <div class="flex space-x-4">
                            <x-input.text
                                type="text"
                                list="allTags"
                                wire:keyup.enter="addTagList"
                                wire:model="tags"
                                id="input-tag"
                                class="w-full text-stone-950"
                            />
                            <datalist id="allTags">
                                @foreach($allTags as $tag)
                                    <option value="{{ $tag }}">
                                @endforeach
                            </datalist>
                            <span wire:click="addTagList" class="inline-flex items-center px-4 py-2 bg-teal-500 border border-transparent rounded-md font-semibold text-xs text-stone-50 uppercase tracking-widest hover:bg-teal-300 active:bg-teal-300 focus:outline-none transition ease-in-out duration-150">
                                <i class="fa-solid fa-plus"></i>
                            </span>
                        </div>
                        <ul id="tags" >
                            @foreach($tagList as $key)
                                <li>{{ $key }} <i class="fa-solid fa-xmark delete-button" wire:click="removeTagList('{{ $key }}')" class=""></i></li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="mt-4">
                    <x-input.label for="description" value="{{ __('Description') }}" />
                    <x-input.textarea
                        wire:model="description"
                        name="description"
                        id="description"
                        class="w-full text-stone-950"
                    />
                </div>

                <div class="mt-4" x-data="{ location: '' }">
                    <x-input.label for="location">
                        {{ __('Location') }} <x-input.tip value="Link your Post to a location, create someplace new or leave empty" />
                    </x-input.label>
                    <select wire:model.defer="location" id="location" name="location" class="block w-full rounded-md border-0 shadow-sm ring-1 ring-inset ring-stone-400 focus:ring-2 focus:ring-inset focus:ring-teal-500 text-stone-950 cursor-pointer">
                        <option value="">Choose a location</option>
                        @foreach($allLocations as $location)
                            <option class="text-stone-950" value="{{ $location }}">{{ $location }}</option>
                        @endforeach
                        <option class="text-stone-950" value="Other">Other...</option>
                    </select>
                    <div x-show="$wire.location == 'Other'" x-cloak>
                        <x-input.text
                        wire:model="otherLocation"
                        type="text"
                        id="otherLocation"
                        class="w-full text-stone-950 mt-1"
                        placeholder="Other Location"
                    />
                    </div>
                </div>
            </div>

            <div x-show="element == 'extra'" x-cloak>
                <div class="mt-4">
                    <x-input.label for="contact">
                        {{ __('Contact') }} <x-input.tip value="Add a link to your contact info if you want people to be able to message you for questions about your Posts." />
                    </x-input.label>
                    <x-input.text
                        wire:model="contact"
                        type="text"
                        name="contact"
                        id="contact"
                        class="w-full text-stone-950"
                    />
                </div>

                <div class="mt-4">
                    <x-input.label for="external_link">
                        {{ __('External Link') }} <x-input.tip value="Add a link to an external place for your Post." />
                    </x-input.label>
                    <x-input.text
                        wire:model="external_link_name"
                        type="text"
                        name="external_link_name"
                        id="external_link_name"
                        class="w-full text-stone-950"
                        placeholder="Name"
                    />
                    <x-input.text
                        wire:model="external_link"
                        type="url"
                        name="external_link"
                        id="external_link"
                        class="w-full text-stone-950 mt-1"
                        placeholder="Link"
                    />
                </div>

                <div class="mt-4 flex justify-between space-x-8">
                    <div class="w-1/2">
                        <x-input.label for="art_permission">
                            {{ __('Allow Use in Art') }} <x-input.tip value="This will show your permissions of using your Post in art" />
                        </x-input.label>
                        <select wire:model.defer="art_permission" id="art_permission" name="art_permission" class="block w-full rounded-md border-0 shadow-sm ring-1 ring-inset ring-stone-400 focus:ring-2 focus:ring-inset focus:ring-teal-500 text-stone-950 cursor-pointer">
                            <option class="text-stone-950" value="yes">Yes</option>
                            <option class="text-stone-950" value="no">No</option>
                            <option class="text-stone-950" value="ask">Ask First</option>
                        </select>
                    </div>

                    <div class="w-1/2">
                        <x-input.label for="writing_permission">
                            {{ __('Allow Use in Writing') }} <x-input.tip value="This will show your permissions of using your Post in writing" />
                        </x-input.label>
                        <select wire:model.defer="writing_permission" id="writing_permission" name="writing_permission" class="block w-full rounded-md border-0 shadow-sm ring-1 ring-inset ring-stone-400 focus:ring-2 focus:ring-inset focus:ring-teal-500 text-stone-950 cursor-pointer">
                            <option class="text-stone-950" value="yes">Yes</option>
                            <option class="text-stone-950" value="no">No</option>
                            <option class="text-stone-950" value="ask">Ask First</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4">
                    <x-input.label for="public">
                        {{ __('Public') }} <x-input.tip value="This makes your Post public and will show it to other users. Keep this unchecked if you want to have your post as a draft or hidden from others on this site." />
                    </x-input.label>
                    <label class="inline-flex items-center me-5 cursor-pointer">
                        <input
                            wire:model="public"
                            type="checkbox"
                            value=""
                            name="public"
                            id="public"
                            class="sr-only peer"
                            checked>
                        <div class="relative w-11 h-6 bg-stone-400 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-stone-50 after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-stone-50 after:border-stone-400 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-teal-500"></div>
                    </label>
                </div>
            </div>

            <div x-show="element == 'linked'" x-cloak>
                <div class="mt-4">
                    <x-input.label for="linked" value="{{ __('Linked Characters') }}" />
                    <div class="pt-1">
                        @foreach($linkedList as $key=>$linked)
                            <i class="underline underline-offset-2">Linked Character</i>
                            <span wire:click="removeLinkedField('{{ $key }}')" class="inline-flex items-center p-2 ml-2 font-semibold text-xs text-stone-50 uppercase tracking-widest hover:text-teal-500 active:text-teal-500 transition ease-in-out duration-150">
                                <i class="fa-solid fa-xmark"></i>
                            </span>
                            <div class="grid sm:grid-cols-8 grid-cols-1">
                                <label class="col-span-1 self-center">Name: </label>
                                <x-input.text
                                    onkeyup="saveLinkedName({{ $key }})"
                                    type="text"
                                    id="linkedName{{ $key }}"
                                    class="w-full text-stone-950 mt-1 col-span-7"
                                    placeholder="Name"

                                />
                                <label class="col-span-1 self-center">Role: </label>
                                <x-input.text
                                    onkeyup="saveLinkedRole({{ $key }})"
                                    type="text"
                                    id="linkedRole{{ $key }}"
                                    class="w-full text-stone-950 mt-1 col-span-7"
                                    placeholder="Role of Character in Location (optional)"
                                />
                                <label class="col-span-1 self-center">Thumbnail: *</label>
                                <x-input.text
                                    onkeyup="saveLinkedThumbnail({{ $key }})"
                                    type="url"
                                    id="linkedThumbnail{{ $key }}"
                                    class="w-full text-stone-950 mt-1 col-span-7"
                                    placeholder="Link to Thumbnail Image"
                                />
                                <label class="col-span-1 self-center">Link: </label>
                                <x-input.text
                                    onkeyup="saveLinkedLink({{ $key }})"
                                    type="url"
                                    id="linkedLink{{ $key }}"
                                    class="w-full text-stone-950 mt-1 col-span-7"
                                    placeholder="Link to Character (optional)"
                                />
                            </div>
                            @if(!$loop->last)
                                <hr class="my-4">
                            @endif
                        @endforeach
                    </div>
                    <div class="flex justify-end mt-4">
                        <span wire:click="addLinkedField" class="inline-flex items-center px-4 py-2 bg-teal-500 border border-transparent rounded-md font-semibold text-xs text-stone-50 uppercase tracking-widest hover:bg-teal-300 active:bg-teal-300 focus:outline-none transition ease-in-out duration-150">
                            <i class="fa-solid fa-plus"></i>
                        </span>
                    </div>
                </div>
            </div>

            <div x-show="element == 'gallery'" x-cloak>
                <div class="mt-4">
                    <x-input.label for="image" value="{{ __('Image') }}" />
                    <div class="pt-1">
                        @foreach($imageList as $key=>$image)
                            <i class="underline underline-offset-2">Image</i>
                            <span wire:click="removeImageField('{{ $key }}')" class="inline-flex items-center p-2 ml-2 font-semibold text-xs text-stone-50 uppercase tracking-widest hover:text-teal-500 active:text-teal-500 transition ease-in-out duration-150">
                                <i class="fa-solid fa-xmark"></i>
                            </span>
                            <x-input.text
                                onkeyup="saveImageText({{ $key }})"
                                type="text"
                                id="imgText{{ $key }}"
                                class="w-full text-stone-950 mt-1"
                                placeholder="Title"

                            />
                            <x-input.text
                                onkeyup="saveImageLink({{ $key }})"
                                type="url"
                                id="imgLink{{ $key }}"
                                class="w-full text-stone-950 mt-1"
                                placeholder="Url"
                            />
                            <x-input.text
                                onkeyup="saveImageInfo({{ $key }})"
                                type="text"
                                id="imgInfo{{ $key }}"
                                class="w-full text-stone-950 mt-1"
                                placeholder="Info or Credits"
                            />
                            @if(!$loop->last)
                                <hr class="my-4">
                            @endif
                        @endforeach
                    </div>
                    <div class="flex justify-end mt-4">
                        <span wire:click="addImageField" class="inline-flex items-center px-4 py-2 bg-teal-500 border border-transparent rounded-md font-semibold text-xs text-stone-50 uppercase tracking-widest hover:bg-teal-300 active:bg-teal-300 focus:outline-none transition ease-in-out duration-150">
                            <i class="fa-solid fa-plus"></i>
                        </span>
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

                <a href="{{ route('fancreations') }}">
                    <x-button.secondary class="ml-3">
                        {{ __('Back') }}
                    </x-button.secondary>
                </a>

                <x-button.primary class="ml-3">
                    {{ __('Add') }}
                </x-button.primary>
            </div>
        </form>
    @elseif(  $config == 0 )
        <div class="mt-6 text-center font-bold text-xl">
            Post uploads are currently closed
        </div>
    @endif
</div>


<script>
    function saveImageText(key) {
        let text = document.getElementById('imgText' + key).value;
        Livewire.dispatch('saveImageText', {
                            newText: text,
                            key: key
                        });
    }

    function saveImageLink(key) {
        let link = document.getElementById('imgLink' + key).value;
        Livewire.dispatch('saveImageLink', {
                            newLink: link,
                            key: key
                        });
    }

    function saveImageInfo(key) {
        let info = document.getElementById('imgInfo' + key).value;
        Livewire.dispatch('saveImageInfo', {
                            newInfo: info,
                            key: key
                        });
    }

    function saveLinkedName(key) {
        let name = document.getElementById('linkedName' + key).value;
        Livewire.dispatch('saveLinkedName', {
                            newName: name,
                            key: key
                        });
    }

    function saveLinkedRole(key) {
        let role = document.getElementById('linkedRole' + key).value;
        Livewire.dispatch('saveLinkedRole', {
                            newRole: role,
                            key: key
                        });
    }

    function saveLinkedThumbnail(key) {
        let thumbnail = document.getElementById('linkedThumbnail' + key).value;
        Livewire.dispatch('saveLinkedThumbnail', {
                            newThumbnail: thumbnail,
                            key: key
                        });
    }

    function saveLinkedLink(key) {
        let link = document.getElementById('linkedLink' + key).value;
        Livewire.dispatch('saveLinkedLink', {
                            newLink: link,
                            key: key
                        });
    }
</script>
