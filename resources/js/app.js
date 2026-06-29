import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';
import persist from '@alpinejs/persist';

// Register Plugins
Alpine.plugin(intersect);
Alpine.plugin(persist);

// Register Alpine Components
Alpine.data('slugHelper', (initialSource = '', initialSlug = '') => ({
    sourceValue: initialSource,
    slugValue: initialSlug,

    init() {
        this.$watch('sourceValue', value => {
            this.slugValue = this.generateSlug(value);
        });
    },

    generateSlug(text) {
        if (!text) return '';
        return text
            .toString()
            .toLowerCase()
            .trim()
            .replace(/[^\w\s-]/g, '')
            .replace(/[\s_-]+/g, '-')
            .replace(/^-+|-+$/g, '');
    }
}));


// ─── Vanilla JS: Global Reveal Observer (Only for Public Pages) ───
document.addEventListener('DOMContentLoaded', () => {
    // Check if we are NOT in dashboard before running reveal
    if (window.location.pathname.startsWith('/dashboard')) return;

    const reveals = document.querySelectorAll('.reveal');
    if (!reveals.length) return;

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    // Use requestAnimationFrame for smoother entry
                    requestAnimationFrame(() => {
                        entry.target.classList.add('active');
                    });
                    observer.unobserve(entry.target);
                }
            });
        },
        {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px' // Start animation slightly before element enters
        }
    );

    reveals.forEach((el) => observer.observe(el));
});

// ─── Vanilla JS: Global Helpers ───
window.confirmAction = (options) => {
    window.dispatchEvent(new CustomEvent('open-confirm-modal', {
        detail: {
            title: options.title || 'Konfirmasi',
            message: options.message || 'Apakah Anda yakin ingin melanjutkan?',
            action: options.action || '',
            method: options.method || 'POST',
            confirmLabel: options.confirmLabel || 'Ya, Lanjutkan',
            variant: options.variant || 'primary', // 'danger', 'primary', 'warning'
            icon: options.icon || 'info', // 'trash', 'logout', 'info', 'warning'
            isBulk: options.isBulk || false,
            count: options.count || 0,
            targetFormId: options.targetFormId || null
        }
    }));
};

window.openDeleteModal = (action, message = null) => {
    window.confirmAction({
        title: 'Konfirmasi Hapus',
        message: message || 'Apakah Anda yakin ingin menghapus data ini?',
        action: action,
        method: 'DELETE',
        confirmLabel: 'Ya, Hapus',
        variant: 'danger',
        icon: 'trash'
    });
};

window.openBulkDeleteModal = (formId, count) => {
    window.confirmAction({
        title: `Hapus ${count} Item`,
        message: `Apakah Anda yakin ingin menghapus ${count} data yang dipilih?`,
        method: 'DELETE',
        confirmLabel: 'Ya, Hapus Semua',
        variant: 'danger',
        icon: 'trash',
        isBulk: true,
        count: count,
        targetFormId: formId
    });
};

window.openLogoutModal = (action) => {
    window.confirmAction({
        title: 'Konfirmasi Keluar',
        message: 'Apakah Anda yakin ingin mengakhiri sesi dashboard ini?',
        action: action,
        method: 'POST',
        confirmLabel: 'Ya, Keluar',
        variant: 'primary',
        icon: 'logout'
    });
};

window.toggleModal = (name) => {
    window.dispatchEvent(new CustomEvent('toggle-modal', { detail: { name: name } }));
};

window.openModal = (name) => {
    window.dispatchEvent(new CustomEvent('open-modal', { detail: { name: name } }));
};

window.closeModal = (name) => {
    window.dispatchEvent(new CustomEvent('close-modal', { detail: { name: name } }));
};

window.toast = (message, type = 'success') => {
    window.dispatchEvent(new CustomEvent('toast', { detail: { message, type } }));
};

// ─── Vanilla JS: Image Fallback ───
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-fallback-src]').forEach((img) => {
        img.addEventListener('error', function () {
            if (this.dataset.fallbackApplied) return;
            this.dataset.fallbackApplied = 'true';
            this.src = this.dataset.fallbackSrc;
        }, { passive: true });
    });
});

// ─── Start Alpine ───
window.Alpine = Alpine;
Alpine.start();
