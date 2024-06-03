<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="email" :value="__('Email адреса')" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-label for="password" :value="__('Лозинка')" />
                <x-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required />
            </div>

            <div class="flex items-center justify-center mt-4">
                <x-button>
                    {{ __('Регистрирај се') }}
                </x-button>
            </div>

            <div class="flex items-center justify-center my-6">
                <p>или</p>
            </div>

            <div class="flex items-center justify-center my-6">
                <a href="{{ route('auth.google') }}" class="w-full items-center px-4 py-3 border border-transparent rounded-xl font-semibold text-xs text-black text-center tracking-widest hover:bg-rose-200 focus:bg-rose-200 active:bg-rose-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" style="border: 3px solid #FFDBDB">
                    <i class="fa-brands fa-google"></i>
                    Регистрирај се преку Google
                 </a>
            </div>

            <div class="flex items-center justify-center my-6">
                <a href="{{ route('auth.facebook') }}" class="w-full items-center px-3 py-3 border border-transparent rounded-xl font-semibold text-xs text-black text-center tracking-widest hover:bg-rose-200 focus:bg-rose-200 active:bg-rose-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" style="border: 3px solid #FFDBDB">

                    <i class="fa-brands fa-facebook"></i>
                    Регистрирај се преку Facebook
                </a>
            </div>

            <div class="flex items-center justify-center my-6">
                <p>Веќе имаш профил? <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}" style="color: #8A8328">
                    {{ __('Логирај се') }}
                </a></p>
            </div>
        </form>
        <div class="flex items-center justify-center mt-32">
            <p class="text-xs">Сите права задржани © Игралиште Скопје</p>
        </div>
    </x-authentication-card>
</x-guest-layout>
