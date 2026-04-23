<x-dashboard-layout pageTitle="Tambah Kategori" :breadcrumbs="[['label' => 'Kategori Pengumuman', 'href' => '/dashboard/announcement-categories'], ['label' => 'Tambah']]">
    <form method="POST" action="/dashboard/announcement-categories">@csrf
        <div class="space-y-6 max-w-4xl">
            <x-dashboard.form-section title="Kategori Pengumuman">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <x-dashboard.form-input label="Nama" name="name" required />
                    <x-dashboard.form-input label="Slug" name="slug" required />
                </div>
            </x-dashboard.form-section>
            <div class="flex items-center gap-3">
                <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-xl text-sm font-semibold hover:bg-primary/90 shadow-lg shadow-primary/20 transition active:scale-95">Tambah</button>
                <a href="/dashboard/announcement-categories" class="px-6 py-2.5 bg-slate-100 text-slate-600 rounded-xl text-sm font-semibold hover:bg-slate-200 transition">Batal</a>
            </div>
        </div>
    </form>
    <script>document.getElementById('name')?.addEventListener('blur',function(){const s=document.getElementById('slug');if(s&&!s.value)s.value=this.value.toLowerCase().replace(/[^a-z0-9]+/g,'-').replace(/(^-|-$)/g,'');});</script>
</x-dashboard-layout>
