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

        <form method="POST" action="{{ route('third-register') }}" enctype="multipart/form-data">
            @csrf

            <div class="mt-4">
                <div id="imagePreview" class="flex items-center justify-center mt-4 m-auto rounded-full overflow-hidden" style="width: 200px; height: 200px;"></div>
                <div class="flex flex-col items-center justify-center mt-3">
                    <label for="profile_photo" class="btn text-center text-sm px-2 py-1 rounded-full" style="background-color: #E2E2E2;">Одбери слика</label>
                    <input id="profile_photo" name="profile_photo" style="visibility:hidden;" type="file" onchange="previewImage(this)">
                </div>
            </div>

            <div class="mt-4">
                <x-label for="address" :value="__('Адреса')" />
                <x-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" />
            </div>

            <div class="mt-4">
                <x-label for="phone" :value="__('Телефонски Број')" />
                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" />
            </div>

            <div class="mt-4">
                <x-label for="biography" :value="__('Биографија')" />
                <textarea name="biography" id="biography"  class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm" cols="30" rows="3" :value="old('biography')" style="background-color: unset"></textarea>
            </div>

            <div class="flex items-center justify-left mt-5 w-56">
                <x-button>
                    {{ __('Заврши') }}
                </x-button>
            </div>
            <div class="mt-4">
                <x-button class="items-start underline bg-transparent border border-transparent rounded-xl font-semibold text-sm text-black tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" style="color: black; padding: 0px; width: 0px;"> {{ __('Прескокни') }} </x-button>
            </div>
        </form>
    </x-authentication-card-register>
</x-guest-layout>

<script>
    function previewImage(input) {
        var preview = document.getElementById('imagePreview');
        preview.innerHTML = '';
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var img = document.createElement('img');
                img.setAttribute('src', e.target.result);
                img.setAttribute('class', 'rounded-full');
                img.setAttribute('style', 'width: 100%; height: 100%; object-fit: cover;');
                preview.appendChild(img);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

