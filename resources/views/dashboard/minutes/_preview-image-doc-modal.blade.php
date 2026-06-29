<x-molecules.shared.modal id="minute-documentation-preview" title="Preview Dokumentasi" maxWidth="2xl">
    <div class="rounded-2xl border border-slate-100 bg-slate-50 p-2 dark:border-slate-800 dark:bg-slate-950">
        <img
            src="{{ $documentationSrc }}"
            alt="Dokumentasi {{ basename($documentationFile) }}"
            class="mx-auto max-h-[75vh] w-full rounded-xl object-contain"
        >
    </div>
</x-molecules.shared.modal>
