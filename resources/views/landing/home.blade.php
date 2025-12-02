<!-- Hero section -->
<x-layout>
    <x-slot:title>
        Home
    </x-slot:title>

    <div
        class="relative isolate px-6 pt-14 mt-0 lg:px-8 min-h-screen flex items-center bg-[url('https://images.unsplash.com/photo-1503264116251-35a269479413')] bg-cover bg-center bg-no-repeat z-0">
        <div class="absolute inset-0 bg-black/40 z-0"></div>
        <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56 z-20">
            <div class="text-center">
                <h1 class="text-5xl font-semibold tracking-tight text-balance text-white sm:text-7xl">
                    Data to enrich your online business
                </h1>
                <p class="mt-8 text-lg font-medium text-pretty text-white sm:text-xl/8">
                    Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui
                    lorem cupidatat commodo. Elit sunt amet fugiat veniam occaecat.
                </p>
            </div>
        </div>
    </div>

    <!-- about HMTIF -->
    <div class="h-[650px] flex items-center justify-center p-5">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 w-[950px] h-[400px]">
            <!-- BAGIAN KIRI (BACKGROUND FOTO BESAR) -->
            <div id="bigPhoto" class="grid place-items-center bg-center bg-cover transition-all duration-500"
                style="
            background-image: url('https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=900&q=60');
          ">
                <div class="grid grid-cols-3 gap-4 w-fit">
                    <!-- Foto Kecil 1 -->
                    <div class="swap-box bg-white p-3 w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28 flex items-center justify-center rounded-lg cursor-pointer transform transition duration-300 hover:scale-105"
                        data-img="https://images.unsplash.com/photo-1503023345310-bd7c1de61c7d?ixlib=rb-4.0.3&q=80&w=600">
                        <img src="https://images.unsplash.com/photo-1503023345310-bd7c1de61c7d?ixlib=rb-4.0.3&q=80&w=600"
                            class="w-full h-full object-cover rounded-md" />
                    </div>

                    <!-- Foto Kecil 2 -->
                    <div class="swap-box bg-white p-3 w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28 flex items-center justify-center rounded-lg cursor-pointer transform transition duration-300 hover:scale-105"
                        data-img="https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?ixlib=rb-4.0.3&q=80&w=600">
                        <img src="https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?ixlib=rb-4.0.3&q=80&w=600"
                            class="w-full h-full object-cover rounded-md" />
                    </div>

                    <!-- Foto Kecil 3 -->
                    <div class="swap-box bg-white p-3 w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28 flex items-center justify-center rounded-lg cursor-pointer transform transition duration-300 hover:scale-105"
                        data-img="https://images.unsplash.com/photo-1519681393784-d120267933ba?ixlib=rb-4.0.3&q=80&w=600">
                        <img src="https://images.unsplash.com/photo-1519681393784-d120267933ba?ixlib=rb-4.0.3&q=80&w=600"
                            class="w-full h-full object-cover rounded-md" />
                    </div>
                </div>
            </div>

            <!-- BAGIAN ABOUT HMTIF -->
            <div class="flex flex-col items-center justify-center text-center text-3xl font-bold space-y-4">
                <h1>ABOUT HMTIF</h1>
                <p class="text-base font-normal max-w-xl">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum
                    dolor sit amet consectetur, adipisicing elit. Natus laboriosam,
                    labore officiis illo tempora voluptatum molestias neque at ea
                    repellendus.
                </p>
            </div>
        </div>
    </div>

    <!-- ABOUT KABINET -->
    <div class="min-h-[550px] flex flex-col items-center justify-center bg-gray-100 px-4 py-10">
        <!-- JUDUL SECTION -->
        <h1 class="text-3xl md:text-4xl font-bold mb-8 text-center">
            ABOUT KABINET
        </h1>

        <!-- GRID SECTION -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 w-full max-w-6xl">
            <!-- Box 1 -->
            <div class="flex flex-col gap-6">
                <div class="text-black text-justify font-bold">
                    <h1 class="text-3xl md:text-4xl">31+ Pengurus</h1>
                    <p class="text-xs md:text-sm mt-3">
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eaque
                        neque tempore repudiandae velit animi tempora amet corporis labore
                        doloribus assumenda!
                    </p>
                </div>

                <div class="text-black text-justify font-bold">
                    <h1 class="text-3xl md:text-4xl">300+ Anggota</h1>
                    <p class="text-xs md:text-sm mt-3">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque
                        neque tempore repudiandae velit animi tempora amet corporis
                        labore!
                    </p>
                </div>

                <div class="text-black text-justify font-bold">
                    <h1 class="text-3xl md:text-4xl">5 KMPS</h1>
                    <p class="text-xs md:text-sm mt-3">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque
                        neque tempore repudiandae velit animi tempora amet corporis
                        labore!
                    </p>
                </div>
            </div>

            <!-- Box 2 -->
            <div class="flex items-center justify-center rounded-xl overflow-hidden h-60 md:h-auto">
                <img src="https://images.unsplash.com/photo-1519681393784-d120267933ba?ixlib=rb-4.0.3&q=80&w=600"
                    alt="gambarlogo" class="w-full h-full object-cover" />
            </div>

            <!-- Box 3 -->
            <div class="flex flex-col text-lg md:text-3xl font-bold space-y-4">
                <p class="text-sm md:text-base font-normal">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum
                    dolor sit amet consectetur, adipisicing elit. Natus laboriosam,
                    labore officiis illo tempora voluptatum molestias neque at ea
                    repellendus.
                </p>
            </div>
        </div>
    </div>
</x-layout>
