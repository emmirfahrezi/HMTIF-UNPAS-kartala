@props(['transparent' => false])

<header id="navbar"
    class="fixed top-0 left-0 w-full z-50 transition-all duration-300 {{ $transparent ? 'bg-transparent' : 'bg-white shadow-md' }}">
    <nav aria-label="Global" class="mx-auto flex max-w-screen-2xl items-center justify-between px-6 py-3 lg:px-8">
        <div class="flex lg:flex-1">
            <a href="/" class="flex items-center gap-3 group">
                <div class="p-2 transition-transform duration-300 group-hover:scale-110">
                    <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=emerald&shade=600" alt="Logo HMTIF UNPAS"
                        class="h-10 w-auto {{ $transparent ? 'filter grayscale brightness-200' : '' }}" id="nav-logo" />
                </div>
                <h1 class="font-extrabold text-xl tracking-tight {{ $transparent ? 'text-white' : 'text-gray-900' }} transition-colors duration-300"
                    id="nav-title">
                    HMTIF-UNPAS <span class="text-primary">| Kartala</span>
                </h1>
            </a>
        </div>

        <div class="flex lg:hidden">
            <button type="button" command="show-modal" commandfor="mobile-menu"
                class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 {{ $transparent ? 'text-white' : 'text-gray-900' }}"
                id="mobile-menu-btn">
                <span class="sr-only">Open main menu</span>
                <x-heroicon-o-bars-3 class="size-7" />
            </button>
        </div>

        <div class="hidden lg:flex lg:gap-x-10 items-center">
            <a href="/"
                class="relative text-sm/6 font-bold {{ request()->is('/') ? 'text-primary' : ($transparent ? 'text-white' : 'text-gray-900') }} hover:text-primary transition-colors duration-300">
                Beranda
                @if (request()->is('/'))
                    <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-primary rounded-full"></span>
                @endif
            </a>
            <a href="/staff"
                class="relative text-sm/6 font-bold {{ request()->is('staff*') ? 'text-primary' : ($transparent ? 'text-white' : 'text-gray-900') }} hover:text-primary transition-colors duration-300">
                Pengurus
                @if (request()->is('staff*'))
                    <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-primary rounded-full"></span>
                @endif
            </a>
            <a href="/activities"
                class="relative text-sm/6 font-bold {{ request()->is('activit*') ? 'text-primary' : ($transparent ? 'text-white' : 'text-gray-900') }} hover:text-primary transition-colors duration-300">
                Kegiatan
                @if (request()->is('activit*'))
                    <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-primary rounded-full"></span>
                @endif
            </a>
            <a href="/store"
                class="relative text-sm/6 font-bold {{ request()->is('store*', 'product*') ? 'text-primary' : ($transparent ? 'text-white' : 'text-gray-900') }} hover:text-primary transition-colors duration-300">
                Store
                @if (request()->is('store*', 'product*'))
                    <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-primary rounded-full"></span>
                @endif
            </a>
            <a href="/announcements"
                class="relative text-sm/6 font-bold {{ request()->is('announcement*') ? 'text-primary' : ($transparent ? 'text-white' : 'text-gray-900') }} hover:text-primary transition-colors duration-300">
                Pengumuman
                @if (request()->is('announcement*'))
                    <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-primary rounded-full"></span>
                @endif
            </a>
            <a href="/aspirations"
                class="relative text-sm/6 font-bold {{ request()->is('aspirations*') ? 'text-primary' : ($transparent ? 'text-white' : 'text-gray-900') }} hover:text-primary transition-colors duration-300">
                Aspirasi
                @if (request()->is('aspirations*'))
                    <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-primary rounded-full"></span>
                @endif
            </a>

            <div class="h-6 w-px {{ $transparent ? 'bg-white/20' : 'bg-gray-200' }}"></div>

            <a href="#"
                class="inline-flex items-center gap-2 text-sm/6 font-bold {{ $transparent ? 'text-white' : 'text-gray-900' }} hover:text-primary transition-all group">
                Log in
                <x-heroicon-o-arrow-right class="size-4 transform group-hover:translate-x-1 transition-transform" />
            </a>
        </div>
    </nav>

    <el-dialog shadow>
        <dialog id="mobile-menu" class="backdrop:bg-transparent lg:hidden">
            <div tabindex="0" class="fixed inset-0 focus:outline-none">
                <el-dialog-panel
                    class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white p-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
                    <div class="flex items-center justify-between">
                        <a href="/" class="-m-1.5 p-1.5 flex items-center gap-2">
                            <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=emerald&shade=600"
                                alt="Logo" class="h-8 w-auto filter grayscale opacity-50" />
                            <span class="font-bold text-heading">Kartala</span>
                        </a>
                        <button type="button" command="close" commandfor="mobile-menu"
                            class="-m-2.5 rounded-md p-2.5 text-heading">
                            <span class="sr-only">Close menu</span>
                            <x-heroicon-o-x-mark class="size-6" />
                        </button>
                    </div>
                    <div class="mt-6 flow-root">
                        <div class="-my-6 divide-y divide-gray-500/10">
                            <div class="space-y-2 py-6">
                                <a href="/"
                                    class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-bold text-heading hover:bg-section hover:text-primary transition-colors">
                                    Beranda
                                </a>
                                <a href="/staff"
                                    class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-bold text-heading hover:bg-section hover:text-primary transition-colors">
                                    Pengurus
                                </a>
                                <a href="/activities"
                                    class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-bold text-heading hover:bg-section hover:text-primary transition-colors">
                                    Kegiatan
                                </a>
                                <a href="/store"
                                    class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-bold text-heading hover:bg-section hover:text-primary transition-colors text-primary">
                                    Store
                                </a>
                                <a href="/announcements"
                                    class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-bold text-heading hover:bg-section hover:text-primary transition-colors">
                                    Pengumuman
                                </a>
                                <a href="/aspirations"
                                    class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-bold text-heading hover:bg-section hover:text-primary transition-colors">
                                    Aspirasi
                                </a>
                            </div>
                            <div class="py-6">
                                <a href="#"
                                    class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-bold text-heading hover:bg-section hover:text-primary transition-colors">
                                    Log in
                                </a>
                            </div>
                        </div>
                    </div>
                </el-dialog-panel>
            </div>
        </dialog>
    </el-dialog>
