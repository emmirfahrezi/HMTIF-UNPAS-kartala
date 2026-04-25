/**
 * Product Detail Page Scripts
 */
export function initProductDetail() {
    const mainImg = document.getElementById('mainProductImage');
    const thumbnails = document.querySelectorAll('.gallery-thumbnail');

    if (!mainImg || thumbnails.length === 0) return;

    const getSafeImageUrl = (target) => {
        if (!target) return null;

        try {
            const url = new URL(target, window.location.origin);
            return ['http:', 'https:'].includes(url.protocol) ? url.toString() : null;
        } catch {
            return null;
        }
    };

    thumbnails.forEach((thumb) => {
        thumb.addEventListener('click', () => {
            const newSrc = getSafeImageUrl(thumb.getAttribute('data-full'));
            if (!newSrc) return;
            
            // Fade out effect
            mainImg.style.opacity = '0';
            
            setTimeout(() => {
                mainImg.src = newSrc;
                mainImg.style.opacity = '1';
                
                // Update active state classes
                thumbnails.forEach(t => {
                    t.classList.remove('border-primary', 'ring-4', 'ring-primary/10');
                    t.classList.add('border-gray-50');
                });
                
                thumb.classList.add('border-primary', 'ring-4', 'ring-primary/10');
                thumb.classList.remove('border-gray-50');
            }, 300);
        });
    });
}
