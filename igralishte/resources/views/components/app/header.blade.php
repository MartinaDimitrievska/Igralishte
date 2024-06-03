<header class="sticky top-0 bg-white z-30">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-end h-16 -mb-px">

            <div class="mt-4 relative">
                <input type="text" id="searchInput" placeholder="Пребарувај..." class="px-3 py-1.5 border border-gray-300 rounded-md pr-10 focus:outline-none focus:border-indigo-500" style="width: 228px;">
                <i class="fa-solid fa-magnifying-glass absolute top-0 right-0 my-3 mx-2 text-gray-400"></i>
            </div>

            <div class="flex items-center space-x-3">
                @if (in_array(Route::currentRouteName(), ['products']))
                <div class="flex justify-center mt-4">
                    <button id="gridViewButton" onclick="showGridView()" class="mx-1 px-2 py-1 bg-white border-2 border-slate-200 rounded-md shadow-sm "><i class="fa-solid fa-border-all"></i></button>
                    <button id="listViewButton" onclick="showListView()" class="px-2 py-1 bg-white border-2 border-slate-200 rounded-md shadow-sm "><i class="fa-solid fa-bars"></i></button>
                </div>
                @endif
            </div>

        </div>
    </div>
</header>
<script>

    function isProductsPage() {
        const productsRoutes = ['products'];
        return productsRoutes.includes('{{ Route::currentRouteName() }}');
    }

    document.addEventListener("DOMContentLoaded", function() {
        showListView();
    });

    function showListView() {
        if (isProductsPage()) {
            document.getElementById('listView').style.display = 'grid';
            document.getElementById('gridView').style.display = 'none';

            document.getElementById('listViewButton').style.backgroundColor = '#FFDBDB';
            document.getElementById('gridViewButton').style.backgroundColor = 'white';

            currentPage = 1;
            showProducts();
            updatePagination();
        }
    }

    function showGridView() {
        if (isProductsPage()) {
            document.getElementById('listView').style.display = 'none';
            document.getElementById('gridView').style.display = 'grid';

            document.getElementById('gridViewButton').style.backgroundColor = '#FFDBDB';
            document.getElementById('listViewButton').style.backgroundColor = 'white';

            currentPage = 1;
            showProducts();
            updatePagination();
        }
    }

    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('input', search);

    function search() {
        const searchQuery = searchInput.value.toLowerCase();
        const listView = document.getElementById('listView');
        const gridView = document.getElementById('gridView');

        if (listView) {
            const items = listView.querySelectorAll('.border-slate-100');
            items.forEach(item => {
                const text = item.textContent.toLowerCase();
                if (text.includes(searchQuery)) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        if (gridView) {
            const items = gridView.querySelectorAll('.border-slate-100');
            items.forEach(item => {
                const text = item.textContent.toLowerCase();
                if (text.includes(searchQuery)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }
    }
</script>
