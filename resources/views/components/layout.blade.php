@props(['title' => 'HMTIF UNPAS', 'transparent' => false])
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ $title }}</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
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

    <!-- Include this script tag or install `@tailwindplus/elements` via npm: -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
</body>

</html>