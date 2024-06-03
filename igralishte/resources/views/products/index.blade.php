<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product List') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl ml-10 mr-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4 flex justify-end">
                <a href="{{ route('products.create') }}" class="text-black py-2 px-4">
                    {{ __('Додај нов продукт') }}
                    <span class="px-2 py-1 text-white text-xl shadow-md font-bold rounded-lg" style="background-color: #8A8328; background-image: linear-gradient(to right, #8A8328 , #b3ae76)">+</span>
                </a>
            </div>

            <!-- List View -->
            <div id="listView" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($products as $product)
                        <div class="product border-2 items-center border-slate-100 bg-slate-50 p-2 rounded-lg flex">
                            <div>
                                <span class="font-bold text-lg" style="color: #8A8328">0{{ $product->id }}</span>
                            </div>
                            <div class="flex items-center w-full justify-between">
                                <span class="ml-3">{{ $product->name }}</span>
                                <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="text-black py-2 px-4">
                                    <div class="rounded-full bg-white border-2 border-slate-200 px-3 py-2">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                @endforeach
            </div>

            <!-- Grid View -->
            <div id="gridView" class="hidden grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($products as $product)
                        <div class="product border-2 border-slate-100 bg-slate-50 p-2 rounded-lg flex flex-col">
                            <div class="mb-2 flex items-center cormorant-garamond-medium">
                                @if ($product->quantity == 1)
                                    <span class="text-sm text-black">*</span>
                                    <span class="text-lg text-black">Само 1 парче</span>
                                @endif
                            </div>
                            <div class="mb-2 items-center">
                                <div class="image-container relative">
                                    <div class="image-slider">
                                        @if ($product->images->count() > 0)
                                            @foreach ($product->images as $image)
                                                <img src="{{ asset($image->image) }}" alt="Product Image" class="w-full h-64 object-cover rounded-lg mb-2 hidden">
                                            @endforeach
                                        @endif
                                    </div>
                                    {{-- Buttons for navigating if multiple images are added --}}
                                    <button class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-white text-black ml-1 rounded-full" id="prevBtn">&lt;</button>
                                    <button class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-white text-black mr-1 rounded-full" id="nextBtn">&gt;</button>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-xl cormorant-garamond-medium">{{ $product->name }}</span>
                                    <span class="text-lg font-extrabold" style="color: #8A8328">0{{ $product->id }}</span>
                                </div>
                            </div>
                            <div class="flex justify-between md:block">
                                <div class="mb-2 flex items-center cormorant-garamond-medium">
                                    <span class="text-md">Боја:</span>
                                    <div class="flex flex-wrap">
                                        @foreach ($product->colors as $color)
                                            <div class="ml-1 w-6 h-6 rounded-lg" style="background-color: {{ $color->name }}"></div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-between cormorant-garamond-medium md:block">
                                <div class="mb-2 flex items-center">
                                    <span class="text-md mr-1">Величина:</span>
                                    <div>
                                        @foreach ($product->sizes as $size)
                                            <span class="text-lg">{{ $size->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="mb-2 flex items-center cormorant-garamond-medium">
                                    <span class="text-md">Цена:</span>
                                    <div>
                                        <span class="mx-2 text-xl ">{{ $product->price }} ден.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endforeach
            </div>
        </div>
    </div>
    <hr class="border-1 border-slate-200 w-full">
    <div id="pagination" class="flex justify-center my-4 text-2xl cormorant-garamond-medium">
        <button id="prevPageBtn" class="mr-2" disabled>&lt;</button>
        <div id="pageNumbers" class="flex"></div>
        <button id="nextPageBtn" class="ml-2">&gt;</button>
    </div>
</x-app-layout>

<script>
    const imageContainers = document.querySelectorAll('.image-container');
    imageContainers.forEach(container => {
        const imageSlider = container.querySelector('.image-slider');
        const images = imageSlider.querySelectorAll('img');
        const prevBtn = container.querySelector('#prevBtn');
        const nextBtn = container.querySelector('#nextBtn');

        if (images.length == 1) {
            prevBtn.classList.add('hidden');
            nextBtn.classList.add('hidden');
        }

        let currentIndex = 0;

        const showImage = (index) => {
            images.forEach(img => img.classList.add('hidden'));
            images[index].classList.remove('hidden');
            currentIndex = index;
        };

        showImage(currentIndex);

        prevBtn.addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            showImage(currentIndex);
        });

        nextBtn.addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % images.length;
            showImage(currentIndex);
        });
    });

    const itemsPerPage=6;
    const totalProducts = {{ $products->count() }};
    const totalPages = Math.ceil(totalProducts / itemsPerPage);
    const paginationContainer = document.getElementById('pagination');
    const pageNumbersContainer = document.getElementById('pageNumbers');
    const prevPageBtn = document.getElementById('prevPageBtn');
    const nextPageBtn = document.getElementById('nextPageBtn');

    let currentPage = 1;

    function showProducts() {
        const start = (currentPage - 1) * itemsPerPage;
        const end = start + itemsPerPage;
        const listViewProducts = document.querySelectorAll('#listView .product');
        const gridViewProducts = document.querySelectorAll('#gridView .product');

        listViewProducts.forEach((product, index) => {
            if (index >= start && index < end) {
                product.style.display = 'flex';
            } else {
                product.style.display = 'none';
            }
        });

        gridViewProducts.forEach((product, index) => {
            if (index >= start && index < end) {
                product.style.display = 'flex';
            } else {
                product.style.display = 'none';
            }
        });
    }

    function updatePagination() {
        pageNumbersContainer.innerHTML = '';
        for (let i = 1; i <= totalPages; i++) {
            const pageNumberBtn = document.createElement('button');
            pageNumberBtn.textContent = i;
            pageNumberBtn.classList.add('px-2', 'py-1');
            pageNumberBtn.addEventListener('click', () => {
                currentPage = i;
                showProducts();
                updatePagination();
            });
            if (i === currentPage) {
                pageNumberBtn.classList.add('text-red-500');
            }
            pageNumbersContainer.appendChild(pageNumberBtn);

            if (i < totalPages) {
                const dot = document.createElement('span');
                dot.textContent = ' . ';
                pageNumbersContainer.appendChild(dot);
            }
        }
        prevPageBtn.disabled = currentPage === 1;
        nextPageBtn.disabled = currentPage === totalPages;
    }

    prevPageBtn.addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            showProducts();
            updatePagination();
        }
    });

    nextPageBtn.addEventListener('click', () => {
        if (currentPage < totalPages) {
            currentPage++;
            showProducts();
            updatePagination();
        }
    });

    document.addEventListener('DOMContentLoaded', () => {
        showProducts();
        updatePagination();
    });

</script>
