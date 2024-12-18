<x-app-layout>
    <div class="flex justify-between items-center space-x-3 mb-6">
        <a href="{{ route('fancreations') }}">
            <x-button.inline class="ml-3">
                <i class="fa-solid fa-chevron-left"></i>
            </x-button.inline>
        </a>
        <div class="flex space-x-3">
            <x-permission-pill permission="{{ $post->art_permission }}" icon="fa-pencil-ruler" info="for use in art" />
            <x-permission-pill permission="{{ $post->writing_permission }}" icon="fa-file-alt" info="for use in writing" />
            @if(Auth::user() && (Auth::User()->id == $post->user_id || (Auth::user()->is_admin == 1 && $adminRole == 1) || (Auth::user()->is_admin == 2 && $modRole == 1)))
                <a href="{{ route('fancreations-edit', $post->slug) }}">
                    <x-button.primary>
                        <i class="fa-solid fa-cog mr-1"></i> {{ __("Edit Post") }}
                    </x-button.primary>
                </a>
            @endif
        </div>
    </div>

    <div class="flex justify-between space-x-12 mb-20">
        <div class="w-2/3 space-y-3">
            <div>
                <h1>{{ $post->name }}</h1>
                <div>
                    <h5><i>{{ $post->tags }}</i></h5>
                </div>
            </div>

            <div>
                {{ $post->description }}
            </div>
        </div>


        <div>
            <div class="relative w-96 h-72 rounded-md overflow-hidden flex items-center justify-center bg-stone-950">
                @if ($post->thumbnail)
                    <img src="{{ $post->thumbnail }}" class="absolute block object-cover h-full w-full">
                @else
                    <img src="/assets/img/no_img.png" class="absolute block object-cover h-full w-full">
                @endif
            </div>
            <div class="mt-4 ml-4 space-y-1">
                <div>
                    <i class="fa-solid fa-location-dot"></i> <span class="font-bold cursor-default">{{ __('Location') }}: </span>
                    <a href="{{ $location->link ?? ''}}" class="{{ $location ? 'hover:text-teal-300 hover:underline' : 'cursor-default'}}">
                        <i>{{ $location->name ?? $post->location }}</i>
                    </a>
                </div>
                @if($post->contact)
                    <p>
                        <a href="{{ $post->contact }}" class="hover:text-teal-300 font-bold">
                            <i class="fa-solid fa-user"></i> <span class="hover:underline">Contact {{ $post->user->name ?? 'Creator'}}</span>
                        </a>
                    </p>
                @endif
                @if($post->external_link['link'] != null)
                    <p>
                        <a href="{{ $post->external_link['link'] }}" class="hover:text-teal-300 font-bold">
                            <i class="fa-solid fa-link"></i> <span class="hover:underline">{{ $post->external_link['name'] }}</span>
                        </a>
                    </p>
                @endif
            </div>
        </div>
    </div>
    @if($images)
        <div>
            <h2>Gallery</h2>
            <div class="flex flex-wrap justify-center w-full">
                @foreach($images as $image)
                    @if($image['image'])
                        <div x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'Image{{ $loop->index }}')"
                            class="group relative m-4 rounded-md size-64"
                        >
                            <img class="absolute block object-cover h-full w-full rounded-md" src='{{ $image['image'] }}'>
                            <div class="absolute hidden group-hover:block top-0 left-0 right-0 bottom-0 bg-teal-500 bg-opacity-85 rounded-md">
                                <div class="absolute w-full h-full p-4 flex justify-center items-center font-bold text-xl text-center"> {{ $image['text'] }} </div>
                            </div>
                        </div>

                        <x-modal name="Image{{ $loop->index }}" bgColor="bg-transparent" shadow="" focusable>
                            <div class="flex justify-center">
                                <img class="rounded-md" src='{{ $image['image'] }}'>
                            </div>
                            <div class="font-bold text-xl w-full text-center pt-1"> {{ $image['text'] }} </div>
                        </x-modal>
                    @endif
                @endforeach
            </div>
        </div>
    @endif

</x-app-layout>


