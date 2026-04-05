<x-layout>
    <x-slot:title>
        Detail Pengumuman
    </x-slot:title>

    <div class="pt-32 pb-24 bg-section min-h-screen">
        <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl">
            {{-- Back Button --}}
            <div class="mb-12">
                <x-atoms.button variant="outline" onclick="window.history.back()" class="group">
                    <x-heroicon-o-arrow-long-left class="h-5 w-5 group-hover:-translate-x-1 transition-transform" />
                    Kembali ke Pengumuman
                </x-atoms.button>
            </div>

            <article class="bg-white rounded-3xl shadow-xl shadow-primary/5 border border-border overflow-hidden">
                {{-- Hero Image --}}
                <div class="aspect-video w-full overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1761839259488-2bdeeae794f5?q=80&w=1171&auto=format&fit=crop" 
                         alt="Detail Image" 
                         class="w-full h-full object-cover">
                </div>

                <div class="p-8 sm:p-12">
                    {{-- Meta --}}
                    <div class="flex items-center gap-4 mb-6">
                        <span class="px-3 py-1 bg-primary/10 text-primary rounded-full text-xs font-bold uppercase tracking-widest">
                            Akademik
                        </span>
                        <span class="text-body text-sm">
                            21 Oktober 2024
                        </span>
                    </div>

                    {{-- Title --}}
                    <h1 class="text-4xl sm:text-5xl font-extrabold text-heading leading-tight mb-8">
                        Membangun Masa Depan Teknologi Bersama HMTIF UNPAS
                    </h1>

                    {{-- Content --}}
                    <div class="prose prose-lg max-w-none text-body leading-relaxed space-y-6">
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, odit officiis esse ducimus recusandae aut corporis blanditiis nisi maxime sequi. Quasi mollitia exercitationem asperiores. Explicabo, voluptatibus repellat itaque laborum totam necessitatibus nisi commodi doloribus in nulla, iusto autem laudantium porro eum ratione?
                        </p>
                        <p>
                            Ipsam perspiciatis quis quibusdam accusamus totam in quo numquam, optio eum exercitationem eligendi saepe, assumenda possimus culpa, a quasi enim et! Error voluptate beatae, nobis tempora dolore consequatur at, labore, sapiente eos laboriosam nulla. Ex modi corrupti doloribus porro molestiae facere, voluptates fuga, hic, optio et facilis expedita consequuntur culpa!
                        </p>
                        <blockquote class="border-l-4 border-primary pl-6 italic text-heading font-medium py-2 bg-section rounded-r-xl">
                            "Mahasiswa harus menjadi agen perubahan yang tidak hanya mahir dalam kode, tetapi juga peka terhadap harmoni sosial."
                        </blockquote>
                        <p>
                            Consequuntur rem veritatis odio! Quo reiciendis laudantium molestias doloribus officiis. Animi at facilis corrupti perferendis a tempore nemo vitae excepturi quo nam totam ea reprehenderit quae repudiandae harum exercitationem laudantium, odio vero velit consequuntur modi optio et aliquam!
                        </p>
                    </div>

                    {{-- Author --}}
                    <div class="mt-12 pt-8 border-t border-border flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-primary-soft flex items-center justify-center text-primary font-bold">
                            IT
                        </div>
                        <div>
                            <p class="text-heading font-bold">Tim IT Kartala</p>
                            <p class="text-xs text-body uppercase tracking-wider">Bidang Komunikasi & Informasi</p>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</x-layout>
