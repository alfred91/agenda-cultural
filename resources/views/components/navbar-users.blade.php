<!-- resources/views/components/navbar-users.blade.php -->
<nav class="bg-red-600 shadow fixed min-w-full z-50" x-data="{ open: false } ">
    <div class=" max-w-7xl h-20 mx-auto px-4 sm:px-6 lg:px-8 ">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center mr-10">
                    <a href="{{ route('user.index') }}">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <x-application-logo class="block h-10 w-auto text-gray-400" />
                            <h1 class="block h-10 w-auto text-2xl mt-6 ml-2 text-white">GARRUCHA
                                <p class="text-xs text-gray-950">CITY OF GASTRONOMY</p>
                            </h1>
                        </div>
                    </a>
                </div>
                <div class="hidden sm:block mt-4 sm:ml-6">
                    <div class="flex space-x-4">
                        <a href="{{ route('user.index') }}" class="px-3 py-2 rounded-md text-lg font-medium text-white uppercase hover:bg-red-600 custom-hover">Inicio</a>
                        <a href="{{ route('user.agenda') }}" class="px-3 py-2 rounded-md text-lg font-medium text-white uppercase hover:bg-red-600 custom-hover">Agenda</a>
                        <a href="{{ route('user.explore') }}" class="px-3 py-2 rounded-md text-lg font-medium text-white uppercase hover:bg-red-600 custom-hover">Explora</a>
                        <a href="{{ route('user.experiences') }}" class="px-3 py-2 rounded-md text-lg font-medium text-white uppercase hover:bg-red-600 custom-hover">Experiencias</a>
                    </div>
                </div>
            </div>
            <!-- Settings Dropdown -->
            <div x-data="{ isDropdownOpen: false }" class="relative hidden sm:flex sm:items-center sm:ml-6">
                <!-- Trigger -->
                <button @click="isDropdownOpen = !isDropdownOpen" @keydown.escape="isDropdownOpen = false" class="flex items-center space-x-2 text-sm text-white hover:text-gray-200 focus:outline-none transition">
                    <span class="hidden md:inline-block font-medium">{{ Auth::user()->name }}</span>
                    <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                <!-- Dropdown Menu -->
                <div x-show="isDropdownOpen" @click.away="isDropdownOpen = false" class="absolute z-50 w-48 rounded-md shadow-lg origin-top-right right-0" style="display: none; top: 3rem;">
                    <div class="rounded-md ring-1 ring-black ring-opacity-5 py-1 bg-white shadow-xs">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Cerrar Sesión</a>
                    </div>
                </div>
            </div>
            <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                @csrf
            </form>
            <div class="-mr-2 flex sm:hidden">
                <!-- Mobile menu button -->
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-gray-500 hover:bg-red-600 focus:outline-none focus:bg-red-600 focus:text-gray-500">
                    <svg class="h-6 w-6" x-show="!open" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                    <svg class="h-6 w-6" x-show="open" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden" x-show="open" @click.away="open = false">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('user.agenda') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-gray-900 hover:bg-red-600">Inicio</a>
            <a href="{{ route('user.agenda') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-gray-900 hover:bg-red-600">Agenda</a>
            <a href="{{ route('user.agenda') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-gray-900 hover:bg-red-600">Explora</a>
            <a href="{{ route('user.agenda') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-gray-900 hover:bg-red-600">Experiencias</a>
        </div>
    </div>
</nav>
