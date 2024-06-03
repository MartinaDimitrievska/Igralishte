<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Brand') }}
        </h2>
    </x-slot>

    <div class="py-5 h-full">
        <div class="max-w-7xl mx-4 sm:px-6 lg:px-8">
            <div>
                <form method="POST" action="{{ route('brands.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="columns-2 flex justify-between">
                        <a href="{{ route('brands') }}" class="text-gray-500 hover:text-gray-700">
                            <div>
                                <i class="fa-solid fa-arrow-left"></i>
                                <span class="text-gray-700 font-medium" style="font-size: 20px;">Бренд</span>
                            </div>
                        </a>
                        <div class="mb-2 ">
                            <select name="status" id="status" class="rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option>Статус</option>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-2">
                            <x-label for="name" class="block text-sm font-medium text-gray-700" :value="__('Име на бренд')" />
                            <x-input type="text" name="name" id="name" class="mt-1 p-2 border rounded-md w-full" autofocus />
                        </div>
                        <div class="mb-2">
                            <x-label for="description" class="block text-sm font-medium text-gray-700" :value="__('Опис')" />
                            <textarea name="description" id="description" rows="3" class="mt-1 p-2 border rounded-md w-full rounded-lg border-gray-300 shadow-sm"></textarea>
                        </div>
                        <div class="mb-2">
                            <x-label for="tags" class="block text-sm font-medium text-gray-700">{{ __('Ознаки') }}</x-label>
                            <div class="flex flex-wrap mb-2" id="tagsContainer">
                                @foreach ($tags as $tag)
                                    <span class="tag mr-2 mb-2 cursor-pointer border-2 rounded-md px-2 py-1" onclick="addTag('{{ $tag->name }}')">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                            <input type="text" id="tags" name="tags" class="mt-1 p-2 border-gray-300 rounded-md w-full" placeholder="Внесете ознаки со #" />
                        </div>
                        <div class="flex m-1">
                            @for ($i = 0; $i < 4; $i++)
                                <div class="relative bg-slate-100 py-5 px-6 my-2 mr-2" id="imageBox{{$i}}" style="width: 100px; height: 80px;">
                                    <input type="file" name="images[]" id="fileInput{{$i}}" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*" onchange="previewImage(event, {{$i}})" multiple>
                                    <span class="plus-icon">+</span>
                                    <img id="imagePreview{{$i}}" class="w-full h-full object-cover hidden mr-5" src="#" alt="">
                                </div>
                            @endfor
                        </div>
                    </div>
                    <div class="mb-4 relative" x-data="{ open: false }">
                        <x-label for="product_category_id" class="block text-sm font-medium text-gray-700" :value="__('Категорија')" />
                        <div>
                            <div @click.away="open = open">
                                <button @click="open = !open" type="button" class="w-full border-gray-300 flex justify-between shadow-sm mt-1 p-2 border rounded-md appearance-none">
                                    Одбери
                                    <i class="fa-solid fa-chevron-down fa-xs mt-3"></i>
                                </button>
                            </div>
                            <div x-show="open" class="absolute z-10 mt-1 w-full rounded-md bg-white shadow-lg">
                                <select name="categories[]" id="product_category_id" class="border-gray-300 shadow-sm mt-1 p-2 border rounded-md w-full flex justify-between " multiple>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" class="mb-2">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="flex" style="bottom: 0;
                    position: absolute;
                    width: 84%;
                    margin-bottom: 30px;">
                        <x-button>
                            {{ __('Зачувај') }}
                        </x-button>
                        <a href="{{ route('brands')}}" class="text-black mt-2 ml-3" style="text-decoration: underline">Откажи</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function previewImage(event, index) {
        const input = event.target;
        const reader = new FileReader();
        reader.onload = function () {
            const preview = document.getElementById(`imagePreview${index}`);
            const imageBox = document.getElementById(`imageBox${index}`);
            preview.src = reader.result;
            preview.classList.remove('hidden');
            input.style.display = 'none';
            const plusIcon = imageBox.querySelector('.plus-icon');
            plusIcon.style.display = 'none';
            imageBox.classList.remove('bg-slate-100', 'py-5', 'px-6', 'm-1');
        };
        reader.readAsDataURL(input.files[0]);
    }

    document.querySelectorAll('[id^="imagePreview"]').forEach(function(img, index) {
        img.addEventListener('click', function() {
            const input = document.getElementById(`fileInput${index}`);
            input.click();
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const tags = document.querySelectorAll('.tag');
        tags.forEach(function(tag) {
            tag.addEventListener('click', function() {
                addTag(tag.textContent);
            });
        });
    });

    function addTag(tagName) {
        const tagsInput = document.getElementById('tags');
        const currentTags = tagsInput.value.trim().split(',').map(tag => tag.trim());

        if (!currentTags.includes(tagName.trim())) {
            tagsInput.value += (tagsInput.value.trim() !== '' ? ', ' : '') + tagName.trim();
        }
    }
</script>
