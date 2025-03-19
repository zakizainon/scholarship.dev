<nav x-data="{ open: false, adminOpen: false }" class="bg-white border-b border-gray-100">

    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    {{-- <div class="hidden space-x-8 sm:flex sm:items-center sm:ml-10"> <!-- baru tambah --> --}}
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    @if (Auth::user() && Auth::user()->role == "admin")
                    <x-nav-link :href="route('submission.index')" :active="request()->routeIs('submission.index')">
                        {{ __('Application List') }}
                    </x-nav-link>
                    @endif

                    <x-nav-link :href="route('apply.index')" :active="request()->routeIs('apply.index')">
                        {{ __('Application Form') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                    {{-- <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24"> --}}
                        <svg class="h-6 w-6" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7" />
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Right side: Administration (only for admin) and User Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:space-x-4">
                @if (Auth::user() && Auth::user()->role == "admin")
                <!-- Administration Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                           {{-- class="inline-flex items-center px-3 py-2 text-gray-500 bg-white hover:text-gray-700 focus:outline-none"> --}}
                            <div>{{ __('Administration') }}</div>
                            {{-- <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div> --}}
                            <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('scholarship.index')">
                            {{ __('Scholarship Management') }}
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
                @endif

                <!-- User Dropdown (always shown) -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            {{-- class="inline-flex items-center px-3 py-2 text-gray-500 bg-white hover:text-gray-700 focus:outline-none"> --}}
                            <div>{{ Auth::user()->name }}</div>
                          
                            {{-- <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div> --}}
                            <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>

            <!-- Mobile Menu (Hidden by Default) -->
           
                    {{-- <div x-show="open" @click.away="open = false"
                        class="sm:hidden bg-white border-t border-gray-200 transition-all duration-300 ease-in-out"> --}}
                    {{-- <div x-show="open" @click.away="open = false"
                        class="sm:hidden fixed right-0 top-0 h-full w-64 bg-white border-l border-gray-200 shadow-lg transform transition-transform duration-300 ease-in-out translate-x-full"
                        :class="open ? 'translate-x-0' : 'translate-x-full'"> --}}

                       <!-- Right Side Navigation Menu -->
                   <div x-show="open" @click.away="open = false"
                        class="fixed right-0 top-0 h-full w-64 bg-white border-l border-gray-300 shadow-xl transform transition-transform duration-300 ease-in-out sm:hidden"
                        :class="open ? 'translate-x-0' : 'translate-x-full'" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0"
                        x-transition:leave-end="translate-x-full">
                          
                        <div class="pt-5 pb-3 px-4 space-y-2"> <!-- baru tambah -->

                    {{-- <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="block">
                        {{ __('Dashboard') }}
                    </x-nav-link> --}}
                    <nav class="pt-10 px-4">
                        <a href="{{ route('dashboard') }}" class="block px-4 py-3 rounded-md hover:bg-gray-100 text-gray-800">
                            🏠 Dashboard
                        </a>
 
                    @if (Auth::user() && Auth::user()->role == "admin")
                    {{-- <x-nav-link :href="route('submission.index')" :active="request()->routeIs('submission.index')" class="block">>
                        {{ __('Application List') }}
                    </x-nav-link> --}}
                    <a href="{{ route('submission.index') }}" class="block px-4 py-3 rounded-md hover:bg-gray-100 text-gray-800">
                        📄 Application List
                    </a>
                   
                    @endif
            
                    {{-- <x-nav-link :href="route('apply.index')" :active="request()->routeIs('apply.index')" class="block">
                        {{ __('Application Form') }}
                    </x-nav-link> --}}
                    <a href="{{ route('apply.index') }}" class="block px-4 py-3 rounded-md hover:bg-gray-100 text-gray-800">
                        📄 Application Form
                    </a>
                    
                    {{-- <x-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-nav-link> --}}
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-3 rounded-md hover:bg-gray-100 text-gray-800">
                        👤 Profile
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        {{-- <x-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-nav-link> --}}
                        <x-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"
                            class="flex items-center space-x-2 px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7"></path>
                            </svg>
                            <span>{{ __('Log Out') }}</span>
                        </x-nav-link>
                    </form>
                </div>
            </div>        
</nav>