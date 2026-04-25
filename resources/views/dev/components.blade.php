<x-layouts.app>
    <x-slot:title>Laboratorium Komponen | Kartala Styleguide</x-slot:title>

    <x-slot:head>
        {{-- Quill Editor Assets (Only for Styleguide Preview) --}}
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    </x-slot:head>

    <div class="py-12 bg-section min-h-screen pt-24 pb-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-[3rem] shadow-2xl p-12 md:p-20 border border-border relative overflow-hidden">
                {{-- Decorative Background --}}
                <div class="absolute top-0 right-0 w-96 h-96 bg-primary/5 rounded-full -mr-48 -mt-48 blur-3xl"></div>

                <header class="relative z-10 mb-16">
                    <span
                        class="inline-block px-4 py-1.5 rounded-full bg-primary/10 text-primary text-[10px] font-black uppercase tracking-[0.3em] mb-6">Internal
                        Documentation</span>
                    <h1
                        class="text-4xl md:text-6xl font-black text-heading italic uppercase tracking-tighter mb-4 leading-none">
                        Styleguide <span class="text-primary">HMTIF-UNPAS</span></h1>
                    <p class="text-body/60 text-lg max-w-2xl">Pusat dokumentasi komponen Atomic Design untuk project
                        Kartala. Gunakan komponen yang sudah ada untuk menjaga konsistensi UI/UX.</p>
                </header>

                <hr class="border-border mb-16">

                {{-- BRANDING SECTION --}}
                <section class="mb-24 relative z-10">
                    <div class="flex items-center gap-4 mb-12">
                        <div class="h-8 w-2 bg-primary rounded-full"></div>
                        <h2 class="text-heading font-semibold text-3xl uppercase tracking-tighter italic">00. <span
                                class="text-primary">Branding</span></h2>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                        {{-- Color Palette --}}
                        <div>
                            <h3
                                class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-8 border-b border-gray-50 pb-4">
                                Color Palette</h3>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                                {{-- Primary --}}
                                <div class="space-y-2">
                                    <div
                                        class="h-20 w-full rounded-2xl bg-primary shadow-lg shadow-primary/20 border border-black/5">
                                    </div>
                                    <p class="text-[10px] font-black uppercase text-heading">Primary</p>
                                    <p class="text-[9px] text-gray-400 font-mono">#00793C</p>
                                </div>
                                <div class="space-y-2">
                                    <div
                                        class="h-20 w-full rounded-2xl bg-primary-dark shadow-lg shadow-primary-dark/20 border border-black/5">
                                    </div>
                                    <p class="text-[10px] font-black uppercase text-heading">Dark</p>
                                    <p class="text-[9px] text-gray-400 font-mono">#004D27</p>
                                </div>
                                <div class="space-y-2">
                                    <div
                                        class="h-20 w-full rounded-2xl bg-primary-soft shadow-lg shadow-primary-soft/20 border border-black/5">
                                    </div>
                                    <p class="text-[10px] font-black uppercase text-heading">Soft</p>
                                    <p class="text-[9px] text-gray-400 font-mono">#66B48A</p>
                                </div>
                                <div class="space-y-2">
                                    <div
                                        class="h-20 w-full rounded-2xl bg-secondary shadow-lg shadow-secondary/30 border border-black/5">
                                    </div>
                                    <p class="text-[10px] font-black uppercase text-heading">Secondary</p>
                                    <p class="text-[9px] text-gray-400 font-mono">#FEF501</p>
                                </div>
                                {{-- Neutral --}}
                                <div class="space-y-2">
                                    <div class="h-20 w-full rounded-2xl bg-heading shadow-lg border border-black/5">
                                    </div>
                                    <p class="text-[10px] font-black uppercase text-heading">Heading</p>
                                    <p class="text-[9px] text-gray-400 font-mono">#111827</p>
                                </div>
                                <div class="space-y-2">
                                    <div class="h-20 w-full rounded-2xl bg-body shadow-lg border border-black/5"></div>
                                    <p class="text-[10px] font-black uppercase text-heading">Body</p>
                                    <p class="text-[9px] text-gray-400 font-mono">#374151</p>
                                </div>
                                <div class="space-y-2">
                                    <div class="h-20 w-full rounded-2xl bg-section shadow-inner border border-border">
                                    </div>
                                    <p class="text-[10px] font-black uppercase text-heading">Section</p>
                                    <p class="text-[9px] text-gray-400 font-mono">#F9FAFB</p>
                                </div>
                            </div>
                        </div>

                        {{-- Typography --}}
                        <div>
                            <h3
                                class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-8 border-b border-gray-50 pb-4">
                                Typography (Instrument Sans)</h3>
                            <div class="space-y-6">
                                <div class="space-y-1">
                                    <p class="text-4xl font-black italic uppercase tracking-tighter text-heading">The
                                        Quick Brown Fox</p>
                                    <p class="text-[10px] text-primary font-bold uppercase tracking-widest">Heading Bold
                                        Italic (Kartala Style)</p>
                                </div>
                                <div class="space-y-1 mt-8">
                                    <p class="text-2xl font-semibold text-heading tracking-tight">The quick brown fox
                                        jumps over the lazy dog</p>
                                    <p class="text-[10px] text-primary font-bold uppercase tracking-widest">Subheading
                                        Semibold</p>
                                </div>
                                <div class="space-y-1 mt-8">
                                    <p class="text-base text-body leading-relaxed">The quick brown fox jumps over the
                                        lazy dog. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    <p class="text-[10px] text-primary font-bold uppercase tracking-widest">Body Regular
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <hr class="border-border mb-16">

                {{-- ATOMS SECTION --}}
                <section class="mb-24 relative z-10">
                    <div class="flex items-center gap-4 mb-12">
                        <div class="h-8 w-2 bg-primary rounded-full"></div>
                        <h2 class="text-heading font-semibold text-3xl uppercase tracking-tighter italic">01. <span
                                class="text-primary">Atoms</span></h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                        {{-- Buttons --}}
                        <div class="space-y-6">
                            <h3
                                class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-6 border-b border-gray-50 pb-4">
                                Buttons</h3>
                            <div class="flex flex-wrap gap-4">
                                <x-atoms.pages.button variant="primary">Primary Button</x-atoms.button>
                                    <x-atoms.pages.button variant="secondary">Secondary</x-atoms.button>
                                        <x-atoms.pages.button variant="outline">Outline</x-atoms.button>
                            </div>
                        </div>

                        {{-- Titles --}}
                        <div class="space-y-6">
                            <h3
                                class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-6 border-b border-gray-50 pb-4">
                                Titles & Typography</h3>
                            <div class="space-y-4">
                                <x-atoms.pages.section-title>Ini Contoh Judul Section</x-atoms.section-title>
                            </div>
                        </div>

                        {{-- Form Elements --}}
                        <div class="space-y-6">
                            <h3
                                class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-6 border-b border-gray-50 pb-4">
                                Form Inputs</h3>
                            <div class="space-y-4">
                                <x-atoms.pages.input placeholder="Placeholder text..." />
                                <x-atoms.pages.input value="Typed text example" />
                            </div>
                        </div>
                    </div>
                </section>

                {{-- MOLECULES SECTION --}}
                <section class="mb-24 relative z-10">
                    <div class="flex items-center gap-4 mb-12">
                        <div class="h-8 w-2 bg-primary rounded-full"></div>
                        <h2 class="text-heading font-semibold text-3xl uppercase tracking-tighter italic">02. <span
                                class="text-primary">Molecules</span></h2>
                    </div>

                    {{-- Member & News Cards --}}
                    <div class="mb-16">
                        <h3
                            class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-8 border-b border-gray-50 pb-4 text-center sm:text-left">
                            Member & News Cards</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            <x-molecules.pages.cards.member-card name="Emmir Fahrezi" position="Ketua Himpunan"
                                size="normal" dept="PSDM" />
                            <x-molecules.pages.cards.member-card name="Fauzan Ahmad" position="Sekretaris" size="normal"
                                dept="SEC" />
                            <x-molecules.pages.cards.news-card title="MUBES HMTIF 2026: Delegasi Terpilih"
                                category="Penting" date="05 April 2026" :image="null" />
                        </div>
                    </div>

                    {{-- Page Sections --}}
                    <div class="mb-16">
                        <h3
                            class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-8 border-b border-gray-50 pb-4 text-center sm:text-left">
                            Page Sections</h3>
                        <div class="border border-border rounded-3xl overflow-hidden bg-white">
                            <div class="scale-90 origin-top">
                                <x-molecules.pages.sections.page-hero badge="KARTALA STYLEGUIDE"
                                    title="Komponen Halaman" highlight="Hero"
                                    description="Contoh penggunaan komponen page hero untuk judul halaman statis." />
                            </div>
                        </div>
                    </div>

                    {{-- Forms --}}
                    <div class="mb-16">
                        <h3
                            class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-8 border-b border-gray-50 pb-4 text-center sm:text-left">
                            Form Groups</h3>
                        <div class="max-w-md">
                            <x-molecules.pages.forms.form-field label="Label Contoh" id="example" required="true"
                                error="Pesan kesalahan muncul di sini jika ada.">
                                <x-atoms.pages.input id="example" placeholder="Masukkan teks..." />
                            </x-molecules.pages.forms.form-field>
                        </div>
                    </div>

                    {{-- Stats --}}
                    <div class="mb-16">
                        <h3
                            class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-8 border-b border-gray-50 pb-4 text-center sm:text-left">
                            Stat Cards</h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <x-molecules.pages.stats.stat-card label="Pengurus" value="31+" />
                            <x-molecules.pages.stats.stat-card label="Anggota" value="300+" />
                            <x-molecules.pages.stats.stat-card label="KMPS" value="5" />
                            <x-molecules.pages.stats.stat-card label="Proker" value="12" />
                        </div>
                    </div>
                </section>

                {{-- ANIMATIONS SECTION --}}
                <section class="mb-24 relative z-10">
                    <div class="flex items-center gap-4 mb-12">
                        <div class="h-8 w-2 bg-primary rounded-full"></div>
                        <h2 class="text-heading font-semibold text-3xl uppercase tracking-tighter italic">03. <span
                                class="text-primary">Animations (Kartala Motion)</span></h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="p-10 bg-section rounded-3xl text-center reveal reveal-up">
                            <p class="text-xs font-black text-primary uppercase tracking-[0.3em] mb-4">Reveal Up</p>
                            <p class="font-bold text-heading">Muncul dari bawah</p>
                        </div>
                        <div class="p-10 bg-section rounded-3xl text-center reveal reveal-left">
                            <p class="text-xs font-black text-primary uppercase tracking-[0.3em] mb-4">Reveal Left</p>
                            <p class="font-bold text-heading">Muncul dari kiri</p>
                        </div>
                        <div class="p-10 bg-section rounded-3xl text-center reveal reveal-scale">
                            <p class="text-xs font-black text-primary uppercase tracking-[0.3em] mb-4">Reveal Scale</p>
                            <p class="font-bold text-heading">Zoom-in halus</p>
                        </div>
                    </div>

                    <div class="mt-8 p-6 bg-primary-dark rounded-2xl text-center">
                        <p class="text-white/60 text-sm italic">Scroll ke atas dan ke bawah untuk melihat ulang efek
                            animasinya.</p>
                    </div>
                </section>

                {{-- ORGANISMS SECTION --}}
                <section class="relative z-10">
                    <div class="flex items-center gap-4 mb-12">
                        <div class="h-8 w-2 bg-primary rounded-full"></div>
                        <h2 class="text-heading font-semibold text-3xl uppercase tracking-tighter italic">04. <span
                                class="text-primary">Organisms</span></h2>
                    </div>

                    <div class="p-8 bg-section rounded-3xl border border-border text-center">
                        <p class="text-body/60 italic text-sm mb-6">Organisme seperti Navbar dan Footer sudah otomatis
                            terload di setiap halaman menggunakan Layout.</p>
                        <div class="flex flex-wrap justify-center gap-4">
                            <a href="/" class="text-primary font-bold text-sm hover:underline">Lihat Live
                                Navbar</a>
                            <span class="text-gray-300">|</span>
                            <a href="#footer-preview" class="text-primary font-bold text-sm hover:underline">Lihat
                                Live Footer</a>
                        </div>
                    </div>
                </section>

                <hr class="border-border my-16">

                {{-- DASHBOARD UI SECTION --}}
                <section class="relative z-10">
                    <div class="flex items-center gap-4 mb-12">
                        <div class="h-8 w-2 bg-primary rounded-full"></div>
                        <h2 class="text-heading font-semibold text-3xl uppercase tracking-tighter italic">05. <span
                                class="text-primary">Dashboard UI Kit</span></h2>
                    </div>

                    {{-- 05.1 Data Display --}}
                    <div class="mb-20">
                        <h3
                            class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-8 border-b border-gray-50 pb-4">
                            05.1 Data Display & Stats</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                            <x-molecules.dashboard.cards.stat-card label="Total Artikel" value="124"
                                icon="heroicon-o-document-text" color="primary" href="#" />
                            <x-molecules.dashboard.cards.stat-card label="Pengurus Aktif" value="32"
                                icon="heroicon-o-users" color="blue" href="#" />
                            <x-molecules.dashboard.cards.stat-card label="Pesan Baru" value="5"
                                icon="heroicon-o-chat-bubble-left-right" color="amber" href="#" />
                        </div>

                        <div class="space-y-4">
                            {{-- Category Card --}}
                            <x-molecules.dashboard.cards.category-card title="Kategori Pengumuman"
                                subtitle="Kelola kategori untuk memfilter pengumuman" add-modal-id="previewModal"
                                manage-route="#" />

                            <x-molecules.dashboard.cards.data-table :headers="[['label' => 'Nama Pengurus', 'class' => 'w-1/2'], ['label' => 'Divisi', 'class' => '']]">
                                <tr>
                                    <td class="px-5 py-4 text-sm font-medium text-slate-800">Emmir Fahrezi</td>
                                    <td class="px-5 py-4 text-sm text-slate-500">PSDM</td>
                                    <td class="px-5 py-4 text-right">
                                        <button class="text-primary font-bold text-xs">Edit</button>
                                    </td>
                                </tr>
                                <x-slot:pagination>
                                    <div class="flex items-center justify-between">
                                        <p class="text-xs text-slate-400 font-medium">Menampilkan 1 dari 1 data</p>
                                    </div>
                                </x-slot:pagination>
                            </x-molecules.dashboard.cards.data-table>
                        </div>
                    </div>

                    {{-- 05.2 Forms & Filters --}}
                    <div class="mb-20">
                        <h3
                            class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-8 border-b border-gray-50 pb-4">
                            05.2 Forms, Filters & Inputs</h3>

                        <x-molecules.dashboard.cards.filter-card search-placeholder="Cari sesuatu..." />

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-8">
                            <div class="space-y-6 bg-slate-50/50 p-6 rounded-2xl border border-slate-100">
                                <x-molecules.dashboard.forms.form-input label="Input Text" name="text"
                                    placeholder="Ketik sesuatu..." required="true" />
                                <x-molecules.dashboard.forms.form-input label="Select Option" name="select"
                                    type="select" :options="['1' => 'Opsi A', '2' => 'Opsi B']" />
                                <x-molecules.dashboard.forms.form-input label="Toggle Switch" name="toggle"
                                    type="toggle" placeholder="Aktifkan fitur ini" />
                                <x-molecules.dashboard.forms.form-input label="Rich Text Editor" name="content"
                                    type="richtext" placeholder="Tulis konten lengkap di sini..."
                                    value="<p>Ini adalah contoh konten <strong>Rich Text</strong>!</p>" />
                            </div>
                            <div class="space-y-6">
                                <x-molecules.dashboard.forms.form-section title="Informasi Dasar"
                                    description="Gunakan form section untuk membagi formulir yang panjang.">
                                    <div class="space-y-4">
                                        <x-molecules.dashboard.forms.form-input label="Nama" name="name" />
                                    </div>
                                </x-molecules.dashboard.forms.form-section>
                            </div>
                        </div>

                        {{-- Category Manager Full Width --}}
                        <div class="mt-12 p-8 bg-slate-50/30 rounded-[2rem] border border-slate-100 shadow-inner">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-8 text-center">
                                Category Manager Atomic Component</p>
                            <x-atoms.dashboard.category-manager />
                        </div>
                    </div>

                    {{-- 05.3 Feedback & Overlays --}}
                    <div>
                        <h3
                            class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-8 border-b border-gray-50 pb-4">
                            05.3 Feedback & Overlays</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-4">
                                <p class="text-xs font-bold text-slate-400 uppercase">Notifications</p>
                                <div
                                    class="flex items-center gap-3 px-5 py-3.5 rounded-xl border bg-emerald-50 border-emerald-200 text-emerald-800">
                                    <x-heroicon-o-check-circle class="size-5 shrink-0" />
                                    <p class="text-sm font-medium flex-1">Success: Data berhasil disimpan!</p>
                                </div>
                                <div
                                    class="flex items-center gap-3 px-5 py-3.5 rounded-xl border bg-red-50 border-red-200 text-red-800">
                                    <x-heroicon-o-x-circle class="size-5 shrink-0" />
                                    <p class="text-sm font-medium flex-1">Error: Terjadi kesalahan sistem.</p>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <p class="text-xs font-bold text-slate-400 uppercase">Modals & Empty States</p>
                                <div class="flex gap-3">
                                    <button type="button" onclick="toggleModal('previewModal')"
                                        class="px-4 py-2 bg-slate-800 text-white rounded-lg text-sm font-bold transition active:scale-95">Preview
                                        Modal</button>
                                    <button type="button"
                                        onclick="document.getElementById('deleteModal').style.display = 'flex'"
                                        class="px-4 py-2 bg-red-600 text-white rounded-lg text-sm font-bold transition active:scale-95">Confirm
                                        Delete</button>
                                </div>
                                <div
                                    class="bg-white rounded-2xl border border-slate-100 overflow-hidden scale-90 origin-top-left">
                                    <x-molecules.dashboard.ui.empty-state title="Tidak Ada Data"
                                        description="Silakan tambah data baru." />
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Modal Definitions --}}
                    <x-molecules.dashboard.ui.modal id="previewModal" title="Preview Modal">
                        <div class="space-y-4">
                            <p class="text-sm text-slate-500">Ini adalah contoh isi dari modal dashboard.</p>
                            <div class="flex justify-end">
                                <button onclick="toggleModal('previewModal')"
                                    class="px-4 py-2 bg-primary text-white rounded-xl text-sm font-bold">Mengerti</button>
                            </div>
                        </div>
                    </x-molecules.dashboard.ui.modal>

                    <x-molecules.dashboard.ui.modal-confirm />
                </section>

                <hr class="border-border my-16">

                {{-- SPECIAL PAGES & ORGANISMS --}}
                <section class="relative z-10 pb-20">
                    <div class="flex items-center gap-4 mb-12">
                        <div class="h-8 w-2 bg-primary rounded-full"></div>
                        <h2 class="text-heading font-semibold text-3xl uppercase tracking-tighter italic">06. <span
                                class="text-primary">Special States & Organisms</span></h2>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                        {{-- Error Page Preview --}}
                        <div class="space-y-6">
                            <h3
                                class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-6 border-b border-gray-50 pb-4">
                                Error States (Design Preview)</h3>
                            <div class="bg-slate-100 rounded-3xl p-8 text-center border border-slate-200">
                                <div
                                    class="mb-4 inline-flex items-center justify-center size-16 bg-white rounded-2xl shadow-lg border border-slate-100 text-primary">
                                    <x-heroicon-o-exclamation-triangle class="size-8" />
                                </div>
                                <h4 class="text-xl font-bold text-slate-900 mb-2">Halaman Tidak Ditemukan</h4>
                                <p class="text-slate-500 text-sm mb-6">Contoh layout halaman error 404 / 500.</p>
                                <div class="flex justify-center gap-2">
                                    <span class="px-4 py-1.5 bg-white border border-slate-200 rounded-lg text-xs font-bold">Kembali</span>
                                    <span class="px-4 py-1.5 bg-primary text-white rounded-lg text-xs font-bold">Beranda</span>
                                </div>
                            </div>
                        </div>

                        {{-- Page Organisms --}}
                        <div class="space-y-6">
                            <h3
                                class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-6 border-b border-gray-50 pb-4">
                                High-Level Organisms</h3>
                            <div class="space-y-4">
                                <div class="p-5 bg-white border border-border rounded-2xl flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-bold text-heading">Home Hero</p>
                                        <p class="text-xs text-body/60">Organisme utama halaman beranda.</p>
                                    </div>
                                    <x-heroicon-o-chevron-right class="size-4 text-primary" />
                                </div>
                                <div class="p-5 bg-white border border-border rounded-2xl flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-bold text-heading">Vision & Mission</p>
                                        <p class="text-xs text-body/60">Section visi misi dengan animasi reveal.</p>
                                    </div>
                                    <x-heroicon-o-chevron-right class="size-4 text-primary" />
                                </div>
                                <div class="p-5 bg-white border border-border rounded-2xl flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-bold text-heading">Footer & Navbar</p>
                                        <p class="text-xs text-body/60">Struktur navigasi global.</p>
                                    </div>
                                    <x-heroicon-o-chevron-right class="size-4 text-primary" />
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
</x-layouts.app>