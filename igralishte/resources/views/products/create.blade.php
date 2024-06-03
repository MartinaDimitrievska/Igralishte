<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Product') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-4 mr-4 sm:px-6 lg:px-8">
            <div>
                <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="columns-2 flex justify-between">
                        <a href="{{ route('products') }}" class="text-gray-500 hover:text-gray-700">
                            <div>
                                <i class="fa-solid fa-arrow-left"></i>
                                <span class="text-gray-700 font-medium" style="font-size: 20px;">Продукт</span>
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
                            <x-label for="name" class="block text-sm font-medium text-gray-700" :value="__('Име на продукт')" />
                            <x-input type="text" name="name" id="name" class="mt-1 p-2 border rounded-md w-full" autofocus />
                        </div>
                        <div class="mb-2">
                            <x-label for="description" class="block text-sm font-medium text-gray-700" :value="__('Опис')" />
                            <textarea name="description" id="description" rows="3" class="mt-1 p-2 border rounded-md w-full rounded-lg border-gray-300 shadow-sm"></textarea>
                        </div>
                        <div class="mb-2">
                            <x-label for="price" class="block text-sm font-medium text-gray-700" :value="__('Цена')" />
                            <x-input type="text" name="price" id="price" class="mt-1 p-2 border rounded-md w-full" />
                        </div>
                        <div class="mb-2">
                            <x-label for="quantity" class="block text-sm font-medium text-gray-700">{{ __('Количина') }}</x-label>
                            <div class="flex items-center">
                                <button type="button" onclick="decreaseQuantity()" class="px-3 py-1 border border-gray-300 rounded-full">-</button>
                                <input type="number" id="quantity" name="quantity" class="w-11 no-scrollbar pl-4 pr-1 border-none" value="1" min="1">
                                <button type="button" onclick="increaseQuantity()" class="px-3 py-1 border border-gray-300 rounded-full">+</button>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center space-x-4">
                                <x-label for="size" class="block text-sm font-medium text-gray-700">{{ __('Величина') }}</x-label>
                                <div class="flex">
                                    @foreach ($sizes as $size)
                                        <label for="size_{{ $size->id }}" class="size-label">
                                            <input type="checkbox" id="size_{{ $size->id }}" name="sizes[]" value="{{ $size->id }}" class="hidden">
                                            <div class="size-square" style="background-color: #FFDBDB">{{ $size->name }}</div>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="mt-2">
                                <x-label for="size_advice" class="block text-sm font-medium text-gray-700">{{ __('Совет за величина') }}</x-label>
                                <textarea id="size_advice" name="size_advice" rows="3" class="mt-1 rounded-md border-gray-300 w-full focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                            </div>
                        </div>
                        <div>
                        <x-label for="colors" class="block text-sm font-medium text-gray-700">{{ __('Боја') }}</x-label>
                        <div class="flex flex-wrap mb-4">
                            @foreach ($colors as $color)
                                @php
                                    $colorCode = '';
                                    switch(strtolower($color->name)) {
                                        case 'red':
                                            $colorCode = '#FF0000';
                                            break;
                                        case 'orange':
                                            $colorCode = '#FFA500';
                                            break;
                                        case 'yellow':
                                            $colorCode = '#FFFF00';
                                            break;
                                        case 'green':
                                            $colorCode = '#008000';
                                            break;
                                        case 'blue':
                                            $colorCode = '#0000FF';
                                            break;
                                        case 'pink':
                                            $colorCode = '#FFC0CB';
                                            break;
                                        case 'purple':
                                            $colorCode = '#800080';
                                            break;
                                        case 'gray':
                                            $colorCode = '#808080';
                                            break;
                                        case 'white':
                                            $colorCode = '#FFFFFF';
                                            break;
                                        case 'black':
                                            $colorCode = '#000000';
                                            break;
                                    }
                                @endphp
                                <label for="color_{{ $color->id }}" class="colors inline-block w-6 h-6 mr-2 mt-1 rounded-lg cursor-pointer border-2 border-gray-200 shadow-sm" style="background-color: {{ $colorCode }}"></label>
                                <input type="checkbox" id="color_{{ $color->id }}" name="colors[]" value="{{ $color->id }}" class="hidden">
                            @endforeach
                        </div>
                        <div class="mb-2">
                            <x-label for="maintenance" class="block text-sm font-medium text-gray-700" :value="__('Насоки за одржување')" />
                            <textarea id="maintenance" name="maintenance" rows="3" class="mt-1 rounded-md border-gray-300 w-full focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
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
                        <div class="columns-2">
                            <div class="mb-4">
                                <x-label for="product_category_id" class="block text-sm font-medium text-gray-700" :value="__('Категорија')" />
                                <select name="product_category_id" id="product_category_id" class="border-gray-300 shadow-sm  mt-1 p-2 border rounded-md w-full">
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <x-label for="brand_id" class="block text-sm font-medium text-gray-700" :value="__('Бренд')" />
                                <select name="brand_id" id="brand_id" class="border-gray-300 shadow-sm mt-1 p-2 border rounded-md w-full">
                                    @foreach ($brands as $brand)
                                        @if($brand->status->name == 'Active')
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="flex">
                        <x-button>
                            {{ __('Зачувај') }}
                        </x-button>
                        <a href="{{ route('products')}}" class="text-black mt-2 ml-3" style="text-decoration: underline">Откажи</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function increaseQuantity() {
        var quantityInput = document.getElementById('quantity');
        quantityInput.stepUp();
    }

    function decreaseQuantity() {
        var quantityInput = document.getElementById('quantity');
        quantityInput.stepDown();
    }
    const colorCheckboxes = document.querySelectorAll('input[name="colors[]"]');

    colorCheckboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            const colorLabel = checkbox.previousElementSibling;
            colorLabel.classList.toggle('selected', checkbox.checked);
        });
    });

    const sizeCheckboxes = document.querySelectorAll('input[name="sizes[]"]');

    sizeCheckboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            const sizeSquare = checkbox.nextElementSibling;
            sizeSquare.classList.toggle('selected', checkbox.checked);
        });
    });

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
