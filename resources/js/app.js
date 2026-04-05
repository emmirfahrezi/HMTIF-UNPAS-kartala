import { initNavbar } from './components/navbar';
import { initImageSwap } from './components/image-swap';
import { initProductGallery } from './components/product-gallery';
import { initReveal } from './components/reveal';

document.addEventListener('DOMContentLoaded', () => {
    initNavbar();
    initImageSwap();
    initProductGallery();
    initReveal();
});
