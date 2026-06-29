@props([
    'label' => 'Gambar',
    'name' => '',
    'value' => '',
    'fileName' => null,
    'helper' => '',
    'accept' => 'image/png,image/jpg,image/jpeg',
    'uploadToEditor' => false,
    'required' => false,
])

@php
    $oldKey = trim(preg_replace('/\[([^\]]*)\]/', '.$1', $name), '.');
    $currentValue = old($oldKey, $value);
    $rawPreview = trim((string) $currentValue);
    $previewUrl = '';

    if ($rawPreview !== '') {
        if (preg_match('/^(https?:\/\/|\/\/|data:|blob:)/i', $rawPreview) === 1) {
            $previewUrl = $rawPreview;
        } elseif (str_starts_with($rawPreview, '/') || str_starts_with($rawPreview, 'storage/') || str_starts_with($rawPreview, 'images/')) {
            $previewUrl = asset(ltrim($rawPreview, '/'));
        } else {
            $previewUrl = asset('storage/' . ltrim($rawPreview, '/'));
        }
    }

    $initialMode = $rawPreview !== '' ? 'link' : 'device';
@endphp

<div
    x-data="{
        mode: @js($initialMode),
        value: @js((string) $currentValue),
        preview: @js($previewUrl),
        localFileName: '',
        isUploading: false,
        error: '',
        emitUpdate() {
            window.dispatchEvent(new CustomEvent('image-picker-updated', {
                detail: {
                    name: @js($name),
                    value: this.value,
                    preview: this.preview,
                },
            }));
        },
        showLocalPreview(event) {
            const file = event.target.files?.[0];
            if (!file) return;
            this.error = '';
            this.localFileName = file.name;
            this.preview = URL.createObjectURL(file);
            this.emitUpdate();
        },
        async uploadWithEditor(event) {
            const file = event.target.files?.[0];
            if (!file) return;

            this.error = '';
            this.localFileName = file.name;
            this.isUploading = true;
            this.preview = URL.createObjectURL(file);

            const formData = new FormData();
            formData.append('image', file);

            try {
                const csrfMeta = document.querySelector('meta[name=csrf-token]');
                const response = await fetch('/dashboard/editor/upload', {
                    method: 'POST',
                    headers: csrfMeta ? { 'X-CSRF-TOKEN': csrfMeta.content } : {},
                    body: formData,
                });
                const data = await response.json();

                if (!response.ok || !data.url) {
                    throw new Error(data.message || 'Upload gambar gagal.');
                }

                this.value = data.url;
                this.localFileName = '';
                this.preview = data.url;
                this.emitUpdate();
            } catch (error) {
                this.error = error.message || 'Upload gambar gagal.';
            } finally {
                this.isUploading = false;
            }
        },
    }"
    class="space-y-3"
>
    <input type="hidden" name="{{ $name }}" :value="value" {{ $required ? 'required' : '' }}>

    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <label class="text-sm font-bold text-slate-700 dark:text-slate-300">
            {{ $label }}
            @if ($required)
                <span class="text-red-500 ml-0.5">*</span>
            @endif
        </label>

        <div class="inline-grid grid-cols-2 rounded-2xl border border-slate-200/50 bg-slate-100 p-1 dark:border-slate-800/70 dark:bg-slate-950/60">
            <button type="button"
                @click="mode = 'link'"
                :class="mode === 'link' ? 'bg-white text-primary shadow-sm dark:bg-slate-800' : 'text-slate-500 dark:text-slate-400'"
                class="rounded-xl px-3 py-1.5 text-[10px] font-black uppercase tracking-widest transition">
                Link
            </button>
            <button type="button"
                @click="mode = 'device'"
                :class="mode === 'device' ? 'bg-white text-primary shadow-sm dark:bg-slate-800' : 'text-slate-500 dark:text-slate-400'"
                class="rounded-xl px-3 py-1.5 text-[10px] font-black uppercase tracking-widest transition">
                Device
            </button>
        </div>
    </div>

    <template x-if="mode === 'link'">
        <input type="text"
            x-model="value"
            @input="localFileName = ''; preview = value; emitUpdate()"
            placeholder="https://... atau /storage/..."
            class="w-full rounded-2xl border border-slate-200/50 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition-all duration-300 placeholder:text-slate-400 focus:border-primary focus:ring-4 focus:ring-primary/10 dark:border-slate-800/50 dark:bg-slate-950/45 dark:text-white dark:placeholder:text-slate-600" />
    </template>

    <template x-if="mode === 'device'">
        <div class="space-y-2">
            @if ($uploadToEditor)
                <input type="file"
                    accept="{{ $accept }}"
                    @change="uploadWithEditor($event)"
                    class="w-full cursor-pointer rounded-2xl border border-slate-200/50 bg-white px-4 py-3 text-sm text-slate-500 transition file:mr-3 file:rounded-xl file:border-0 file:bg-primary/10 file:px-4 file:py-2 file:text-xs file:font-black file:uppercase file:text-primary hover:file:bg-primary/20 dark:border-slate-800/70 dark:bg-slate-950/45 dark:text-slate-400" />
            @else
                <input type="file"
                    name="{{ $fileName }}"
                    accept="{{ $accept }}"
                    @change="showLocalPreview($event)"
                    class="w-full cursor-pointer rounded-2xl border border-slate-200/50 bg-white px-4 py-3 text-sm text-slate-500 transition file:mr-3 file:rounded-xl file:border-0 file:bg-primary/10 file:px-4 file:py-2 file:text-xs file:font-black file:uppercase file:text-primary hover:file:bg-primary/20 dark:border-slate-800/70 dark:bg-slate-950/45 dark:text-slate-400" />
            @endif

            <p x-show="isUploading" class="text-[11px] font-bold text-primary">Mengupload gambar...</p>
        </div>
    </template>

    <div x-show="preview" class="flex items-center gap-3 rounded-xl border border-slate-100 bg-slate-50 p-3 dark:border-slate-800 dark:bg-slate-800">
        <img :src="preview" class="size-12 shrink-0 rounded-lg object-cover" alt="Preview gambar">
        <div class="min-w-0">
            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-slate-500">Preview</p>
            <p class="truncate text-[11px] font-medium text-slate-500 dark:text-slate-400"
                x-text="localFileName ? `File lokal dipilih: ${localFileName}` : (value || 'File lokal dipilih')"></p>
        </div>
    </div>

    <p x-show="error" x-text="error" class="text-[11px] font-bold text-red-500"></p>

    @if ($helper)
        <p class="text-[11px] text-slate-400 dark:text-slate-500">{{ $helper }}</p>
    @endif
</div>
