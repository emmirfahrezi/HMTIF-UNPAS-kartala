@props(['division' => null])

<section class="py-8 md:py-10">
    <div class="mx-auto px-6 lg:px-8 max-w-screen-2xl">
        @if ($division)
            <x-organisms.pages.detail-division.roles-description :division="$division" />
        @else
            <x-organisms.pages.detail-division.empty />
        @endif
    </div>
</section>

