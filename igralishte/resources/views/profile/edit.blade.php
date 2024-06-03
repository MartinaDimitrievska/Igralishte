<x-app-layout>
        <x-validation-errors class="mb-4" />

        <div class="mx-10">

            <h4 class="font-medium fs-3 mt-4">Мој профил</h4>

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf

                <!-- Profile Photo -->
                <div class="mt-4">
                    @if(auth()->user()->profile_photo_path)
                        <img id="previewImage" src="{{ asset(auth()->user()->profile_photo_path) }}" alt="Profile Photo" class="flex items-start justify-start mt-4 rounded-full object-cover h-24 w-24 overflow-hidden">
                    @else
                        <img id="previewImage" src="#" alt="Profile Photo" class="flex items-start justify-start mt-4 rounded-full object-cover h-24 w-24 overflow-hidden" style="display: none;">
                    @endif

                    <div class="flex flex-col items-start justify-start mt-3">
                        <label for="profile_photo" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" style="color: #8A8328">Промени слика</label>
                        <input id="profile_photo" name="profile_photo" style="visibility:hidden;" type="file" accept="image/*" onchange="previewProfilePhoto(event)">
                    </div>
                </div>

                <!-- Name -->
                <div>
                    <x-label for="name" :value="__('Име')" />
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="auth()->user()->name" required autofocus />
                </div>

                <!-- Email -->
                <div class="mt-4">
                    <x-label for="email" :value="__('Email адреса')" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="auth()->user()->email" required />
                </div>

                <!-- Phone -->
                <div class="mt-4">
                    <x-label for="phone" :value="__('Телефонски број')" />
                    <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="auth()->user()->phone" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Лозинка')" />
                    <x-input id="password" class="block mt-1 w-full" type="password" value="***********" readonly/>
                </div>

                <div class="block mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}" style="color: #8A8328">
                            {{ __('Промени лозинка') }}
                        </a>
                    @endif
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button>
                        {{ __('Зачувај') }}
                    </x-button>
                </div>
            </form>
        </div>
</x-app-layout>

<script>
    function previewProfilePhoto(event) {
        var preview = document.getElementById('previewImage');
        var file = event.target.files[0];
        var reader = new FileReader();
        reader.onloadend = function() {
            preview.src = reader.result;
            preview.style.display = 'block';
        }
        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = '';
            preview.style.display = 'none';
        }
    }
</script>
