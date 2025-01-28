@php
    $link = 'text-teal-400 hover:text-teal-100';
@endphp

<x-app-layout>
    <div class="text-center md:w-1/2 w-11/12 m-auto">
        <h2>
            {{ __('Credits') }}
        </h2>
        <p>
            Project Xero is an ARPG species concept belonging to NeonSlushie & ScrapTeeth, The Xero Fanzone is a fan project and not officially affiliated with Project Xero.
        </p>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="text-stone-50">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium text-stone-50">
                        {{ __('General') }}
                    </h3>
                    <div>
                        <p>
                            <a class="{{ $link }}" href="https://projectxero.org/info/about">Project Xero</a> by <a class="{{ $link }}" href="https://projectxero.org/user/NeonSlushie">NeonSlushie</a> & <a class="{{ $link }}" href="https://projectxero.org/user/ScrapTeeth">ScrapTeeth</a>
                        </p>
                        <p>
                            <a class="{{ $link }}" href="https://xerofanzone.chimerasite.com/">Xero Fanzone</a> by <a class="{{ $link }}" href="https://chimerasite.com/">Chimerasite</a>
                        </p>
                    </div>
                </div>
            </div>
            <hr>
            <div class="text-stone-50">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium text-stone-50">
                        {{ __('Art and Images') }}
                    </h3>
                    <div>
                        {{-- <a class="{{ $link }}" href=""></a> by <a class="{{ $link }}" href=""></a> --}}
                    </div>
                </div>
            </div>
            {{-- <hr>
            <div class="text-stone-50">
                <div class="max-w-xl">

                </div>
            </div> --}}
        </div>
    </div>
</x-app-layout>
