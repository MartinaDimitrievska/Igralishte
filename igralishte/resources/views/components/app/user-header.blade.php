<header class="sticky top-0 bg-white z-30 mb-2">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="h-16">
            <div class="flex justify-between items-center space-x-3">
                <div class="flex mt-3 items-center">
                    @if(Auth::user()->profile_photo_path)
                        <img src="{{ asset(auth()->user()->profile_photo_path) }}" alt="Profile Photo" class="mr-2 rounded-full h-12 w-12 object-cover">
                    @endif
                    <p class="font-medium">{{ Auth::user()->name }}</p>
                    @if(Auth::user()->surname)
                        <p class="font-medium ml-1">{{ Auth::user()->surname }}</p>
                    @endif
                </div>
                <div class="mt-auto">
                    <div class="pt-1 flex lg:inline-flex justify-start mt-auto">
                        <div class="ml-1">
                            <button @click="sidebarExpanded = !sidebarExpanded" class="flex">
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
                                    <a
                                        href="{{ route('logout') }}"
                                        @click.prevent="$root.submit();"
                                    >
                                    <i class="fa-solid fa-arrow-right-from-bracket mt-1 rounded-full bg-white border-2 border-slate-200 px-3 py-3"></i>
                                    </a>
                                </form>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
