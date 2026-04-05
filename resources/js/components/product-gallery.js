export function initProductGallery() {
    const mainImg = document.getElementById('mainProductImage');
    const thumbnails = document.querySelectorAll('.gallery-thumbnail');

    if (!mainImg || thumbnails.length === 0) return;

    thumbnails.forEach((thumb) => {
        thumb.addEventListener('click', () => {
            const newSrc = thumb.getAttribute('data-full');
            
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
