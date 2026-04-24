/**
 * Global Page Scripts (Navbar & Reveal)
 */
export function initGlobal() {
    initNavbar();
    initReveal();
}

function initNavbar() {
    const navbar = document.getElementById('navbar');
    if (!navbar) return;

    const topNav = navbar.querySelector('nav[aria-label="Global"]');
    const navElements = topNav ? topNav.querySelectorAll('a, button, h1, span') : [];

    const isTransparentInitial = navbar.getAttribute('data-transparent') === 'true';

    if (isTransparentInitial) {
        const updateNavbar = () => {
            if (window.scrollY > 50) {
                navbar.classList.remove('bg-transparent');
                navbar.classList.add('bg-white', 'shadow-md');
                navElements.forEach((el) => {
                    if (!el.classList.contains('text-primary')) {
                        el.classList.remove('text-white');
                        el.classList.add('text-gray-900');
                    }
                });
            } else {
                navbar.classList.add('bg-transparent');
                navbar.classList.remove('bg-white', 'shadow-md');
                navElements.forEach((el) => {
                    if (!el.classList.contains('text-primary')) {
                        el.classList.add('text-white');
                        el.classList.remove('text-gray-900');
                    }
                });
            }
        };
        updateNavbar();
        window.addEventListener('scroll', updateNavbar);
    }
}

function initReveal() {
    const reveals = document.querySelectorAll('.reveal');
    if (!reveals.length) return;

    if (!('IntersectionObserver' in window)) {
        reveals.forEach((reveal) => reveal.classList.add('active'));
        return;
    }

    const observerOptions = {
        root: null,
        rootMargin: '0px 0px -8% 0px',
        threshold: 0.08,
    };

    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
                revealObserver.unobserve(entry.target);
            }
        });
    }, observerOptions);

    reveals.forEach((reveal) => {
        revealObserver.observe(reveal);
    });
}
