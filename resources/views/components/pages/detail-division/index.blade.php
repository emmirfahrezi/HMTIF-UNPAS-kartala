@props(['division' => null])

<section class="py-8 md:py-10">
    <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl">
        <a href="/staff"
            class="inline-flex items-center gap-2 text-primary font-bold text-sm hover:translate-x-1 transition-transform group mb-6">
            <x-heroicon-o-arrow-left class="size-4" />
            Kembali ke Daftar Bidang
        </a>

        @if ($division)
            <x-pages.detail-division.header :division="$division" />
            <x-pages.detail-division.members-grid :division="$division" />
        @else
            <x-pages.detail-division.empty />
        @endif
    </div>
</section>
