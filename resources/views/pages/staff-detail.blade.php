<x-layouts.app title="Detail Pengurus | HMTIF-UNPAS"
    description="Halaman detail profil pengurus HMTIF-UNPAS berdasarkan data staff aktif."
    keywords="Detail Pengurus HMTIF, Profil Pengurus, Staff HMTIF" :transparent="false">
    <x-organisms.pages.staff-detail.hero />
    <x-organisms.pages.staff-detail.index :staff="$staff" />
</x-layouts.app>
