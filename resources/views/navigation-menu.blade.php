<nav x-data="{ open: false }" class="sticky top-0 bg-white border-b border-gray-100 z-50 rounded-b-lg shadow-md">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <a href="{{ route('home') }}">
                    <x-application-mark class="block h-9 w-auto" />
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                    {{ __('Inicio') }}
                </x-nav-link>

                @auth
                    @if (Auth::user()->role == 'admin')
                        <x-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">
                            {{ __('Administrador') }}
                        </x-nav-link>
                    @endif

                    @if (Auth::user()->role == 'gerencia')
                        <x-nav-link href="{{ route('gerencia.dashboard') }}" :active="request()->routeIs('gerencia.dashboard')">
                            {{ __('Gerencia') }}
                        </x-nav-link>
                    @endif

                    @if (Auth::user()->role == 'calidad')
                        <x-nav-link href="{{ route('calidad.dashboard') }}" :active="request()->routeIs('calidad.dashboard')">
                            {{ __('Super. Calidad') }}
                        </x-nav-link>
                    @endif

                    @if (Auth::user()->role == 'campo')
                        <x-nav-link href="{{ route('campo.dashboard') }}" :active="request()->routeIs('campo.dashboard')">
                            {{ __('Super. Campo') }}
                        </x-nav-link>
                    @endif

                    @if (Auth::user()->role == 'encuestador')
                        <x-nav-link href="{{ route('encuestador.dashboard') }}" :active="request()->routeIs('encuestador.dashboard')">
                            {{ __('Encuestador') }}
                        </x-nav-link>
                    @endif

                    @if (Auth::user()->role == 'socializador')
                        <x-nav-link href="{{ route('socializador.dashboard') }}" :active="request()->routeIs('socializador.dashboard')">
                            {{ __('Socializador') }}
                        </x-nav-link>
                    @endif

                    @if (Auth::user()->role == 'provincial')
                        <x-nav-link href="{{ route('provincial.dashboard') }}" :active="request()->routeIs('provincial.dashboard')">
                            {{ __('Provincial') }}
                        </x-nav-link>
                    @endif
                @endauth

                <x-nav-link href="{{ route('novedades') }}" :active="request()->routeIs('novedades')">
                    {{ __('Novedades') }}
                </x-nav-link>

                <x-nav-link href="{{ route('verificar-equipo') }}" :active="request()->routeIs('verificar-equipo')">
                    {{ __('Equipos') }}
                </x-nav-link>

                <x-nav-link href="{{ route('verigicar-integrantes') }}" :active="request()->routeIs('verigicar-integrantes')">
                    {{ __('Integrantes') }}
                </x-nav-link>
                <x-nav-link href="{{ route('verificar-planificaciones') }}" :active="request()->routeIs('verificar-planificaciones')">
                    {{ __('Planificaciones') }}
                </x-nav-link>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @auth
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <button
                                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                        <img class="h-8 w-8 rounded-full object-cover"
                                            src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                    </button>
                                @else
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                            {{ Auth::user()->name }}

                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                    </span>
                                @endif
                            @else
                                <button
                                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <svg class="h-8 w-8 rounded-full object-cover" xmlns="http://www.w3.org/2000/svg"
                                        height="1em" viewBox="0 0 448 512">
                                        <path
                                            d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                                    </svg>
                                </button>
                            @endauth
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Opciones') }}
                            </div>

                            @auth
                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                        {{ __('API Tokens') }}
                                    </x-dropdown-link>
                                @endif

                                <div class="border-t border-gray-200"></div>
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            @else
                                <x-dropdown-link href="{{ route('login') }}">
                                    {{ __('Inicio de Sesión') }}
                                </x-dropdown-link>

                                {{-- <x-dropdown-link href="{{ route('register') }}">
                                    {{ __('Registrarse') }}
                                </x-dropdown-link> --}}
                            @endauth
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                {{ __('Inicio') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('novedades') }}" :active="request()->routeIs('novedades')">
                {{ __('Consular Novedades') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('verificar-equipo') }}" :active="request()->routeIs('verificar-equipo')">
                {{ __('Consular Equipos') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('verigicar-integrantes') }}" :active="request()->routeIs('verigicar-integrantes')">
                {{ __('Consular Integrantes') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('verificar-planificaciones') }}" :active="request()->routeIs('verificar-planificaciones')">
                {{ __('Consular Planificaciones') }}
            </x-responsive-nav-link>

            @auth
                @if (Auth::user()->role == 'admin')
                    <x-responsive-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">
                        {{ __('Administrador') }}
                    </x-responsive-nav-link>
                @endif

                @if (Auth::user()->role == 'gerencia')
                    <x-responsive-nav-link href="{{ route('gerencia.dashboard') }}" :active="request()->routeIs('gerencia.dashboard')">
                        {{ __('Gerencia') }}
                    </x-responsive-nav-link>
                @endif

                @if (Auth::user()->role == 'calidad')
                    <x-responsive-nav-link href="{{ route('calidad.dashboard') }}" :active="request()->routeIs('calidad.dashboard')">
                        {{ __('Supervisor de Calidad') }}
                    </x-responsive-nav-link>
                @endif

                @if (Auth::user()->role == 'campo')
                    <x-responsive-nav-link href="{{ route('campo.dashboard') }}" :active="request()->routeIs('campo.dashboard')">
                        {{ __('Supervisor de Campo') }}
                    </x-responsive-nav-link>
                @endif

                @if (Auth::user()->role == 'encuestador')
                    <x-responsive-nav-link href="{{ route('encuestador.dashboard') }}" :active="request()->routeIs('encuestador.dashboard')">
                        {{ __('Encuestador') }}
                    </x-responsive-nav-link>
                @endif

                @if (Auth::user()->role == 'socializador')
                    <x-responsive-nav-link href="{{ route('socializador.dashboard') }}" :active="request()->routeIs('socializador.dashboard')">
                        {{ __('Socializador') }}
                    </x-responsive-nav-link>
                @endif

                @if (Auth::user()->role == 'provincial')
                    <x-responsive-nav-link href="{{ route('provincial.dashboard') }}" :active="request()->routeIs('provincial.dashboard')">
                        {{ __('Provincial') }}
                    </x-responsive-nav-link>
                @endif
            @else
                <x-responsive-nav-link href="{{ route('login') }}">
                    {{ __('Inicio de Sesión') }}
                </x-responsive-nav-link>
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            @auth
                <div class="flex items-center px-4">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <div class="shrink-0 mr-3">
                            <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                                alt="{{ Auth::user()->name }}" />
                        </div>
                    @endif
                    <div>
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <div class="mt-3 space-y-1">
                    <!-- Account Management -->
                    <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                            {{ __('API Tokens') }}
                        </x-responsive-nav-link>
                    @endif

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>

                    <!-- Team Management -->
                    @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                        <div class="border-t border-gray-200"></div>

                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Team') }}
                        </div>

                        <!-- Team Settings -->
                        <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                            :active="request()->routeIs('teams.show')">
                            {{ __('Team Settings') }}
                        </x-responsive-nav-link>

                        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                            <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                                {{ __('Create New Team') }}
                            </x-responsive-nav-link>
                        @endcan

                        <!-- Team Switcher -->
                        @if (Auth::user()->allTeams()->count() > 1)
                            <div class="border-t border-gray-200"></div>

                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Switch Teams') }}
                            </div>

                            @foreach (Auth::user()->allTeams() as $team)
                                <x-switchable-team :team="$team" component="responsive-nav-link" />
                            @endforeach
                        @endif
                    @endif
                </div>
            @endauth
        </div>
    </div>
</nav>
