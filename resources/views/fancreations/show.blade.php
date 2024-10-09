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
            @if(Auth::user() && Auth::User()->id == $post->user_id)
                <a href="{{ route('fancreations') }}">
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
            <div class="relative w-96 h-72 overflow-hidden flex items-center justify-center bg-stone-950">
                @if ($post->thumbnail)
                    <img src="{{ $post->thumbnail }}" class="absolute block object-cover h-full w-full">
                @else
                    <img src="/assets/img/no_img.png" class="absolute block object-cover h-full w-full">
                @endif
            </div>
            <div class="mt-4 ml-4 space-y-1">
                <div>
                    <i class="fa-solid fa-location-dot"></i> <span class="font-bold">{{ __('Location') }}: </span><i>{{ $post->location }}</i>
                </div>
                @if($post->contact)
                    <p>
                        <a href="{{ $post->contact }}" class="hover:text-teal-300 font-bold" target="_blanc">
                            <i class="fa-solid fa-user"></i> <span class="hover:underline">Contact Creator</span>
                        </a>
                    </p>
                @endif
                @if($post->external_link)
                    <p>
                        <a href="{{ $post->external_link }}" class="hover:text-teal-300 font-bold" target="_blanc">
                            <i class="fa-solid fa-link"></i> <span class="hover:underline">External Link</span>
                        </a>
                    </p>
                @endif
            </div>
        </div>
    </div>
    {{-- @if($images) --}}
        <div>
            <h2>Gallery</h2>
            <div class="flex flex-wrap justify-center w-full">
                {{-- @foreach($images as $image) --}}
                    <img class="size-64 m-4" src="https://media.istockphoto.com/id/1147544807/vector/thumbnail-image-vector-graphic.jpg?s=612x612&w=0&k=20&c=rnCKVbdxqkjlcs3xH87-9gocETqpspHFXu5dIGB4wuM=">
                {{-- @endforeach --}}
            </div>
        </div>
    {{-- @endif --}}
</x-app-layout>
