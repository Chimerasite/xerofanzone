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
                <span>
                    Public Post:
                    @if($post->public == 1)
                        <i class="text-sm">yes</i>
                    @else
                        <i class="text-sm">no</i>
                    @endif
                </span>
            </div>
            <div class="mt-1 w-72">
                <h3>{{ $post->name }}</h3>
                <i class="text-sm">{{ $post->location }}</i>
            </div>
        </a>
    @endforeach
</div>
