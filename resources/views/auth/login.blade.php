<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form id="loginForm" class="login-form z-50" method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-700" />
            <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" placeholder="tu_email@gmail.com" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" class="text-gray-700" />
            <x-text-input id="password" class="block w-full" type="password" name="password" placeholder="contraseña" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

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

        <div class="flex flex-wrap items-center justify-end mt-4 gap-2">
            <x-primary-button type="button" class="w-full sm:w-auto mr-1 ml-1" onclick="openRegisterModal()">
                {{ __('Regístrate') }}
            </x-primary-button>
            <x-primary-button class="w-full sm:w-auto mr-1 ml-1 bg-blue-400" type="submit">
                {{ __('Iniciar Sesión') }}
            </x-primary-button>
            <x-primary-button type="button" class="w-full sm:w-auto mr-1 ml-1 bg-gray-400" onclick="continueAsGuest()">
                {{ __('Continuar como Invitado') }}
            </x-primary-button>
        </div>

    </form>

    <script>
        function continueAsGuest() {
            const form = document.createElement('form');
            form.method = 'POST';
            form.innerHTML = `
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="email" value="asistente@gmail.com">
                <input type="hidden" name="password" value="12345678">
            `;
            document.body.appendChild(form);
            form.submit();
        }

        function openRegisterModal() {
            document.getElementById('registerModal').classList.remove('hidden');
        }

        function closeRegisterModal() {
            document.getElementById('registerModal').classList.add('hidden');
        }

    </script>
</x-guest-layout>
