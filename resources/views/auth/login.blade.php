<x-guest-layout>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-700" />
            <x-text-input id="email" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-50 dark:text-gray-50  rounded-t-md focus:outline-none focus:ring-red-500 focus:border-red-500 focus:z-10 sm:text-sm" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" class="text-gray-700" />
            <x-text-input id="password" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-50 dark:text-gray-50 rounded-b-md focus:outline-none focus:ring-red-500 focus:border-red-500 focus:z-10 sm:text-sm" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                    {{ __('Recuérdame') }}
                </label>
            </div>

            @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 hover:text-red-500" href="{{ route('password.request') }}">
                {{ __('Olvidaste la contraseña?') }}
            </a>
            @endif
        </div>

        <div class="flex items-center justify-end mt-4">


            <!-- Botón Regístrate -->
            <x-primary-button class="mr-4 bg-blue-400 dark:bg-blue-600 hover:bg-blue-700 dark:hover:bg-blue-900 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                <a href="{{ route('register') }}" class="inline-flex justify-center w-full h-full">
                    {{ __('Regístrate') }}
                </a>
            </x-primary-button>
            <!-- Botón Iniciar Sesión -->
            <x-primary-button class="bg-blue-400 dark:bg-blue-600 hover:bg-blue-700 dark:hover:bg-blue-900 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                {{ __('Iniciar Sesión') }}
            </x-primary-button>
        </div>

        </div>
    </form>
</x-guest-layout>
