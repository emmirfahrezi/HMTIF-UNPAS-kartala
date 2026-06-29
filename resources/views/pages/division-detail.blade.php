<x-layouts.app :title="$division->name . ' | HMTIF-UNPAS'"
    :description="\Illuminate\Support\Str::limit($division->description, 155)"
    :keywords="$division->name . ', Bidang HMTIF, Divisi HMTIF, Struktur Organisasi HMTIF-UNPAS'" :transparent="false">
    <x-organisms.pages.division-detail.hero :division="$division" />
    <x-organisms.pages.division-detail.index :division="$division" />
</x-layouts.app>
