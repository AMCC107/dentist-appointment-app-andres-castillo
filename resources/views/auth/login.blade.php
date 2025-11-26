<x-guest-layout>
    <div class="min-h-screen flex flex-col lg:flex-row bg-white">
        <div class="relative w-full lg:w-3/4 h-64 lg:h-auto">
            <img
                src="{{ asset('images/logo_nuevo.png') }}"
                alt="DentalPlus"
                class="absolute top-8 left-8 w-32 drop-shadow-xl"
            >
            <div
                class="w-full h-full bg-cover bg-center"
                style="background-image: url('{{ asset('images/dental-equipment.jpg') }}'); background-size: contain; background-repeat: no-repeat; background-position: center;"
            ></div>
            <div class="absolute inset-0 bg-gradient-to-r from-sky-500/70 via-sky-600/60 to-slate-900/70"></div>
            <div class="absolute inset-0 flex flex-col justify-center px-10 text-white space-y-4">
                <p class="text-sm uppercase tracking-[0.4em]">Clínica dental</p>
                <h1 class="text-4xl font-bold leading-tight">Sonrisas saludables, pacientes felices</h1>
                <p class="text-lg text-white/80 max-w-xl">
                    Gestiona tus citas, pacientes y tratamientos de forma sencilla con DentalPlus.
                </p>
            </div>
        </div>

        <div class="w-full lg:w-1/4 flex items-center justify-center py-10 px-6 bg-white shadow-lg lg:shadow-none">
            <div class="w-full max-w-sm space-y-6">
                <div class="text-center space-y-1">
                    <h2 class="text-2xl font-semibold text-gray-800">Inicia sesión</h2>
                    <p class="text-sm text-gray-500">Accede a tu panel administrativo</p>
                </div>

                <x-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf
                    <div class="space-y-2">
                        <x-label for="email" value="Correo electrónico" />
                        <x-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    </div>

                    <div class="space-y-2">
                        <x-label for="password" value="Contraseña" />
                        <x-input id="password" class="block w-full" type="password" name="password" required autocomplete="current-password" />
                    </div>

                    <div class="flex items-center justify-between text-sm">
                        <label for="remember_me" class="flex items-center gap-2 text-gray-600">
                            <x-checkbox id="remember_me" name="remember"/>
                            <span>Recordarme</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sky-600 hover:text-sky-800 font-medium" href="{{ route('password.request') }}">
                                ¿Olvidaste tu contraseña?
                            </a>
                        @endif
                    </div>

                    <x-button type="submit" class="w-full justify-center bg-sky-600 hover:bg-sky-700">
                        Iniciar sesión
                    </x-button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
