<x-dashboard-layout pageTitle="Tambah Pengaturan" :breadcrumbs="[['label' => 'Pengaturan', 'href' => '/dashboard/settings'], ['label' => 'Tambah']]">
    <form method="POST" action="/dashboard/settings">@csrf
        <div class="space-y-6 max-w-4xl">
            <x-dashboard.form-section title="Setting">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <x-dashboard.form-input label="Key" name="key" required placeholder="site_name" />
                    <x-dashboard.form-input label="Value" name="value" required placeholder="HMTIF UNPAS" />
                    <x-dashboard.form-input type="select" label="Group" name="group" value="general"
                        :options="['general' => 'General', 'social' => 'Social Media', 'seo' => 'SEO', 'contact' => 'Kontak']" />
                </div>
            </x-dashboard.form-section>
            <div class="flex items-center gap-3">
                <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-xl text-sm font-semibold hover:bg-primary/90 shadow-lg shadow-primary/20 transition active:scale-95">Tambah</button>
                <a href="/dashboard/settings" class="px-6 py-2.5 bg-slate-100 text-slate-600 rounded-xl text-sm font-semibold hover:bg-slate-200 transition">Batal</a>
            </div>
        </div>
    </form>
</x-dashboard-layout>
