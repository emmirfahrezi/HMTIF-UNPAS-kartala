<x-layouts.app :title="$staff->name . ' — ' . $staff->position . ' | HMTIF-UNPAS'"
    :description="$staff->bio ? \Illuminate\Support\Str::limit(strip_tags($staff->bio), 155) : $staff->name . ' merupakan ' . $staff->position . ' HMTIF-UNPAS Kabinet Kartala.'"
    keywords="Pengurus HMTIF, Profil Pengurus, Staff HMTIF" :transparent="false">
    <x-organisms.pages.staff-detail.hero />
    <x-organisms.pages.staff-detail.index :staff="$staff" />
</x-layouts.app>
