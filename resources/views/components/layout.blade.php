@props([
    'title' => 'HMTIF UNPAS | Kartala', 
    'description' => 'Website Resmi HMTIF UNPAS Kabinet Kartala. Teknik Informatika Progresif.',
    'keywords' => 'HMTIF, UNPAS, Kartala, Informatika, Universitas Pasundan, Himpunan Mahasiswa',
    'image' => 'https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=emerald&shade=600',
    'transparent' => false
])
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    
    <!-- Primary Meta Tags -->
    <title>{{ $title }}</title>
    <meta name="title" content="{{ $title }}">
    <meta name="description" content="{{ $description }}">
    <meta name="keywords" content="{{ $keywords }}">
    <meta name="author" content="HMTIF UNPAS">

    <!-- Custom Head Slot -->
    {{ $head ?? '' }}

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:image" content="{{ $image }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $title }}">
    <meta property="twitter:description" content="{{ $description }}">
    <meta property="twitter:image" content="{{ $image }}">
    
    <!-- SEO & Icons -->
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <x-organisms.navbar :transparent="$transparent" />

    <main class="{{ $transparent ? '' : 'pt-20' }}">
        {{ $slot }}
    </main>

    <x-organisms.footer />

    <!-- SCRIPT UNTUK SWAP GAMBAR -->
    <script>
        const bigBox = document.getElementById('bigPhoto');
        const smallBoxes = document.querySelectorAll('.swap-box');

        smallBoxes.forEach((box) => {
            box.addEventListener('click', () => {
                const smallImg = box.getAttribute('data-img');
                if (!bigBox || !bigBox.style.backgroundImage) return;

                const oldStyle = bigBox.style.backgroundImage;
                const oldImgArr = oldStyle.match(/url\(["']?([^"']*)["']?\)/);
                const oldBigImg = oldImgArr ? oldImgArr[1] : '';

                bigBox.style.backgroundImage = `url('${smallImg}')`;

                box.setAttribute('data-img', oldBigImg);
                const imgEl = box.querySelector('img');
                if (imgEl) imgEl.src = oldBigImg;
            });
        });
    </script>
</body>

</html>