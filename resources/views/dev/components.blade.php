<x-layout>
    <x-slot:title>Laboratorium Komponen</x-slot:title>

    <div class="py-12 bg-section min-h-screen pt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm p-8 border border-border">
                <h1 class="text-3xl font-bold text-heading mb-2">HMTIF-UNPAS Styleguide</h1>
                <p class="text-body mb-8">Pusat dokumentasi komponen Atomic Design untuk project Kartala.</p>

                <hr class="border-border mb-8">

                <!-- ATOMS SECTION -->
                <section class="mb-12">
                    <h2 class="text-xl font-bold text-primary mb-6 flex items-center gap-2">
                        <span class="w-2 h-6 bg-primary rounded-full"></span>
                        Atoms
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Buttons -->
                        <div class="space-y-4 p-6 border border-border rounded-xl">
                            <h3 class="font-semibold text-heading mb-4 text-sm uppercase tracking-wider">Buttons</h3>
                            <div class="flex flex-wrap gap-4">
                                <x-atoms.button>Primary Button</x-atoms.button>
                                <x-atoms.button variant="secondary">Secondary</x-atoms.button>
                                <x-atoms.button variant="outline">Outline Button</x-atoms.button>
                            </div>
                        </div>

                        <!-- Titles -->
                        <div class="space-y-4 p-6 border border-border rounded-xl">
                            <h3 class="font-semibold text-heading mb-4 text-sm uppercase tracking-wider">Titles</h3>
                            <x-atoms.section-title>Ini Section Title</x-atoms.section-title>
                        </div>
                    </div>
                </section>

                <!-- MOLECULES SECTION -->
                <section class="mb-12">
                    <h2 class="text-xl font-bold text-primary mb-6 flex items-center gap-2">
                        <span class="w-2 h-6 bg-primary rounded-full"></span>
                        Molecules
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <x-molecules.stats.stat-card label="Pengurus" value="31+" />
                        <x-molecules.stats.stat-card label="Anggota" value="300+" />
                        <x-molecules.stats.stat-card label="KMPS" value="5" />
                    </div>
                </section>

            </div>
        </div>
    </div>
</x-layout>
