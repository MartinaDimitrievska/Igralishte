<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Brand List') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl ml-10 mr-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4 flex justify-end">
                <a href="{{ route('brands.create') }}" class="text-black py-2 px-4">
                    {{ __('Додај нов бренд') }}
                    <span class="px-2 py-1 text-white text-xl shadow-md font-bold rounded-lg" style="background-color: #8A8328; background-image: linear-gradient(to right, #8A8328 , #b3ae76)">+</span>
                </a>
            </div>

            <div id="listView" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
                <div class="columns-1">
                <p class="text-md">Активни</p>
                    @foreach ($brands as $brand)
                        @if($brand->status->name == 'Active')
                            <div class="my-2 border-2 items-center border-slate-100 bg-slate-50 p-2 rounded-lg flex">
                                <div class="flex items-center w-full justify-between">
                                    <span class="ml-3">{{ $brand->name }}</span>
                                    <a href="{{ route('brands.edit', ['brand' => $brand->id]) }}" class="text-black py-2 px-4">
                                        <div class="rounded-full bg-white border-2 border-slate-200 px-3 py-2">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="columns-1">
                <p class="text-md">Архива</p>
                    @foreach ($brands as $brand)
                        @if($brand->status->name == 'Archived')
                            <div class="my-2 border-2 items-center border-slate-100 bg-slate-50 bg-opacity-30 p-2 rounded-lg flex">
                                <div class="flex items-center w-full justify-between">
                                    <span class="ml-3 text-gray-300">{{ $brand->name }}</span>
                                    <a href="{{ route('brands.edit', ['brand' => $brand->id]) }}" class="text-black py-2 px-4">
                                        <div class="rounded-full bg-white border-2 border-slate-200 px-3 py-2">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
