<x-layouts.dashboard pageTitle="Profil Saya" :breadcrumbs="[['label' => 'Profil Saya']]">
    <div x-data="{
        editMode: false,
        name: '{{ $user->name ?? '' }}',
        email: '{{ $user->email ?? '' }}',
        instagram: '{{ $staff?->instagram ?? '' }}',
        linkedin: '{{ $staff?->linkedin ?? '' }}',
        github: '{{ $staff?->github ?? '' }}',
        bio: '{{ $staff?->bio ?? '' }}',
        avatarPreview: '{{ $user->avatar_url ?? '' }}',
        passwordModalOpen: false,
        submitting: false,
    
        onAvatarChange(event) {
            const file = event.target.files[0];
            if (file) {
                this.avatarPreview = URL.createObjectURL(file);
            }
        },
    
        cancel() {
            this.editMode = false;
            this.name = '{{ $user->name ?? '' }}';
            this.email = '{{ $user->email ?? '' }}';
            this.instagram = '{{ $staff?->instagram ?? '' }}';
            this.linkedin = '{{ $staff?->linkedin ?? '' }}';
            this.github = '{{ $staff?->github ?? '' }}';
            this.bio = '{{ $staff?->bio ?? '' }}';
            this.avatarPreview = '{{ $user->avatar_url ?? '' }}';
        }
    }" class="max-w-6xl mx-auto space-y-8">

        {{-- Form Utama Profil --}}
        <form action="{{ route('dashboard.profile.update') }}" method="POST" enctype="multipart/form-data"
            @submit="submitting = true" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            @csrf
            @method('PUT')

            {{-- Kolom Kiri: Foto, Info Singkat, & Tombol Kontrol --}}
            <div class="space-y-6">
                <div
                    class="bg-white dark:bg-slate-900/50 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 shadow-sm flex flex-col items-center text-center relative overflow-hidden transition-all duration-300">
                    {{-- Decorative Background Circle --}}
                    <div class="absolute -top-12 -right-12 size-32 bg-primary/5 rounded-full blur-2xl"></div>

                    {{-- Avatar Display / Uploader --}}
                    <div class="relative group mt-4">
                        <div
                            class="size-32 rounded-3xl overflow-hidden ring-4 ring-primary/10 border border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-950 flex items-center justify-center transition-all duration-300">
                            <img :src="avatarPreview" alt="Avatar" class="w-full h-full object-cover">
                        </div>

                        {{-- Upload Overlay (Hanya aktif saat editMode) --}}
                        <label x-show="editMode" x-cloak
                            class="absolute inset-0 rounded-3xl bg-black/60 backdrop-blur-xs flex flex-col items-center justify-center text-white cursor-pointer opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <x-heroicon-o-camera class="size-6 mb-1" />
                            <span class="text-[10px] font-bold uppercase tracking-wider">Ubah Foto</span>
                            <input type="file" name="photo" accept="image/*" class="hidden"
                                @change="onAvatarChange">
                        </label>
                    </div>

                    {{-- User Basic Info --}}
                    <h3 class="mt-5 text-lg font-bold text-slate-850 dark:text-white" x-text="name"></h3>
                    <p class="text-xs text-slate-400 dark:text-slate-500 font-medium">{{ $user->email ?? '' }}</p>

                    {{-- Badge Role --}}
                    <span
                        class="mt-3 inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest bg-primary/10 text-primary border border-primary/10">
                        <x-heroicon-s-shield-check class="size-3.5" />
                        {{ $user->role_label ?? 'Staff' }}
                    </span>

                    <hr class="w-full my-6 border-slate-100 dark:border-slate-800">

                    {{-- Menu Cepat / Tindakan Utama --}}
                    <div class="w-full space-y-3">
                        {{-- Tombol Ganti Password (Paling Atas) --}}
                        <x-atoms.shared.button type="button" variant="outline-slate"
                            class="w-full py-3 hover:!bg-amber-500/10 hover:!text-amber-500 hover:!border-amber-500/20 text-amber-600 dark:text-amber-400 !border !border-amber-500/10 dark:!border-amber-500/20 bg-amber-500/5 dark:bg-amber-500/10 shadow-none"
                            @click="passwordModalOpen = true">
                            <x-heroicon-o-key class="size-4" />
                            Ganti Password
                        </x-atoms.shared.button>

                        {{-- Tombol Edit / Batal (Alpine Toggle) --}}
                        <x-atoms.shared.button type="button" variant="outline-slate" class="w-full py-3"
                            x-show="!editMode" @click="editMode = true">
                            <x-heroicon-o-pencil-square class="size-4" />
                            Edit Profil
                        </x-atoms.shared.button>

                        <x-atoms.shared.button type="button" variant="danger"
                            class="w-full py-3 !bg-red-500/10 hover:!bg-red-500/20 !text-red-500 !border !border-red-500/20 shadow-none"
                            x-show="editMode" x-cloak @click="cancel">
                            <x-heroicon-o-x-circle class="size-4" />
                            Batal Edit
                        </x-atoms.shared.button>

                        {{-- Tombol Simpan Perubahan (Disabled if not editMode) --}}
                        <x-atoms.shared.button type="submit" variant="primary"
                            class="w-full py-3 shadow-lg shadow-primary/20" x-bind:disabled="!editMode">
                            <template x-if="!submitting">
                                <span class="flex items-center justify-center gap-2">
                                    <x-heroicon-o-check-circle class="size-4" />
                                    Simpan Perubahan
                                </span>
                            </template>
                            <template x-if="submitting">
                                <span class="flex items-center justify-center gap-2">
                                    <svg class="animate-spin size-4" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4" fill="none"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                    Memproses...
                                </span>
                            </template>
                        </x-atoms.shared.button>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Form Data Pribadi & Media Sosial --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- Card: Data Personal (Menggunakan Form Section) --}}
                <x-molecules.shared.forms.form-section title="Informasi Akun"
                    description="Kelola nama profil dan detail dasar keanggotaan Anda" icon="heroicon-s-user"
                    bg-icon="heroicon-o-user">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        {{-- Input Nama --}}
                        <x-molecules.shared.forms.form-input type="text" label="Nama Lengkap" name="name"
                            x-model="name" x-bind:disabled="!editMode"
                            class="disabled:opacity-60 disabled:cursor-not-allowed" required />

                        {{-- Input Posisi (Readonly) --}}
                        <x-molecules.shared.forms.form-input type="text" label="Jabatan Pengurus (Read Only)"
                            name="position" value="{{ $staff?->position ?? 'Admin Sistem' }}"
                            class="disabled:opacity-60 disabled:cursor-not-allowed" disabled />

                        {{-- Input Email --}}
                        <x-molecules.shared.forms.form-input type="email" label="Alamat Email" name="email"
                            x-model="email" x-bind:disabled="!editMode"
                            class="disabled:opacity-60 disabled:cursor-not-allowed" required />

                        {{-- Input Hak Akses (Readonly) --}}
                        <x-molecules.shared.forms.form-input type="text" label="Tingkat Akses (Read Only)"
                            name="role" value="{{ $user->role_label ?? '' }}"
                            class="disabled:opacity-60 disabled:cursor-not-allowed" disabled />

                        {{-- Input Bio --}}
                        <div class="md:col-span-2">
                            <x-molecules.shared.forms.form-input type="textarea" label="Biografi Singkat" name="bio"
                                x-model="bio" x-bind:disabled="!editMode"
                                class="disabled:opacity-60 disabled:cursor-not-allowed" rows="3" />
                        </div>
                    </div>
                </x-molecules.shared.forms.form-section>

                {{-- Card: Sosial Media (Menggunakan Form Section) --}}
                <x-molecules.shared.forms.form-section title="Sosial Media & Tautan"
                    description="Hubungkan profil pengurus Anda dengan jejaring luar" icon="heroicon-s-link"
                    bg-icon="heroicon-o-link">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        {{-- Instagram --}}
                        <x-molecules.shared.forms.form-input type="text" label="Username Instagram"
                            name="instagram" x-model="instagram" x-bind:disabled="!editMode"
                            class="disabled:opacity-60 disabled:cursor-not-allowed" placeholder="@username" />

                        {{-- LinkedIn --}}
                        <x-molecules.shared.forms.form-input type="text" label="LinkedIn" name="linkedin"
                            x-model="linkedin" x-bind:disabled="!editMode"
                            class="disabled:opacity-60 disabled:cursor-not-allowed"
                            placeholder="URL profil LinkedIn..." />

                    </div>
                </x-molecules.shared.forms.form-section>
            </div>
        </form>

        {{-- Modal Ganti Password (Alpine Overlay Modal) --}}
        @include('dashboard.profile._change-password-modal')

    </div>
</x-layouts.dashboard>
