<nav x-data="{ open: false }" class="bg-[#1e3a8a] border-b border-[#162b66] shadow-sm">

    @php
        $user = Auth::user();
        $dashboardRoute = $user && $user->role === 'admin'
            ? 'admin.dashboard'
            : 'siswa.dashboard';
    @endphp

    <!-- Primary Navigation -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Left -->
            <div class="flex">

                <!-- Logo & Text -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ $user ? route($dashboardRoute) : url('/') }}" class="flex items-center gap-2 no-underline">
                        <!-- Custom Icon or Application Logo -->
                        <img src="{{ asset('image/logoteks.png') }}" class="h-10 w-auto" alt="DIGITAKA">
                    </a>
                </div>

            </div>

            <!-- Right -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-4">
                @auth
                <!-- User Info -->
                <div class="flex flex-col text-right leading-tight mt-1">
                    <span class="text-white text-xs font-bold tracking-wide">{{ ucfirst($user->role ?? 'Siswa') }}</span>
                    <span class="text-white text-sm font-bold tracking-wide">{{ $user->name }}</span>
                </div>
                
                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="text-white hover:text-gray-300 transition focus:outline-none flex items-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                    </button>
                </form>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100">
                    <svg class="h-6 w-6" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': !open, 'inline-flex': open}" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- Responsive -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">

        @auth
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link
                :href="route($dashboardRoute)"
                :active="request()->routeIs($dashboardRoute)">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- User Info -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="text-base font-medium text-gray-800">
                    {{ $user->name }}
                </div>
                <div class="text-sm text-gray-500">
                    {{ $user->email }}
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        @endauth

    </div>
</nav>
