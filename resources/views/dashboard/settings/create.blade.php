<x-layouts.dashboard pageTitle="Tambah Pengaturan" :breadcrumbs="[['label' => 'Pengaturan', 'href' => '/dashboard/settings'], ['label' => 'Tambah']]">
    <form method="POST" action="/dashboard/settings">@csrf
        <div class="space-y-6 max-w-4xl">
            <x-molecules.shared.forms.form-section title="Pengaturan Baru">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <x-molecules.shared.forms.form-input label="Key" name="key" required placeholder="site_name" />
                    <x-molecules.shared.forms.form-input label="Value" name="value" required placeholder="HMTIF UNPAS" />
                    <x-molecules.shared.forms.form-input type="select" label="Group" name="group" value="general"
                        :options="['general' => 'General', 'social' => 'Social Media', 'seo' => 'SEO', 'contact' => 'Kontak']" />
                </div>
            </x-molecules.shared.forms.form-section>
            <div class="flex items-center gap-3 mt-8">
                <x-atoms.shared.button type="submit">
                    Tambah Pengaturan
                </x-atoms.shared.button>
                <x-atoms.shared.button variant="ghost" href="/dashboard/settings">
                    Batal
                </x-atoms.shared.button>
            </div>
        </div>
    </form>
</x-layouts.dashboard>

