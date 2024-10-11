<div class="flex lg:flex-row flex-col text-stone-50 lg:space-x-6" x-data="{ open: false }">
    <div class="w-80 lg:flex hidden">
        <div class="bg-stone-600 w-full p-6 rounded-md">
            @if (Auth::user())
                <div  class="space-y-2">
                    <p>
                        <a href="{{ route('fancreations-create') }}" class="hover:text-teal-500">
                            Create new post <i class="fa-solid fa-plus fa-sm ml-1"></i>
                        </a>
                    </p>
                    <p>
                        <a wire:click="myPosts" class="hover:text-teal-500 cursor-pointer">
                            View my posts <i class="fa-solid fa-tag fa-sm ml-1"></i>
                        </a>
                    </p>
                </div>
            @else
                <div class="">
                    Please Login to create posts.
                </div>
            @endif
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
                    <div class="space-y-2 mt-4">
                        <p>
                            <a href="{{ route('fancreations-create') }}" class="hover:text-teal-500">
                                Create new post <i class="fa-solid fa-plus fa-sm ml-1"></i>
                            </a>
                        </p>
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
        <div class="bg-stone-500 rounded-md p-6 w-full">
            @if($filtered)
                <a wire:click="resetFilter" class="absolute">
                    <x-button.inline class="ml-3">
                        <i class="fa-solid fa-chevron-left"></i>
                    </x-button.inline>
                </a>
            @endif
            <div class="flex justify-center flex-wrap gap-x-8 gap-y-4 my-4">
                @foreach($posts as $post)
                    <a href="{{ route('fancreations-show', $post->slug) }}" class="text-center group rounded-md hover:bg-teal-500 ">
                        <div class="relative w-72 h-60 overflow-hidden flex items-center justify-center bg-stone-950 rounded-md group-hover:opacity-75">
                            @if ($post->thumbnail)
                                <img src="{{ $post->thumbnail }}" class="absolute block object-cover h-full w-full">
                            @else
                                <img src="/assets/img/no_img.png" class="absolute block object-cover h-full w-full">
                            @endif
                        </div>
                        <div class="mt-2">
                            <h3>{{ $post->name }}</h3>
                            <i class="text-sm">{{ $post->location }}</i>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
