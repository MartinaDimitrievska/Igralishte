<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3"></script>

        <!-- Styles -->
        @livewireStyles

        <style>
            .size-label {
                display: inline-block;
                margin-right: 8px;
            }

            .size-square {
                width: 30px;
                height: 30px;
                border-radius: 4px;
                display: flex;
                justify-content: center;
                align-items: center;
                cursor: pointer;
            }

            .size-square.selected {
                background-color: #8A8328 !important;
                color: white;
            }

            .colors.inline-block {
                display: inline-block;
            }

            .colors.selected {
                border: 2px solid black;
            }

            .plus-icon {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                font-size: 2rem;
            }
            .image-slider {
                display: flex;
                transition: transform 0.3s ease-in-out;
            }

            .image-slider img {
                flex: 0 0 auto;
            }

            .image-slider img.hidden {
                display: none;
            }

            #prevBtn, #nextBtn {
                padding: 0px 6px;
            }

            .cormorant-garamond-medium {
                font-family: "Cormorant Garamond", serif;
                font-weight: 500;
                font-style: normal;
            }

            .inter-regular {
                font-family: "Inter", sans-serif;
                font-optical-sizing: auto;
                font-weight: 400;
                font-style: normal;
                font-variation-settings:
                    "slnt" 0;
            }
        </style>
    </head>
    <body
        class="inter-regular antialiased bg-white dark:bg-slate-900 text-black dark:text-slate-400"
        :class="{ 'sidebar-expanded': sidebarExpanded }"
        x-data="{ sidebarOpen: false, sidebarExpanded: localStorage.getItem('sidebar-expanded') == 'true' }"
        x-init="$watch('sidebarExpanded', value => localStorage.setItem('sidebar-expanded', value))"
    >
        <!-- Page wrapper -->
        <div class="flex h-[100dvh] overflow-hidden">

            @if (!in_array(Route::currentRouteName(), ['products.create', 'products.edit', 'discounts.create', 'discounts.edit', 'brands.create', 'brands.edit', 'dashboard']))
                <x-app.sidebar />
            @endif

            <!-- Content area -->
            <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden @if(!in_array(Route::currentRouteName(), ['products.create', 'products.edit', 'discounts.create', 'discounts.edit', 'brands.create', 'brands.edit', 'dashboard'])) ml-16 @endif" x-ref="contentarea">

                @if (in_array(Route::currentRouteName(), ['dashboard']))
                    <x-app.user-header />
                @elseif(in_array(Route::currentRouteName(), ['products.create', 'products.edit', 'discounts.create', 'discounts.edit', 'brands.create', 'brands.edit', 'profile.edit']))
                @else
                    <x-app.header />
                @endif

                <main class="grow">
                    <x-validation-errors class="mb-4 ml-7" />

                    @if (session('status'))
                        <div class="mb-4 ml-7 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-4 ml-7 font-medium text-sm text-red-600">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{ $slot }}
                </main>
            </div>
        </div>

        @livewireScripts
    </body>
</html>

<script>
    if (localStorage.getItem('sidebar-expanded') == 'true') {
        document.querySelector('body').classList.add('sidebar-expanded');
    } else {
        document.querySelector('body').classList.remove('sidebar-expanded');
    }
</script>
