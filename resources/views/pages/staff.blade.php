<x-layouts.app title="Daftar Pengurus | HMTIF-UNPAS"
    description="Kenali jajaran pengurus HMTIF-UNPAS. Mengenal struktur organisasi, profil pimpinan, dan departemen yang bergerak untuk kemajuan Informatika."
    keywords="Pengurus HMTIF, Struktur Organisasi HMTIF, Pimpinan HMTIF-UNPAS" :transparent="false">
    <x-slot:head>
        <script type="application/ld+json">
        {
            "@@context": "https://schema.org",
            "@@type": "BreadcrumbList",
            "itemListElement": [{
                "@@type": "ListItem",
                "position": 1,
                "name": "Beranda",
                "item": "{{ url('/') }}"
            },{
                "@@type": "ListItem",
                "position": 2,
                "name": "Daftar Pengurus",
                "item": "{{ url()->current() }}"
            }]
        }
        </script>
    </x-slot:head>
    <x-organisms.pages.staff.hero />

    <div class="bg-white pt-8 md:pt-10 pb-20 md:pb-24">
        <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl">
            <div class="mb-10 flex justify-end">
                <form action="{{ route('staff') }}" method="GET" class="w-full sm:w-72">
                    <x-molecules.shared.forms.form-input
                        label="Periode"
                        name="period"
                        type="select"
                        :value="$activePeriod?->label ?? request('period')"
                        :options="$periods ?? []"
                        option-value-key="label"
                        option-label-key="display_label"
                        :size="'sm'"
                        @change="setTimeout(() => $el.closest('form').submit(), 50)" />
                </form>
            </div>
            <x-organisms.pages.staff.bph :staffs="$staffs" />
            <x-organisms.pages.staff.divisions :divisions="$divisions" />
        </div>
    </div>
</x-layouts.app>