</header>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const navbar = document.getElementById('navbar');
        const navElements = document.querySelectorAll('#navbar a, #navbar button, #navbar h1, #navbar span');
        const logo = document.getElementById('nav-logo');
        const isTransparentInitial = {{ $transparent ? 'true' : 'false' }};

        if (isTransparentInitial) {
            const updateNavbar = () => {
                if (window.scrollY > 50) {
                    navbar.classList.remove('bg-transparent');
                    navbar.classList.add('bg-white', 'shadow-md');
                    if (logo) logo.classList.remove('filter', 'grayscale', 'brightness-200');

                    navElements.forEach((el) => {
                        if (!el.classList.contains('text-primary')) {
                            el.classList.remove('text-white');
                            el.classList.add('text-gray-900');
                        }
                    });
                } else {
                    navbar.classList.add('bg-transparent');
                    navbar.classList.remove('bg-white', 'shadow-md');
                    if (logo) logo.classList.add('filter', 'grayscale', 'brightness-200');

                    navElements.forEach((el) => {
                        if (!el.classList.contains('text-primary')) {
                            el.classList.add('text-white');
                            el.classList.remove('text-gray-900');
                        }
                    });
                }
            };

            // Jalankan saat pertama kali dimuat
            updateNavbar();

            // Jalankan saat di-scroll
            window.addEventListener('scroll', updateNavbar);
        }
    });
</script>