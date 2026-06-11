<x-molecules.shared.modal id="archive-share-modal" title="Bagikan Arsip" maxWidth="lg">
    <div
        x-data="{
            mode: 'link',
            copiedTarget: '',
            downloadingQr: false,
            archive: {
                name: '',
                shareUrl: '',
                shortUrl: '',
                qrCodeUrl: '',
                qrDownloadUrl: '',
                qrLogoUrl: '',
            },
            init() {
                window.addEventListener('archive-share-data', (event) => {
                    this.archive = {
                        name: event.detail?.name || '',
                        shareUrl: event.detail?.shareUrl || '',
                        shortUrl: event.detail?.shortUrl || '',
                        qrCodeUrl: event.detail?.qrCodeUrl || '',
                        qrDownloadUrl: event.detail?.qrDownloadUrl || '',
                        qrLogoUrl: event.detail?.qrLogoUrl || '',
                    };
                });
            },
            copyValue(value, target = 'link') {
                if (!value) return;
                navigator.clipboard?.writeText(value);
                this.copiedTarget = target;
                if (typeof toast === 'function') toast('Link arsip disalin', 'success');
                setTimeout(() => this.copiedTarget = '', 1800);
            },
            copyLink() {
                this.copyValue(this.archive.shareUrl, 'link');
            },
            copyShortLink() {
                this.copyValue(this.archive.shortUrl || this.archive.shareUrl, 'short');
            },
            slugify(value) {
                return (value || 'arsip')
                    .toString()
                    .normalize('NFKD')
                    .replace(/[\u0300-\u036f]/g, '')
                    .toLowerCase()
                    .replace(/[^a-z0-9]+/g, '-')
                    .replace(/^-+|-+$/g, '') || 'arsip';
            },
            loadQrImage(url) {
                return new Promise((resolve, reject) => {
                    const image = new Image();
                    image.crossOrigin = 'anonymous';
                    image.onload = () => resolve(image);
                    image.onerror = () => reject(new Error('Gambar QR gagal dimuat.'));
                    image.src = url;
                });
            },
            qrImageUrl(size) {
                try {
                    const url = new URL(this.archive.qrCodeUrl, window.location.href);
                    url.searchParams.set('size', size);
                    return url.toString();
                } catch (error) {
                    return this.archive.qrCodeUrl;
                }
            },
            drawRoundedRect(context, x, y, width, height, radius) {
                if (typeof context.roundRect === 'function') {
                    context.beginPath();
                    context.roundRect(x, y, width, height, radius);
                    context.fill();
                    return;
                }

                context.beginPath();
                context.moveTo(x + radius, y);
                context.lineTo(x + width - radius, y);
                context.quadraticCurveTo(x + width, y, x + width, y + radius);
                context.lineTo(x + width, y + height - radius);
                context.quadraticCurveTo(x + width, y + height, x + width - radius, y + height);
                context.lineTo(x + radius, y + height);
                context.quadraticCurveTo(x, y + height, x, y + height - radius);
                context.lineTo(x, y + radius);
                context.quadraticCurveTo(x, y, x + radius, y);
                context.fill();
            },
            canvasToBlob(canvas) {
                return new Promise((resolve, reject) => {
                    canvas.toBlob((blob) => {
                        blob ? resolve(blob) : reject(new Error('File QR gagal dibuat.'));
                    }, 'image/png');
                });
            },
            triggerQrDownload(blob) {
                const objectUrl = URL.createObjectURL(blob);
                const link = document.createElement('a');
                link.href = objectUrl;
                link.download = `qr-${this.slugify(this.archive.name)}.png`;
                document.body.appendChild(link);
                link.click();
                link.remove();
                setTimeout(() => URL.revokeObjectURL(objectUrl), 1000);
            },
            async downloadPlainQr() {
                const url = this.archive.qrDownloadUrl || this.archive.qrCodeUrl;
                if (!url) return;

                const link = document.createElement('a');
                link.href = url;
                link.download = `qr-${this.slugify(this.archive.name)}.png`;
                document.body.appendChild(link);
                link.click();
                link.remove();
            },
            async downloadQrWithLogo() {
                if (!this.archive.qrCodeUrl || this.downloadingQr) return;

                this.downloadingQr = true;

                try {
                    const size = 1200;
                    const canvas = document.createElement('canvas');
                    canvas.width = size;
                    canvas.height = size;

                    const context = canvas.getContext('2d');
                    context.fillStyle = '#ffffff';
                    context.fillRect(0, 0, size, size);

                    const qrImage = await this.loadQrImage(this.qrImageUrl(size));
                    context.drawImage(qrImage, 0, 0, size, size);

                    if (this.archive.qrLogoUrl) {
                        const logoImage = await this.loadQrImage(this.archive.qrLogoUrl);
                        const boxSize = 264;
                        const logoSize = 186;
                        const boxPosition = (size - boxSize) / 2;
                        const logoPosition = (size - logoSize) / 2;

                        context.fillStyle = '#ffffff';
                        this.drawRoundedRect(context, boxPosition, boxPosition, boxSize, boxSize, 48);
                        context.drawImage(logoImage, logoPosition, logoPosition, logoSize, logoSize);
                    }

                    const blob = await this.canvasToBlob(canvas);
                    this.triggerQrDownload(blob);
                    if (typeof toast === 'function') toast('QR Code berlogo sedang diunduh', 'success');
                } catch (error) {
                    console.error(error);
                    await this.downloadPlainQr();
                    if (typeof toast === 'function') toast('Logo gagal disematkan, QR polos diunduh sebagai fallback', 'error');
                } finally {
                    this.downloadingQr = false;
                }
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
            <p class="mt-1 text-sm font-bold text-slate-700 dark:text-slate-200" x-text="archive.name || '-'"></p>
        </div>

        <div x-show="mode === 'link'" x-cloak class="space-y-4">
            <x-molecules.shared.forms.form-input
                label="Link Pendek"
                name="archive_short_url_preview"
                type="text"
                x-bind:value="archive.shortUrl || archive.shareUrl"
                readonly />

            <x-molecules.shared.forms.form-input
                label="Link Publik"
                name="archive_share_url_preview"
                type="text"
                x-bind:value="archive.shareUrl"
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
            <template x-if="archive.qrCodeUrl">
                <div class="flex flex-col items-center gap-4">
                    <div class="relative rounded-2xl border border-slate-100 bg-white p-4 shadow-sm dark:border-slate-800">
                        <img :src="archive.qrCodeUrl" alt="QR Code Arsip" class="size-64 rounded-xl object-contain">
                        <template x-if="archive.qrLogoUrl">
                            <span class="absolute left-1/2 top-1/2 flex size-14 -translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-2xl border border-white bg-white p-1.5 shadow-md">
                                <img :src="archive.qrLogoUrl" alt="Logo HMTIF" class="size-full rounded-xl object-contain">
                            </span>
                        </template>
                    </div>
                    <p class="max-w-sm text-center text-xs font-medium text-slate-500 dark:text-slate-400">
                        QR Code dibuat backend; logo HMTIF UNPAS ditampilkan di tengah preview.
                    </p>
                </div>
            </template>

            <template x-if="!archive.qrCodeUrl">
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
                <x-atoms.shared.button
                    type="button"
                    variant="primary"
                    icon="heroicon-o-arrow-down-tray"
                    @click="downloadQrWithLogo()"
                    x-bind:disabled="downloadingQr || !archive.qrCodeUrl">
                    <span x-text="downloadingQr ? 'Menyiapkan...' : 'Download QR'"></span>
                </x-atoms.shared.button>
            </div>
        </div>
    </div>
</x-molecules.shared.modal>
