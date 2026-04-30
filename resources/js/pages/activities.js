import Alpine from 'alpinejs';

Alpine.data('loadMore', (initialNextUrl) => ({
    nextUrl: initialNextUrl,
    loading: false,

    async load() {
        if (!this.nextUrl || this.loading) return;
        
        this.loading = true;
        
        try {
            const response = await fetch(this.nextUrl, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                },
            });

            if (!response.ok) throw new Error('Failed to load more');

            const html = await response.text();
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');

            const grid = document.getElementById('activity-grid');
            const incomingItems = doc.querySelectorAll('#activity-grid > *');
            
            incomingItems.forEach((item) => {
                // Manually trigger reveal for new items if they have x-reveal
                grid.appendChild(item);
            });

            const nextBtn = doc.querySelector('#activity-load-more');
            this.nextUrl = nextBtn ? nextBtn.getAttribute('href') : null;

        } catch (error) {
            console.error('Load more error:', error);
        } finally {
            this.loading = false;
        }
    }
}));
