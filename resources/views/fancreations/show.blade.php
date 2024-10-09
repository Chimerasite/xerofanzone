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
        </div>
    </div>

    <div class="flex justify-between space-x-12 mb-20">
        <div class="w-2/3 space-y-3">
            <div>
                <h1>{{ $post->name }}</h1>
                <div>
                    <h5><i>tag, tag, tag</i></h5>
                </div>
            </div>

            <div>
                {{ $post->description }}
            </div>
        </div>


        <div class="relative w-96 h-72 overflow-hidden flex items-center justify-center bg-stone-950">
            @if ($post->thumbnail != null)
                <img src="{{ $post->thumbnail }}" class="absolute block object-cover h-full w-full">
            @else
                <img src="/assets/img/no_img.png" class="absolute block object-cover h-full w-full">
            @endif
        </div>
    </div>
    {{-- @if($images != null) --}}
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
