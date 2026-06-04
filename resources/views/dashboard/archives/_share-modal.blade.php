<x-molecules.shared.modal id="archive-share-modal" title="Bagikan Arsip" maxWidth="lg">
    <div
        x-data="{
            mode: 'link',
            copiedTarget: '',
            copyValue(value, target = 'link') {
                if (!value) return;
                navigator.clipboard?.writeText(value);
                this.copiedTarget = target;
                if (typeof toast === 'function') toast('Link arsip disalin', 'success');
                setTimeout(() => this.copiedTarget = '', 1800);
            },
            copyLink() {
                this.copyValue(this.shareArchive?.shareUrl, 'link');
            },
            copyShortLink() {
                this.copyValue(this.shareArchive?.shortUrl || this.shareArchive?.shareUrl, 'short');
            },
        }"
        class="space-y-6"
    >
        <div class="inline-grid grid-cols-2 rounded-2xl border border-slate-200/50 bg-slate-100 p-1 dark:border-slate-800/70 dark:bg-slate-950/60">
            <button type="button"
                @click="mode = 'link'"
                :class="mode === 'link' ? 'bg-white text-primary shadow-sm dark:bg-slate-800' : 'text-slate-500 dark:text-slate-400'"
                class="rounded-xl px-4 py-2 text-xs font-black uppercase tracking-widest transition">
                Link
            </button>
            <button type="button"
                @click="mode = 'qr'"
                :class="mode === 'qr' ? 'bg-white text-primary shadow-sm dark:bg-slate-800' : 'text-slate-500 dark:text-slate-400'"
                class="rounded-xl px-4 py-2 text-xs font-black uppercase tracking-widest transition">
                QR Code
            </button>
        </div>

        <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950">
            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-slate-500">Arsip</p>
            <p class="mt-1 text-sm font-bold text-slate-700 dark:text-slate-200" x-text="shareArchive.name || '-'"></p>
        </div>

        <div x-show="mode === 'link'" x-cloak class="space-y-4">
            <x-molecules.shared.forms.form-input
                label="Link Pendek"
                name="archive_short_url_preview"
                type="text"
                x-bind:value="shareArchive.shortUrl || shareArchive.shareUrl"
                readonly />

            <x-molecules.shared.forms.form-input
                label="Link Publik"
                name="archive_share_url_preview"
                type="text"
                x-bind:value="shareArchive.shareUrl"
                readonly />

            <div class="flex flex-col-reverse justify-end gap-3 sm:flex-row">
                <x-atoms.shared.button type="button" variant="ghost" @click="copyLink()" icon="heroicon-o-link">
                    <span x-text="copiedTarget === 'link' ? 'Tersalin' : 'Salin Link Publik'"></span>
                </x-atoms.shared.button>
                <x-atoms.shared.button type="button" variant="primary" @click="copyShortLink()" icon="heroicon-o-clipboard-document">
                    <span x-text="copiedTarget === 'short' ? 'Tersalin' : 'Salin Link Pendek'"></span>
                </x-atoms.shared.button>
            </div>
        </div>

        <div x-show="mode === 'qr'" x-cloak class="space-y-5">
            <template x-if="shareArchive.qrCodeUrl">
                <div class="flex flex-col items-center gap-4">
                    <div class="rounded-2xl border border-slate-100 bg-white p-4 shadow-sm dark:border-slate-800">
                        <img :src="shareArchive.qrCodeUrl" alt="QR Code Arsip" class="size-64 rounded-xl object-contain">
                    </div>
                    <p class="max-w-sm text-center text-xs font-medium text-slate-500 dark:text-slate-400">
                        QR Code dikirim dari backend dan sudah memuat logo HMTIF UNPAS di tengah.
                    </p>
                </div>
            </template>

            <template x-if="!shareArchive.qrCodeUrl">
                <div class="rounded-2xl border border-dashed border-slate-200 bg-slate-50 p-8 text-center dark:border-slate-800 dark:bg-slate-950">
                    <x-heroicon-o-qr-code class="mx-auto size-10 text-slate-300 dark:text-slate-700" />
                    <p class="mt-3 text-sm font-bold text-slate-600 dark:text-slate-300">QR Code belum tersedia.</p>
                    <p class="mt-1 text-xs text-slate-400 dark:text-slate-500">Backend perlu mengirim `qr_code_url` untuk arsip ini.</p>
                </div>
            </template>

            <div class="flex flex-col-reverse justify-end gap-3 sm:flex-row">
                <x-atoms.shared.button type="button" variant="ghost" @click="copyShortLink()" icon="heroicon-o-clipboard-document">
                    Salin Link
                </x-atoms.shared.button>
                <x-atoms.shared.button href="#" x-bind:href="shareArchive.qrDownloadUrl || shareArchive.qrCodeUrl || '#'" download variant="primary" icon="heroicon-o-arrow-down-tray">
                    Download QR
                </x-atoms.shared.button>
            </div>
        </div>
    </div>
</x-molecules.shared.modal>
