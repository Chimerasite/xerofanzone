<nav x-data="{ open: false }">
    <!-- Primary Navigation Menu -->
    <div class="hidden lg:flex justify-between bg-stone-950 text-teal-500 uppercase">
        <!-- Navigation Links -->
        <div class="flex flex-row space-x-3 mx-6 my-6">
            <x-nav.link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('home') }}
            </x-nav.link>
            <x-nav.link :href="route('fancreations')" :active="request()->routeIs('fancreations.*')">
                {{ __('Fan creations') }}
            </x-nav.link>
            <x-nav.dropdown>
                <x-slot:trigger>
                    <button type="button" class="inline-flex items-center px-1 pt-1 text-base font-medium leading-5 text-teal-500 hover:text-stone-50 transition duration-150 ease-in-out uppercase">
                        {{ __('Statistics') }} <i class="fa-solid fa-caret-down fa-sm ml-2"></i>
                    </button>
                </x-slot>
                <x-slot name="content">
                    <x-nav.dropdown-link :href="route('stats.foraging')" :active="request()->routeIs('stats.*')">
                        {{ __('Foraging') }}
                    </x-nav.dropdown-link>
                    <x-nav.dropdown-link :href="route('stats.comets')" :active="request()->routeIs('stats.*')">
                        {{ __('Comet clusters') }}
                    </x-nav.dropdown-link>
                </x-slot>
            </x-nav.dropdown>
        </div>

        <!-- Account Data -->
        <div class="mx-6 my-6">
            @if (Auth::user())
                 <x-nav.dropdown align="right">
                    <x-slot:trigger>
                        <button type="button" class="inline-flex items-center px-1 pt-1 text-base font-medium leading-5 text-teal-500 hover:text-stone-50 transition duration-150 ease-in-out uppercase">
                            {{ Auth::user()->name }} <i class="fa-solid fa-caret-down fa-xs ml-2"></i>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-nav.dropdown-link :href="route('dashboard')">
                            {{ __('Profile') }}
                        </x-nav.dropdown-link>
                        <x-nav.dropdown-link :href="route('settings.edit')">
                            {{ __('Settings') }}
                        </x-nav.dropdown-link>
                        @if (Auth::user() && Auth::user()->is_admin == 1)
                            <x-nav.dropdown-link :href="route('admin.show')">
                                {{ __('Admin Panel') }}
                            </x-nav.dropdown-link>
                        @endif
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-nav.dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-nav.dropdown-link>
                        </form>
                    </x-slot>
                </x-nav.dropdown>
            @else
                <a href="{{ route('login') }}" class="hover:text-teal-100 mr-4">Login</a> <a href="{{ route('register') }}" class="hover:text-teal-100">Register</a>
            @endif
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div class="lg:hidden flex bg-stone-950">
        <!-- Hamburger -->
        <div class="flex items-center h-12 justify-between w-screen text-stone-50 px-4 z-50">
            <div><a href="{{ route('home') }}">Xero Fan zone</a></div>
            <button @click="open = ! open" onclick="lockscroll()">
                <span :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex items-center px-4 py-2 border border-stone-50 rounded-md font-semibold text-xs text-stone-50 uppercase tracking-widest"><i class="fa-solid fa-bars"></i></span>
                <span :class="{'hidden': ! open, 'inline-flex': open }" class="inline-flex items-center px-4 py-2 bg-teal-500 rounded-md font-semibold text-xs text-stone-50 uppercase tracking-widest"><i class="fa-solid fa-xmark"></i></span>
            </button>
        </div>
        <div x-cloak x-show="open" class="absolute z-40 flex flex-col justify-between w-screen h-screen bg-stone-950 text-teal-500 pt-12">
            <!-- Navigation Links -->
            <div class="flex flex-col text-sm space-y-3 mx-6">
                <div class="w-full mb-1">
                    <x-nav.responsive-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('home') }}
                    </x-nav.responsive-link>
                    <x-nav.responsive-link :href="route('fancreations')" :active="request()->routeIs('fancreations.*')">
                        {{ __('Fan creations') }}
                    </x-nav.responsive-link>
                    <x-nav.dropdown>
                        <x-slot:trigger>
                            <button type="button" class="block py-1 uppercase text-teal-500 hover:text-stone-50 focus:outline-none focus:text-stone-50 transition duration-150 ease-in-out">
                                {{ __('Statistics') }} <i class="fa-solid fa-caret-down fa-sm ml-2"></i>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-nav.dropdown-link :href="route('stats.foraging')" :active="request()->routeIs('stats.*')">
                                {{ __('Foraging') }}
                            </x-nav.dropdown-link>
                            <x-nav.dropdown-link :href="route('stats.comets')" :active="request()->routeIs('stats.*')">
                                {{ __('Comet clusters') }}
                            </x-nav.dropdown-link>
                        </x-slot>
                    </x-nav.dropdown>
                </div>
                <hr>
                <!-- Account Data -->
                <div>
                    @if (Auth::user())
                        <x-nav.dropdown align="right">
                            <x-slot:trigger>
                                <button type="button" class="block py-1 uppercase text-teal-500 hover:text-stone-50 focus:outline-none focus:text-stone-50 transition duration-150 ease-in-out">
                                    {{ Auth::user()->name }} <i class="fa-solid fa-caret-down fa-xs ml-2"></i>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-nav.dropdown-link :href="route('dashboard')">
                                    {{ __('Profile') }}
                                </x-nav.dropdown-link>
                                <x-nav.dropdown-link :href="route('settings.edit')">
                                    {{ __('Settings') }}
                                </x-nav.dropdown-link>
                                @if (Auth::user() && Auth::user()->is_admin == 1)
                                    <x-nav.dropdown-link :href="route('admin.show')">
                                        {{ __('Admin Panel') }}
                                    </x-nav.dropdown-link>
                                @endif
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-nav.dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-nav.dropdown-link>
                                </form>
                            </x-slot>
                        </x-nav.dropdown>
                    @else
                        <x-nav.responsive-link :href="route('login')">
                            {{ __('Login') }}
                        </x-nav.responsive-link>
                        <x-nav.responsive-link :href="route('register')">
                            {{ __('Register') }}
                        </x-nav.responsive-link>
                    @endif
                </div>
            </div>
        </div>
    </div>
</nav>
