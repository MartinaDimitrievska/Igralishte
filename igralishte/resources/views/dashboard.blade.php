<x-app-layout>
    <x-authentication-card-admin>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="text-center">
            <p>Добредојде, {{ Auth::user()->name }}</p>
            <a href="#" class="underline decoration-solid">Дојди на игралиште</a>
        </div>
    </x-authentication-card-admin>
</x-app-layout>
