@props([
    'title' => 'HMTIF UNPAS | Kartala',
    'description' => 'Website Resmi HMTIF UNPAS. Teknik Informatika Progresif.',
    'keywords' => 'HMTIF, UNPAS, Kartala, Informatika, Universitas Pasundan, Himpunan Mahasiswa',
    'image' => '/images/placeholders/hero-home.svg',
    'transparent' => false,
])
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <x-shared.head-meta 
        :title="$title" 
        :description="$description" 
        :keywords="$keywords" 
        :image="$image" 
    />

    {{-- Custom Head Slot --}}
    {{ $head ?? '' }}

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <x-organisms.pages.navbar :transparent="$transparent" />

    <main class="{{ $transparent ? '' : 'pt-(--nav-height)' }}">
        {{ $slot }}
    </main>

    <x-organisms.pages.footer />


</body>

</html>
