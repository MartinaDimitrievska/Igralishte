<x-guest-layout>
    <x-authentication-card-admin>
        <x-slot name="logo">
            <x-authentication-card-logo-admin />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 font-medium text-sm text-red-600">
                {{ session('error') }}
            </div>
        @endif

        <div class="mt-32">
            <form method="POST" action="{{ route('admin.login') }}">
                @csrf

                <div>
                    <x-label for="email" :value="__('Email адреса')" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                </div>

                <div class="mt-4">
                    <x-label for="password" :value="__('Лозинка')" />
                    <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
                </div>

                <div class="block mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}" style="color: #8A8328">
                            {{ __('Ја заборави лозинката?') }}
                        </a>
                    @endif
                </div>

                <div class="flex items-center justify-center mt-4">
                    <x-button>
                        {{ __('Логирај се') }}
                    </x-button>
                </div>

            </form>
        </div>

        <div class="flex items-center justify-center mt-32">
            <p class="text-xs">Сите права задржани © Игралиште Скопје</p>
        </div>
    </x-authentication-card-admin>
</x-guest-layout>
