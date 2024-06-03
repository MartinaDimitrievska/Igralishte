<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Discount') }}
        </h2>
    </x-slot>

    <div class="py-5 h-full">
        <div class="max-w-7xl mx-4 sm:px-6 lg:px-8">
            <div>
                <form method="POST" action="{{ route('discounts.update', $discount->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="columns-2 flex justify-between">
                        <a href="{{ route('discounts') }}" class="text-gray-500 hover:text-gray-700">
                            <div>
                                <i class="fa-solid fa-arrow-left"></i>
                                <span class="text-gray-700 font-medium" style="font-size: 20px;">Попуст/промо код</span>
                            </div>
                        </a>
                        <div class="mb-2">
                            <select name="status" id="status" class="rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option>Статус</option>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}" {{ $discount->status->id == $status->id ? 'selected' : '' }}>{{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-2">
                            <x-label for="name" class="block text-sm font-medium text-gray-700" :value="__('Име на попуст/промо код')" />
                            <x-input type="text" name="name" id="name" class="mt-1 p-2 border rounded-md w-full" value="{{ $discount->name }}" autofocus />
                        </div>
                        <div class="mb-2">
                            <x-label for="discount" class="block text-sm font-medium text-gray-700" :value="__('Попуст')" />
                            <x-input type="text" name="discount" id="discount" class="mt-1 p-2 border rounded-md w-full" value="{{ $discount->discount }}" />
                        </div>
                    </div>
                    <div class="mb-2">
                        <x-label for="discount_category_id" class="block text-sm font-medium text-gray-700" :value="__('Категорија')" />
                        <div class="columns-2">
                            <select name="discount_category_id" id="discount_category_id" class="border-gray-300 shadow-sm  mt-1 p-2 border rounded-md w-full" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $discount->discount_category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-2">
                        <x-label for="products" class="block text-sm font-medium text-gray-700">{{ __('Постави попуст на') }}</x-label>
                        <div class="flex flex-wrap mb-2" id="productsContainer">
                            @foreach ($products as $product)
                                <span class="product-id mr-2 mb-2 cursor-pointer border-2 rounded-md px-2 py-1" onclick="addProductId('{{ $product->id }}')">{{ $product->id }}</span>
                            @endforeach
                        </div>
                        <input type="text" id="products" name="products" class="mt-1 p-2 border-gray-300 rounded-md w-full" placeholder="Внесете го бројот на продуктот" value="{{ implode(', ', $discount->products->pluck('id')->toArray()) }}" />
                    </div>
                    <div class="flex" style="bottom: 0;
                    position: absolute;
                    width: 84%;
                    margin-bottom: 30px;">
                        <x-button>
                            {{ __('Зачувај') }}
                        </x-button>
                        <a href="{{ route('discounts')}}" class="text-black mt-2 ml-3" style="text-decoration: underline">Откажи</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const productIds = document.querySelectorAll('.product-id');
        productIds.forEach(function(productId) {
            productId.addEventListener('click', function() {
                addProductId(productId.textContent);
            });
        });
    });

    function addProductId(productId) {
        const productsInput = document.getElementById('products');
        const currentProducts = productsInput.value.trim().split(',').map(product => product.trim());

        if (!currentProducts.includes(productId.trim())) {
            productsInput.value += (productsInput.value.trim() !== '' ? ', ' : '') + productId.trim();
        }
    }
</script>
