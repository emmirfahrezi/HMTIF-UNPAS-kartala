export function initNavbar() {
    const navbar = document.getElementById('navbar');
    if (!navbar) return;

    const navElements = document.querySelectorAll('#navbar a, #navbar button, #navbar h1, #navbar span');
    const logo = document.getElementById('nav-logo');
    
    // Ambil status awal dari data-attribute
    const isTransparentInitial = navbar.getAttribute('data-transparent') === 'true';

    if (isTransparentInitial) {
        const updateNavbar = () => {
            if (window.scrollY > 50) {
                navbar.classList.remove('bg-transparent');
                navbar.classList.add('bg-white', 'shadow-md');
                if (logo) logo.classList.remove('filter', 'grayscale', 'brightness-200');

                navElements.forEach((el) => {
                    if (!el.classList.contains('text-primary')) {
                        el.classList.remove('text-white');
                        el.classList.add('text-gray-900');
                    }
                });
            } else {
                navbar.classList.add('bg-transparent');
                navbar.classList.remove('bg-white', 'shadow-md');
                if (logo) logo.classList.add('filter', 'grayscale', 'brightness-200');

                navElements.forEach((el) => {
                    if (!el.classList.contains('text-primary')) {
                        el.classList.add('text-white');
                        el.classList.remove('text-gray-900');
                    }
                });
            }
        };

        // Jalankan saat pertama kali dimuat
        updateNavbar();

        // Jalankan saat di-scroll
        window.addEventListener('scroll', updateNavbar);
    }
}
