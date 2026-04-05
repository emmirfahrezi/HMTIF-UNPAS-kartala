<x-layout>
    <x-slot:title>Laboratorium Komponen | Kartala Styleguide</x-slot:title>

    <div class="py-12 bg-section min-h-screen pt-24 pb-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-[3rem] shadow-2xl p-12 md:p-20 border border-border relative overflow-hidden">
                {{-- Decorative Background --}}
                <div class="absolute top-0 right-0 w-96 h-96 bg-primary/5 rounded-full -mr-48 -mt-48 blur-3xl"></div>
                
                <header class="relative z-10 mb-16">
                    <span class="inline-block px-4 py-1.5 rounded-full bg-primary/10 text-primary text-[10px] font-black uppercase tracking-[0.3em] mb-6">Internal Documentation</span>
                    <h1 class="text-4xl md:text-6xl font-black text-heading italic uppercase tracking-tighter mb-4 leading-none">Styleguide <span class="text-primary">Kartala</span></h1>
                    <p class="text-body/60 text-lg max-w-2xl">Pusat dokumentasi komponen Atomic Design untuk project Kartala. Gunakan komponen yang sudah ada untuk menjaga konsistensi UI/UX.</p>
                </header>

                <hr class="border-border mb-16">

                {{-- BRANDING SECTION --}}
                <section class="mb-24 relative z-10">
                    <div class="flex items-center gap-4 mb-12">
                        <div class="h-8 w-2 bg-primary rounded-full"></div>
                        <h2 class="text-heading font-semibold text-3xl uppercase tracking-tighter italic">00. <span class="text-primary">Branding</span></h2>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                        {{-- Color Palette --}}
                        <div>
                            <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-8 border-b border-gray-50 pb-4">Color Palette</h3>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                                {{-- Primary --}}
                                <div class="space-y-2">
                                    <div class="h-20 w-full rounded-2xl bg-primary shadow-lg shadow-primary/20 border border-black/5"></div>
                                    <p class="text-[10px] font-black uppercase text-heading">Primary</p>
                                    <p class="text-[9px] text-gray-400 font-mono">#248232</p>
                                </div>
                                <div class="space-y-2">
                                    <div class="h-20 w-full rounded-2xl bg-primary-dark shadow-lg shadow-primary-dark/20 border border-black/5"></div>
                                    <p class="text-[10px] font-black uppercase text-heading">Dark</p>
                                    <p class="text-[9px] text-gray-400 font-mono">#0a2815</p>
                                </div>
                                <div class="space-y-2">
                                    <div class="h-20 w-full rounded-2xl bg-primary-soft shadow-lg shadow-primary-soft/20 border border-black/5"></div>
                                    <p class="text-[10px] font-black uppercase text-heading">Soft</p>
                                    <p class="text-[9px] text-gray-400 font-mono">#74c69d</p>
                                </div>
                                {{-- Neutral --}}
                                <div class="space-y-2">
                                    <div class="h-20 w-full rounded-2xl bg-heading shadow-lg border border-black/5"></div>
                                    <p class="text-[10px] font-black uppercase text-heading">Heading</p>
                                    <p class="text-[9px] text-gray-400 font-mono">#111827</p>
                                </div>
                                <div class="space-y-2">
                                    <div class="h-20 w-full rounded-2xl bg-body shadow-lg border border-black/5"></div>
                                    <p class="text-[10px] font-black uppercase text-heading">Body</p>
                                    <p class="text-[9px] text-gray-400 font-mono">#374151</p>
                                </div>
                                <div class="space-y-2">
                                    <div class="h-20 w-full rounded-2xl bg-section shadow-inner border border-border"></div>
                                    <p class="text-[10px] font-black uppercase text-heading">Section</p>
                                    <p class="text-[9px] text-gray-400 font-mono">#F9FAFB</p>
                                </div>
                            </div>
                        </div>

                        {{-- Typography --}}
                        <div>
                            <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-8 border-b border-gray-50 pb-4">Typography (Instrument Sans)</h3>
                            <div class="space-y-6">
                                <div class="space-y-1">
                                    <p class="text-4xl font-black italic uppercase tracking-tighter text-heading">The Quick Brown Fox</p>
                                    <p class="text-[10px] text-primary font-bold uppercase tracking-widest">Heading Bold Italic (Kartala Style)</p>
                                </div>
                                <div class="space-y-1 mt-8">
                                    <p class="text-2xl font-semibold text-heading tracking-tight">The quick brown fox jumps over the lazy dog</p>
                                    <p class="text-[10px] text-primary font-bold uppercase tracking-widest">Subheading Semibold</p>
                                </div>
                                <div class="space-y-1 mt-8">
                                    <p class="text-base text-body leading-relaxed">The quick brown fox jumps over the lazy dog. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    <p class="text-[10px] text-primary font-bold uppercase tracking-widest">Body Regular</p>
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
                        <h2 class="text-heading font-semibold text-3xl uppercase tracking-tighter italic">01. <span class="text-primary">Atoms</span></h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                        {{-- Buttons --}}
                        <div class="space-y-6">
                            <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-6 border-b border-gray-50 pb-4">Buttons</h3>
                            <div class="flex flex-wrap gap-4">
                                <x-atoms.button variant="primary">Primary Button</x-atoms.button>
                                <x-atoms.button variant="secondary">Secondary</x-atoms.button>
                                <x-atoms.button variant="outline">Outline</x-atoms.button>
                            </div>
                        </div>

                        {{-- Titles --}}
                        <div class="space-y-6">
                            <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-6 border-b border-gray-50 pb-4">Titles & Typography</h3>
                            <div class="space-y-4">
                                <x-atoms.section-title>Ini Contoh Judul Section</x-atoms.section-title>
                            </div>
                        </div>

                        {{-- Form Elements --}}
                        <div class="space-y-6">
                            <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-6 border-b border-gray-50 pb-4">Form Inputs</h3>
                            <div class="space-y-4">
                                <x-atoms.input placeholder="Placeholder text..." />
                                <x-atoms.input value="Typed text example" />
                            </div>
                        </div>
                    </div>
                </section>

                {{-- MOLECULES SECTION --}}
                <section class="mb-24 relative z-10">
                    <div class="flex items-center gap-4 mb-12">
                        <div class="h-8 w-2 bg-primary rounded-full"></div>
                        <h2 class="text-heading font-semibold text-3xl uppercase tracking-tighter italic">02. <span class="text-primary">Molecules</span></h2>
                    </div>

                    {{-- Cards --}}
                    <div class="mb-16">
                        <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-8 border-b border-gray-50 pb-4 text-center sm:text-left">Member & News Cards</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            <x-molecules.cards.member-card 
                                name="Emmir Fahrezi" 
                                position="Ketua Himpunan" 
                                size="normal"
                                dept="PSDM"
                            />
                            <x-molecules.cards.member-card 
                                name="Fauzan Ahmad" 
                                position="Sekretaris" 
                                size="normal"
                                dept="SEC"
                            />
                            <x-molecules.cards.news-card 
                                title="MUBES HMTIF 2026: Delegasi Terpilih" 
                                category="Penting"
                                date="05 April 2026"
                                :image="null"
                            />
                        </div>
                    </div>

                    {{-- Stats --}}
                    <div class="mb-16">
                        <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-8 border-b border-gray-50 pb-4 text-center sm:text-left">Stat Cards</h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <x-molecules.stats.stat-card label="Pengurus" value="31+" />
                            <x-molecules.stats.stat-card label="Anggota" value="300+" />
                            <x-molecules.stats.stat-card label="KMPS" value="5" />
                            <x-molecules.stats.stat-card label="Proker" value="12" />
                        </div>
                    </div>
                </section>

                {{-- ANIMATIONS SECTION --}}
                <section class="mb-24 relative z-10">
                    <div class="flex items-center gap-4 mb-12">
                        <div class="h-8 w-2 bg-primary rounded-full"></div>
                        <h2 class="text-heading font-semibold text-3xl uppercase tracking-tighter italic">04. <span class="text-primary">Animations (Kartala Motion)</span></h2>
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
                        <p class="text-white/60 text-sm italic">Scroll ke atas dan ke bawah untuk melihat ulang efek animasinya.</p>
                    </div>
                </section>

                {{-- ORGANISMS SECTION --}}
                <section class="relative z-10">
                    <div class="flex items-center gap-4 mb-12">
                        <div class="h-8 w-2 bg-primary rounded-full"></div>
                        <h2 class="text-heading font-semibold text-3xl uppercase tracking-tighter italic">03. <span class="text-primary">Organisms</span></h2>
                    </div>

                    <div class="p-8 bg-section rounded-3xl border border-border text-center">
                        <p class="text-body/60 italic text-sm mb-6">Organisme seperti Navbar dan Footer sudah otomatis terload di setiap halaman menggunakan Layout.</p>
                        <div class="flex flex-wrap justify-center gap-4">
                            <a href="/" class="text-primary font-bold text-sm hover:underline">Lihat Live Navbar</a>
                            <span class="text-gray-300">|</span>
                            <a href="#footer-preview" class="text-primary font-bold text-sm hover:underline">Lihat Live Footer</a>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>

    {{-- Footer Preview (In-place) --}}
    <div id="footer-preview" class="mt-12">
        <x-organisms.footer />
    </div>
</x-layout>
