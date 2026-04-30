<x-layouts.dashboard pageTitle="Edit Pengaturan" :breadcrumbs="[['label' => 'Pengaturan', 'href' => '/dashboard/settings'], ['label' => 'Edit']]">
    <form method="POST" action="/dashboard/settings/{{ $setting->id }}">@csrf @method('PUT')
        <div class="space-y-6 max-w-4xl">
            <x-molecules.shared.forms.form-section title="Edit Pengaturan">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <x-molecules.shared.forms.form-input label="Key" name="key" :value="$setting->key" required />
                    <x-molecules.shared.forms.form-input label="Value" name="value" :value="$setting->value" required />
                    <x-molecules.shared.forms.form-input type="select" label="Group" name="group" :value="$setting->group"
                        :options="['general' => 'General', 'social' => 'Social Media', 'seo' => 'SEO', 'contact' => 'Kontak']" />
                </div>
            </x-molecules.shared.forms.form-section>
            <div class="flex items-center gap-3 mt-8">
                <x-atoms.shared.button type="submit">
                    Simpan Perubahan
                </x-atoms.shared.button>
                <x-atoms.shared.button variant="ghost" href="/dashboard/settings">
                    Batal
                </x-atoms.shared.button>
            </div>
        </div>
    </form>
</x-layouts.dashboard>
