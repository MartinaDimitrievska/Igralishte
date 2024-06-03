<x-guest-layout>
    <x-authentication-card-register>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('second-register') }}">
            @csrf

            <div class="mt-4">
                <x-label for="name" :value="__('Име')" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
            </div>

            <div class="mt-4">
                <x-label for="surname" :value="__('Презиме')" />
                <x-input id="surname" class="block mt-1 w-full" type="text" name="surname" :value="old('surname')" required />
            </div>

            <div class="mt-4">
                <x-label for="email" :value="__('Email адреса')" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $oldData['email'] ?? '')" required />
            </div>

            <div class="mt-4">
                <x-label for="password" :value="__('Лозинка')" />
                <x-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            :value="old('password', $oldData['password'] ?? '')"
                            required />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Повтори лозинка')" />
                <x-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation"
                            :value="old('password_confirmation')"
                            required />
            </div>
            <div class="flex items-center justify-start mt-4">
                <i class="fa-regular fa-circle-check"></i>
                <p class="text-xs ml-2"> Испраќај ми известувања за нови зделки и промоции.</p>
            </div>

            <div class="flex items-center justify-left mt-28 w-56">
                <x-button>
                    {{ __('Регистрирај се') }}
                </x-button>
            </div>

            <div class="flex items-center justify-center mt-8">
                <p class="text-xs">Со вашата регистрација, се согласувате со <a class="underline text-sm text-black hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="#"> Правилата и Условите </a> за кориснички сајтови.</p>
            </div>
        </form>
    </x-authentication-card-register>
</x-guest-layout>
