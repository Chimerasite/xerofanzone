<div class="grow flex lg:flex-row flex-col text-stone-50 lg:space-x-6" x-data="{ open: false }">
    <div class="w-80 lg:flex hidden">
        <div class="bg-stone-600 w-full p-6 rounded-md">
            <div  class="space-y-2 mb-4">
                @if (Auth::user())
                    @if( $config == 1 )
                        <p>
                            <a href="{{ route('fancreations-create') }}" class="hover:text-teal-500">
                                Create new post <i class="fa-solid fa-plus fa-sm ml-1"></i>
                            </a>
                        </p>
                    @elseif ( $config == 0 )
                        <p>
                            <i>uploads are currently closed</i>
                        </p>
                    @endif

                    <p>
                        <a wire:click="myPosts" class="hover:text-teal-500 cursor-pointer">
                            View my posts <i class="fa-solid fa-tag fa-sm ml-1"></i>
                        </a>
                    </p>
                @else
                    <div>
                        Please Login to create posts.
                    </div>
                @endif
            </div>
            <hr>
            <div class="mt-4 space-y-2">
                <div x-data="{ dropdown: false }">
                    <div @click="dropdown = ! dropdown" class="flex justify-between items-center">
                        <h5>{{ __('Name') }}</h5>
                        <span>
                            <span :class="{'hidden': dropdown, 'inline-flex': ! dropdown }" class="inline-flex items-center px-2 tracking-widest"><i class="fa-solid fa-sm fa-chevron-down ml-1"></i></span>
                            <span :class="{'hidden': ! dropdown, 'inline-flex': dropdown }" class="inline-flex items-center px-2 tracking-widest"><i class="fa-solid fa-sm fa-chevron-up ml-1"></i></span>
                        </span>
                    </div>
                    <div x-cloak x-show="dropdown" class="mt-1 space-y-1">
                        <x-input.text
                            wire:model="name"
                            wire:keyup="filterPosts"
                            type="text"
                            class="w-full"
                        />
                    </div>
                </div>
                <div x-data="{ dropdown: false }">
                    <div @click="dropdown = ! dropdown" class="flex justify-between items-center">
                        <h5>{{ __('Location') }}</h5>
                        <span>
                            <span :class="{'hidden': dropdown, 'inline-flex': ! dropdown }" class="inline-flex items-center px-2 tracking-widest"><i class="fa-solid fa-sm fa-chevron-down ml-1"></i></span>
                            <span :class="{'hidden': ! dropdown, 'inline-flex': dropdown }" class="inline-flex items-center px-2 tracking-widest"><i class="fa-solid fa-sm fa-chevron-up ml-1"></i></span>
                        </span>
                    </div>
                    <div x-cloak x-show="dropdown" class="pl-1 mt-1 space-y-1">
                        @foreach ( $allLocations as $location )
                        <div>
                            <x-input.checkbox
                                value="{{ $location }}"
                                wire:model="locationFilter"
                                wire:click="filterPosts"
                            />
                            <label for="{{ $location }}">{{ $location }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div x-data="{ dropdown: false }">
                    <div @click="dropdown = ! dropdown" class="flex justify-between items-center">
                        <h5>{{ __('Tags') }}</h5>
                        <span>
                            <span :class="{'hidden': dropdown, 'inline-flex': ! dropdown }" class="inline-flex items-center px-2 tracking-widest"><i class="fa-solid fa-sm fa-chevron-down ml-1"></i></span>
                            <span :class="{'hidden': ! dropdown, 'inline-flex': dropdown }" class="inline-flex items-center px-2 tracking-widest"><i class="fa-solid fa-sm fa-chevron-up ml-1"></i></span>
                        </span>
                    </div>
                    <div x-cloak x-show="dropdown" class="pl-1 mt-1">
                        <x-input.text
                            wire:model="tagSearch"
                            wire:keyup="filterTags"
                            type="text"
                            class="w-full"
                        />
                        <div class="pl-1 mt-1 space-y-1 h-44 overflow-y-auto">
                            @foreach($tagList as $tag)
                                <div>
                                    <x-input.checkbox
                                            value="{{ $tag }}"
                                            wire:model="tagFilter"
                                            wire:click="filterPosts"
                                        />
                                    <label for="yes">{{ $tag }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div x-data="{ dropdown: false }">
                    <div @click="dropdown = ! dropdown" class="flex justify-between items-center">
                        <h5>{{ __('Art Permission') }}</h5>
                        <span>
                            <span :class="{'hidden': dropdown, 'inline-flex': ! dropdown }" class="inline-flex items-center px-2 tracking-widest"><i class="fa-solid fa-sm fa-chevron-down ml-1"></i></span>
                            <span :class="{'hidden': ! dropdown, 'inline-flex': dropdown }" class="inline-flex items-center px-2 tracking-widest"><i class="fa-solid fa-sm fa-chevron-up ml-1"></i></span>
                        </span>
                    </div>
                    <div x-cloak x-show="dropdown" class="pl-1 mt-1 space-y-1">
                        <div>
                            <x-input.checkbox
                                value="yes"
                                wire:model="artFilter"
                                wire:click="filterPosts"
                            />
                            <label for="yes">Yes</label>
                        </div>
                        <div>
                            <x-input.checkbox
                                value="ask"
                                wire:model="artFilter"
                                wire:click="filterPosts"
                            />
                            <label for="ask">Ask First</label>
                        </div>
                        <div>
                            <x-input.checkbox
                                value="no"
                                wire:model="artFilter"
                                wire:click="filterPosts"
                            />
                            <label for="no">No</label>
                        </div>
                    </div>
                </div>
                <div x-data="{ dropdown: false }">
                    <div @click="dropdown = ! dropdown" class="flex justify-between items-center">
                        <h5>{{ __('Writing Permission') }}</h5>
                        <span>
                            <span :class="{'hidden': dropdown, 'inline-flex': ! dropdown }" class="inline-flex items-center px-2 tracking-widest"><i class="fa-solid fa-sm fa-chevron-down ml-1"></i></span>
                            <span :class="{'hidden': ! dropdown, 'inline-flex': dropdown }" class="inline-flex items-center px-2 tracking-widest"><i class="fa-solid fa-sm fa-chevron-up ml-1"></i></span>
                        </span>
                    </div>
                    <div x-cloak x-show="dropdown" class="pl-1 mt-1 space-y-1">
                        <div>
                            <x-input.checkbox
                                value="yes"
                                wire:model="writingFilter"
                                wire:click="filterPosts"
                            />
                            <label for="yes">Yes</label>
                        </div>
                        <div>
                            <x-input.checkbox
                                value="ask"
                                wire:model="writingFilter"
                                wire:click="filterPosts"
                            />
                            <label for="ask">Ask First</label>
                        </div>
                        <div>
                            <x-input.checkbox
                                value="no"
                                wire:model="writingFilter"
                                wire:click="filterPosts"
                            />
                            <label for="no">No</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                @if (Auth::user())
                    <div class="space-y-2 mt-6">
                        @if( $config == 1 )
                            <p>
                                <a href="{{ route('fancreations-create') }}" class="hover:text-teal-500">
                                    Create new post <i class="fa-solid fa-plus fa-sm ml-1"></i>
                                </a>
                            </p>
                        @elseif ( $config == 0 )
                            <p>
                                <i>uploads are currently closed</i>
                            </p>
                        @endif
                        <p>
                            <a wire:click="myPosts" class="hover:text-teal-500">
                                View my posts <i class="fa-solid fa-tag fa-sm ml-1"></i>
                            </a>
                        </p>
                    </div>
                @else
                    <div class="mt-4">
                        Please Login to create posts.
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="w-full lg:px-0 px-5 lg:my-0 my-6">
        <div class="bg-stone-500 rounded-md p-6 w-full h-full">
            <div class="flex justify-between pb-4">
                <span>
                    @if($filtered)
                        <a wire:click="resetFilter">
                            <x-button.inline class="ml-3">
                                <i class="fa-solid fa-chevron-left"></i> Reset Filters
                            </x-button.inline>
                        </a>
                    @endif
                </span>
                <div class="relative mr-6" x-data="{ open: false }" @click.away="open = false" @close.stop="open = false">
                    <div @click="open = ! open">
                        <button type="button" class="text-stone-50 w-40 py-2 px-4 bg-teal-500 rounded-md hover:bg-teal-300 hover:shadow-md focus:outline-none transition ease-in-out duration-150">
                            {{ __('Order By') }} <i :class="{'hidden': ! open, 'inline-flex': open }" class="fa-solid fa-chevron-up text-xs ml-3"></i>
                                                 <i :class="{'hidden': open, 'inline-flex': ! open }" class="fa-solid fa-chevron-down text-xs ml-3"></i>
                        </button>
                    </div>

                    <div x-show="open"
                        class="absolute z-50 w-40 bg-stone-900 rounded-md mt-1"
                        style="display: none;"
                        @click="open = false">
                        <div class="space-y-1">
                            <div class="py-2 px-4 text-teal-500 hover:bg-stone-950 hover:text-white-500 rounded-md" wire:click="orderBy('created_at','sortByDesc')">
                                {{ __('Newest') }}
                            </div>
                            <div class="py-2 px-4 text-teal-500 hover:bg-stone-950 hover:text-white-500 rounded-md" wire:click="orderBy('created_at','sortBy')">
                                {{ __('Oldest') }}
                            </div>
                            <div class="py-2 px-4 text-teal-500 hover:bg-stone-950 hover:text-white-500 rounded-md" wire:click="orderBy('name','sortBy')">
                                {{ __('Name A-Z') }}
                            </div>
                            <div class="py-2 px-4 text-teal-500 hover:bg-stone-950 hover:text-white-500 rounded-md" wire:click="orderBy('name','sortByDesc')">
                                {{ __('Name Z-A') }}
                            </div>
                            <div class="py-2 px-4 text-teal-500 hover:bg-stone-950 hover:text-white-500 rounded-md" wire:click="orderBy('location','sortBy')">
                                {{ __('Location A-Z') }}
                            </div>
                            <div class="py-2 px-4 text-teal-500 hover:bg-stone-950 hover:text-white-500 rounded-md" wire:click="orderBy('location','sortByDesc')">
                                {{ __('Location Z-A') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-center flex-wrap gap-x-8 gap-y-4 my-4">
                @foreach($posts as $post)
                    <a href="{{ route('fancreations-show', $post->slug) }}" class="text-center group rounded-md hover:bg-teal-500">
                        <div class="relative w-72 h-60 overflow-hidden flex items-center justify-center bg-stone-950 rounded-md group-hover:opacity-75">
                            @if ($post->thumbnail)
                                <img src="{{ $post->thumbnail }}" class="absolute block object-cover h-full w-full">
                            @else
                                <img src="/assets/img/no_img.png" class="absolute block object-cover h-full w-full">
                            @endif
                        </div>
                        <div class="mt-2 w-72">
                            <h3>{{ $post->name }}</h3>
                            <i class="text-sm">{{ $post->location }}</i>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
