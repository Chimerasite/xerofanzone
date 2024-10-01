<x-app-layout>
    <x-slot:subnav>
        <a href="{{ route('fancreations-create') }}" >
            Create new post
        </a>
    </x-slot:subnav>
    <div class="flex flex-wrap space-x-8">
        @foreach($posts as $post)
            <a href="{{ route('fancreations-show', $post->slug) }}" class="text-center group rounded-md hover:bg-teal-500 ">
                <div class="relative w-72 h-60 overflow-hidden flex items-center justify-center bg-stone-950 rounded-md group-hover:opacity-75">
                    @if ($post->thumbnail != null)
                        <img src="{{ $post->thumbnail }}" class="absolute block object-cover h-full w-full">
                    @else
                        <img src="/assets/img/no_img.png">
                    @endif
                </div>
                <div class="mt-2">
                    <h3>{{ $post->name }}</h3>
                    <i class="text-sm">{{ $post->location }}</i>
                </div>
            </a>
        @endforeach
    </div>
</x-app-layout>
