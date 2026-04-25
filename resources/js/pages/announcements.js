/**
 * Announcements Page Script (Load More)
 */
export function initAnnouncements() {
    const grid = document.getElementById('announcement-grid');
    const container = document.getElementById('announcement-load-more-container');

    if (!grid || !container) return;

    const replaceContainerChildren = (target, source) => {
        const nextChildren = Array.from(source.children).map((child) => child.cloneNode(true));
        target.replaceChildren(...nextChildren);
    };

    const bindLoadMore = () => {
        const loadMore = document.getElementById('announcement-load-more');

        if (!loadMore) return;

        loadMore.addEventListener('click', async (event) => {
            event.preventDefault();

            const nextUrl = loadMore.getAttribute('href');
            if (!nextUrl) return;

            loadMore.classList.add('pointer-events-none', 'opacity-60');

            try {
                const response = await fetch(nextUrl, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                });

                if (!response.ok) throw new Error('Failed to load more announcements');

                const html = await response.text();
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');

                const incomingCards = doc.querySelectorAll('#announcement-grid > *');
                incomingCards.forEach((card) => {
                    grid.appendChild(card);
                });

                const incomingContainer = doc.getElementById('announcement-load-more-container');
                if (incomingContainer) {
                    replaceContainerChildren(container, incomingContainer);
                    bindLoadMore();
                }
            } catch (error) {
                console.error(error);
                loadMore.classList.remove('pointer-events-none', 'opacity-60');
            }
        }, {
            once: true
        });
    };

    bindLoadMore();
}
