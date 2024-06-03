<div>
    <!-- Sidebar backdrop (mobile only) -->
    <div
        class="fixed inset-0 bg-slate-900 bg-opacity-30 z-40 lg:hidden lg:z-auto transition-opacity duration-200"
        :class="sidebarOpen ? 'opacity-100' : 'opacity-0 pointer-events-none'"
        aria-hidden="true"
        x-cloak
    ></div>

    <!-- Sidebar -->
    <div
    id="sidebar"
    class="flex flex-col absolute z-40 left-0 top-0 lg:static lg:left-auto lg:top-auto lg:translate-x-0 h-screen lg:overflow-y-auto no-scrollbar  lg:w-24 lg:sidebar-expanded:!w-64 2xl:!w-64 shrink-0 bg-white p-4 transition-all duration-200 ease-in-out" style="width:90px"
    @click.outside="sidebarOpen = false"
    @keydown.escape.window="sidebarOpen = false"
    x-cloak="lg"
>
        <div class="flex justify-start mb-10 pr-3 sm:px-2">
            <!-- Profile Photo -->
            @if(Auth::user()->profile_photo_path)
            <img src="{{ asset(auth()->user()->profile_photo_path) }}" alt="Profile Photo" class="ml-2 rounded-full h-12 w-12 object-cover mb-4">
            @endif
            <div class="ml-5 user-info">
            <div class="flex">
                <p class="font-medium">{{ Auth::user()->name }}</p>
                @if(Auth::user()->surname)
                    <p class="font-medium ml-1">{{ Auth::user()->surname }}</p>
                @endif
            </div>
            <p class="text-gray-500">{{ Auth::user()->email }}</p>
            </div>
        </div>

        @if (!in_array(Route::currentRouteName(), ['dashboard']))
        <!-- Links -->
        <div class="space-y-8">
            <div>
                <ul class="mt-3">
                    <!-- Vintage облека -->
                    <li class="px-4 py-3 rounded-md mb-0.5 last:mb-0 @if(Request::url() == route('products')){{ 'bg-rose-200' }}@endif" x-data="{ open: {{ Request::url() == route('products') ? 1 : 0 }} }">
                        <a class="block text-black hover:text-black-400 truncate transition duration-150 @if(Request::url() == route('products')){{ 'hover:text-black-400' }}@endif" href="{{ route('products') }}" @click="open = false" @focus="open = true" @focusout="open = false">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 24 24">
                                        <path d="M 10.490234 2 C 10.011234 2 9.6017656 2.3385938 9.5097656 2.8085938 L 9.1757812 4.5234375 C 8.3550224 4.8338012 7.5961042 5.2674041 6.9296875 5.8144531 L 5.2851562 5.2480469 C 4.8321563 5.0920469 4.33375 5.2793594 4.09375 5.6933594 L 2.5859375 8.3066406 C 2.3469375 8.7216406 2.4339219 9.2485 2.7949219 9.5625 L 4.1132812 10.708984 C 4.0447181 11.130337 4 11.559284 4 12 C 4 12.440716 4.0447181 12.869663 4.1132812 13.291016 L 2.7949219 14.4375 C 2.4339219 14.7515 2.3469375 15.278359 2.5859375 15.693359 L 4.09375 18.306641 C 4.33275 18.721641 4.8321562 18.908906 5.2851562 18.753906 L 6.9296875 18.1875 C 7.5958842 18.734206 8.3553934 19.166339 9.1757812 19.476562 L 9.5097656 21.191406 C 9.6017656 21.661406 10.011234 22 10.490234 22 L 13.509766 22 C 13.988766 22 14.398234 21.661406 14.490234 21.191406 L 14.824219 19.476562 C 15.644978 19.166199 16.403896 18.732596 17.070312 18.185547 L 18.714844 18.751953 C 19.167844 18.907953 19.66625 18.721641 19.90625 18.306641 L 21.414062 15.691406 C 21.653063 15.276406 21.566078 14.7515 21.205078 14.4375 L 19.886719 13.291016 C 19.955282 12.869663 20 12.440716 20 12 C 20 11.559284 19.955282 11.130337 19.886719 10.708984 L 21.205078 9.5625 C 21.566078 9.2485 21.653063 8.7216406 21.414062 8.3066406 L 19.90625 5.6933594 C 19.66725 5.2783594 19.167844 5.0910937 18.714844 5.2460938 L 17.070312 5.8125 C 16.404116 5.2657937 15.644607 4.8336609 14.824219 4.5234375 L 14.490234 2.8085938 C 14.398234 2.3385937 13.988766 2 13.509766 2 L 10.490234 2 z M 12 8 C 14.209 8 16 9.791 16 12 C 16 14.209 14.209 16 12 16 C 9.791 16 8 14.209 8 12 C 8 9.791 9.791 8 12 8 z"></path>
                                    </svg>
                                    <span class="text-sm font-medium ml-3 duration-200">Vintage облека</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <!-- Попусти/промо -->
                    <li class="px-4 py-3 rounded-md mb-0.5 last:mb-0 @if(Request::url() == route('discounts')){{ 'bg-rose-200' }}@endif" x-data="{ open: {{ Request::url() == route('discounts') ? 1 : 0 }} }">
                        <a class="block text-black hover:text-black-400 truncate transition duration-150 @if(Request::url() == route('discounts')){{ 'hover:text-black-400' }}@endif" href="{{ route('discounts') }}" @click="open = false" @focus="open = true" @focusout="open = false">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <?xml version="1.0" ?><svg class="icon icon-tabler icon-tabler-discount-2" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M0 0h24v24H0z" fill="none" stroke="none"/><line x1="9" x2="15" y1="15" y2="9"/><circle cx="9.5" cy="9.5" fill="currentColor" r=".5"/><circle cx="14.5" cy="14.5" fill="currentColor" r=".5"/><path d="M5 7.2a2.2 2.2 0 0 1 2.2 -2.2h1a2.2 2.2 0 0 0 1.55 -.64l.7 -.7a2.2 2.2 0 0 1 3.12 0l.7 .7a2.2 2.2 0 0 0 1.55 .64h1a2.2 2.2 0 0 1 2.2 2.2v1a2.2 2.2 0 0 0 .64 1.55l.7 .7a2.2 2.2 0 0 1 0 3.12l-.7 .7a2.2 2.2 0 0 0 -.64 1.55v1a2.2 2.2 0 0 1 -2.2 2.2h-1a2.2 2.2 0 0 0 -1.55 .64l-.7 .7a2.2 2.2 0 0 1 -3.12 0l-.7 -.7a2.2 2.2 0 0 0 -1.55 -.64h-1a2.2 2.2 0 0 1 -2.2 -2.2v-1a2.2 2.2 0 0 0 -.64 -1.55l-.7 -.7a2.2 2.2 0 0 1 0 -3.12l.7 -.7a2.2 2.2 0 0 0 .64 -1.55v-1"/></svg>
                                    <span class="text-sm font-medium ml-3 duration-200">Попусти/промо</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <!-- Брендови -->
                    <li class="px-4 py-3 rounded-md mb-0.5 last:mb-0 @if(Request::url() == route('brands')){{ 'bg-rose-200' }}@endif" x-data="{ open: {{ Request::url() == route('brands') ? 1 : 0 }} }">
                        <a class="block text-black hover:text-black-400 truncate transition duration-150 @if(Request::url() == route('brands')){{ 'hover:text-black-400' }}@endif" href="{{ route('brands') }}" @click="open = false" @focus="open = true" @focusout="open = false">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" id="circle-wavy" class="w-6 h-6">
                                        <rect width="256" height="256" fill="none"></rect>
                                        <path fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="20" d="M54.46089,201.53911c-9.204-9.204-3.09935-28.52745-7.78412-39.85C41.82037,149.95168,24,140.50492,24,127.99963,24,115.4945,41.82047,106.048,46.67683,94.31079c4.68477-11.32253-1.41993-30.6459,7.78406-39.8499s28.52746-3.09935,39.85-7.78412C106.04832,41.82037,115.49508,24,128.00037,24c12.50513,0,21.95163,17.82047,33.68884,22.67683,11.32253,4.68477,30.6459-1.41993,39.8499,7.78406s3.09935,28.52746,7.78412,39.85C214.17963,106.04832,232,115.49508,232,128.00037c0,12.50513-17.82047,21.95163-22.67683,33.68884-4.68477,11.32253,1.41993,30.6459-7.78406,39.8499s-28.52745,3.09935-39.85,7.78412C149.95168,214.17963,140.50492,232,127.99963,232c-12.50513,0-21.95163-17.82047-33.68884-22.67683C82.98826,204.6384,63.66489,210.7431,54.46089,201.53911Z"></path>
                                    </svg>

                                    <span class="text-sm font-medium ml-3 duration-200">Брендови</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <!-- Профил -->
                    <li class="px-4 py-3 rounded-md mb-0.5 last:mb-0 @if(Request::url() == route('profile.edit')){{ 'bg-rose-200' }}@endif" x-data="{ open: {{ Request::url() == route('profile.edit') ? 1 : 0 }} }">
                        <a class="block text-black hover:text-black-400 truncate transition duration-150 @if(Request::url() == route('profile.edit')){{ 'hover:text-black-400' }}@endif" href="{{ route('profile.edit') }}" @click="open = false" @focus="open = true" @focusout="open = false">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="icon icon-tabler icon-tabler-discount-2" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M16.5 7.063C16.5 10.258 14.57 13 12 13c-2.572 0-4.5-2.742-4.5-5.938C7.5 3.868 9.16 2 12 2s4.5 1.867 4.5 5.063zM4.102 20.142C4.487 20.6 6.145 22 12 22c5.855 0 7.512-1.4 7.898-1.857a.416.416 0 0 0 .09-.317C19.9 18.944 19.106 15 12 15s-7.9 3.944-7.989 4.826a.416.416 0 0 0 .091.317z" fill="#000000"></path></svg>
                                    <span class="text-sm font-medium ml-3 duration-200">Профил</span>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        @endif

        <!-- Expand / collapse button -->
        <div class="pt-3 mt-auto">
            <hr class="border-1 border-slate-200 w-full">
            <div class="pt-2 flex lg:inline-flex justify-start mt-auto">
                <i class="fa-solid fa-arrow-right-from-bracket mt-1 rounded-full bg-white border-2 border-slate-200 px-3 py-3"></i>
                <div class="ml-1">
                    <button @click="sidebarExpanded = !sidebarExpanded" class="flex">
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <a class="text-black font-medium flex logout-button hidden mt-4"
                                href="{{ route('logout') }}"
                                @click.prevent="$root.submit();"
                                @focus="open = true"
                                @focusout="open = false"
                            >
                                {{ __('Одјави се') }}
                            </a>
                        </form>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const userInfoElements = document.querySelectorAll('.user-info');
        const logoutButton = document.querySelector('.logout-button');

        userInfoElements.forEach(element => {
            element.classList.add('hidden');
        });

        logoutButton.classList.add('hidden');
    });

    const sidebar = document.getElementById('sidebar');
    let sidebarExpanded = false;

    function toggleSidebar() {
        sidebarExpanded = !sidebarExpanded;
        if (sidebarExpanded) {
            sidebar.style.width = '100%';
            showUserInfo(true);
        } else {
            sidebar.style.width = '90px';
            showUserInfo(false);
        }
    }

    function showUserInfo(show) {
        const userInfoElements = document.querySelectorAll('.user-info');
        const logoutButton = document.querySelector('.logout-button');

        userInfoElements.forEach(element => {
            if (show) {
                element.classList.remove('hidden');
            } else {
                element.classList.add('hidden');
            }
        });

        if (show) {
            logoutButton.classList.remove('hidden');
        } else {
            logoutButton.classList.add('hidden');
        }
    }

    sidebar.addEventListener('click', function(event) {
        if (event.target.closest('#sidebar') !== null) {
            toggleSidebar();
        }
    });

    document.addEventListener('click', function(event) {
        if (!event.target.closest('#sidebar') && sidebarExpanded) {
            toggleSidebar();
        }
    });

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && sidebarExpanded) {
            toggleSidebar();
        }
    });
</script>

