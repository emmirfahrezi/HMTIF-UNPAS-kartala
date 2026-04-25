/**
 * Global Page Scripts (Navbar & Reveal)
 */
export function initGlobal() {
    initNavbar();
    initReveal();
    initSafeNavigation();
    initSafeExternalLinks();
    initImageFallbacks();
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

function initSafeNavigation() {
    document.querySelectorAll('[data-nav-target]').forEach((element) => {
        element.addEventListener('click', () => {
            const target = element.getAttribute('data-nav-target');
            const safeTarget = getSafeNavigationUrl(target);

            if (safeTarget) {
                window.location.assign(safeTarget);
            }
        });
    });
}

function initSafeExternalLinks() {
    document.querySelectorAll('a[data-external-url]').forEach((element) => {
        const safeUrl = getSafeExternalUrl(element.getAttribute('data-external-url'));

        if (safeUrl) {
            element.setAttribute('href', safeUrl);
            return;
        }

        element.removeAttribute('href');
        element.setAttribute('aria-disabled', 'true');
        element.classList.add('pointer-events-none', 'opacity-60');
    });
}

function initImageFallbacks() {
    document.querySelectorAll('img[data-fallback-src]').forEach((image) => {
        image.addEventListener('error', () => {
            const fallbackSrc = image.getAttribute('data-fallback-src');
            if (!fallbackSrc || image.dataset.fallbackApplied === 'true') return;

            image.dataset.fallbackApplied = 'true';
            image.src = fallbackSrc;
        });
    });
}

function getSafeNavigationUrl(target) {
    if (!target) return null;

    try {
        const url = new URL(target, window.location.origin);
        return url.origin === window.location.origin ? `${url.pathname}${url.search}${url.hash}` : null;
    } catch {
        return null;
    }
}

function getSafeExternalUrl(target) {
    if (!target) return null;

    try {
        const url = new URL(target, window.location.origin);
        return ['http:', 'https:', 'mailto:'].includes(url.protocol) ? url.toString() : null;
    } catch {
        return null;
    }
}
