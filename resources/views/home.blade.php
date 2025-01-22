<x-app-layout>
    <div class="text-center space-y-4 lg:w-1/2 sm:w-3/4 m-auto mb-8">
        <h1>Welcome to the Xero Fanzone</h1>
        <hr>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
        <div class="lg:w-1/2 sm:w-3/4 m-auto text-justify space-y-3">
            <p>
                Dive into this space for fans of Project Xero, where creativity and community come together. Explore fan-created locations, share your own ideas, track foraging statistics and more. Whether you're here to browse or contribute, the Xero Fanzone is your space to celebrate everything Xero.
            </p>
            <p class="font-bold text-lg">
                Join the adventure, create an account to upload your posts and creations!
            </p>
        </div>
        <div>
            <h3>Featured Posts</h3>
            <div class="flex justify-center flex-wrap gap-x-12 gap-y-4 my-4">
                @foreach($featured as $post)
                    <a href="{{ route('fancreations-show', $post['slug']) }}" class="text-center group rounded-md hover:bg-teal-500">
                        <div class="relative w-72 h-60 overflow-hidden flex items-center justify-center bg-stone-950 rounded-md group-hover:opacity-75">
                            @if ($post['thumbnail'])
                                <img src="{{ $post['thumbnail'] }}" class="absolute block object-cover h-full w-full">
                            @else
                                <img src="/assets/img/no_img.png" class="absolute block object-cover h-full w-full">
                            @endif
                        </div>
                        <div class="mt-2 w-72">
                            <h3>{{ $post['name'] }}</h3>
                            <i class="text-sm">{{ $post['location'] }}</i>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
