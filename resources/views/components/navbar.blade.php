<nav x-data="{ open: false }" class="bg-gray-200 dark:bg-gray-900 shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('index') }}">
                        <x-application-logo class="block h-10 w-auto text-gray-400" />
                    </a>
                </div>

                <!-- NAVBAR DINAMICO, POR ROLES -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @if(auth()->check())
                    @switch(auth()->user()->role)
                    @case('administrador')

                    <x-nav-link :href="route('admin.events')" :active="request()->routeIs('admin.events')">
                        {{ __('Eventos') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.users')" :active="request()->routeIs('admin.users.*')">
                        {{ __('Usuarios') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.category')" :active="request()->routeIs('admin.category.*')">
                        {{ __('Categoría') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.experiences')" :active="request()->routeIs('admin.experiences.*')">
                        {{ __('Experiencias') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.company')" :active="request()->routeIs('admin.company.*')">
                        {{ __('Empresas') }}
                    </x-nav-link>
                    @break

                    @case('creador_eventos')
                    <x-nav-link :href="route('creator.dashboard')" :active="request()->routeIs('creator.dashboard')">
                        {{ __('Mis Eventos') }}
                    </x-nav-link>
                    <x-nav-link :href="route('creator.dashboard')" :active="request()->routeIs('creator.events')">
                        {{ __('Crear') }}
                    </x-nav-link>
                    <x-nav-link :href="route('creator.dashboard')" :active="request()->routeIs('creator.events')">
                        {{ __('Ver Eventos') }}
                    </x-nav-link>
                    <x-nav-link :href="route('creator.dashboard')" :active="request()->routeIs('creator.events')">
                        {{ __('Eliminar Eventos o Inscripciones') }}
                    </x-nav-link>
                    @break

                    @default
                    <x-nav-link :href="route('index')" :active="request()->routeIs('dashboard')">
                        {{ __('Inicio') }}
                    </x-nav-link>
                    <x-nav-link :href="route('index')" :active="request()->routeIs('agenda')">
                        {{ __('Agenda') }}
                    </x-nav-link>
                    <x-nav-link :href="route('index')" :active="request()->routeIs('explora')">
                        {{ __('Explora') }}
                    </x-nav-link>
                    <x-nav-link :href="route('index')" :active="request()->routeIs('experiencias')">
                        {{ __('Expreriencias') }}
                    </x-nav-link>
                    @endswitch
                    @endif
                    <!-- Enlaces adicionales que son comunes a todos los roles -->
                </div>
            </div>
            <!-- Settings Dropdown -->
            <div x-data="{ isDropdownOpen: false }" class="relative hidden sm:flex sm:items-center sm:ml-6">
                <!-- Trigger -->
                <button @click="isDropdownOpen = !isDropdownOpen" @keydown.escape="isDropdownOpen = false" class="flex items-center space-x-2 text-sm text-gray-200 hover:text-gray-800 focus:outline-none transition">
                    <span class="hidden md:inline-block font-medium">{{ Auth::user()->name }}</span>
                    <!-- Icono de flecha hacia abajo (opcional) para indicar que es un dropdown -->
                    <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="isDropdownOpen" ... @click.away="isDropdownOpen = false" class="absolute z-50 w-48 rounded-md shadow-lg origin-top-right right-0" style="display: none; top: 3rem;">
                    <div class="rounded-md ring-1 ring-black ring-opacity-5 py-1 bg-white shadow-xs">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Perfil</a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Cerrar Sesión</a>
                    </div>
                </div>
            </div>

            <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                @csrf
            </form>


            <!-- Mobile menu button -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-800 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if(auth()->check())
            @switch(auth()->user()->role)
            @case('creador_eventos')
            <!-- Creador de eventos -->
            <x-responsive-nav-link :href="route('creator.dashboard')" :active="request()->routeIs('creator.dashboard')">
                {{ __('Mis Eventos') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('creator.dashboard')" :active="request()->routeIs('creator.create')">
                {{ __('Crear Evento') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('creator.dashboard')" :active="request()->routeIs('creator.dashboards')">
                {{ __('Ver Eventos') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('creator.dashboard')" :active="request()->routeIs('creator.dashboards')">
                {{ __('Eliminar Eventos') }}
            </x-responsive-nav-link>

            <!-- Administrador -->
            @break
            @case('administrador')
            <x-responsive-nav-link :href="route('admin.events')" :active="request()->routeIs('admin.events')">
                {{ __('Eventos') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.users')" :active="request()->routeIs('admin.users')">
                {{ __('Usuarios') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.category')" :active="request()->routeIs('admin.category')">
                {{ __('Categoria') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.experiences')" :active="request()->routeIs('admin.experiences')">
                {{ __('Experiencias') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.company')" :active="request()->routeIs('admin.company')">
                {{ __('Empresas') }}
            </x-responsive-nav-link>
            @break
            @default
            <!-- Usuarios -->
            <x-responsive-nav-link :href="route('index')" :active="request()->routeIs('homepage')">
                {{ __('Inicio') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('index')" :active="request()->routeIs('agenda')">
                {{ __('Agenda') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('index')" :active="request()->routeIs('explore')">
                {{ __('Explora') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('index')" :active="request()->routeIs('experiences')">
                {{ __('Experiencias') }}
            </x-responsive-nav-link>
            <!-- Más enlaces accesibles para usuarios generales o asistentes -->
            @endswitch
            @endif
        </div>
    </div>
</nav>
