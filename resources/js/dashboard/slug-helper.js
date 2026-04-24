/**
 * Slug Helper
 * Automatically generates a slug from a source field when it loses focus.
 */
document.addEventListener('DOMContentLoaded', function() {
    const slugSources = document.querySelectorAll('[data-slug-source]');
    
    slugSources.forEach(source => {
        source.addEventListener('blur', function() {
            const targetId = this.dataset.slugSource;
            const targetField = document.getElementById(targetId);
            
            if (targetField && !targetField.value) {
                targetField.value = this.value
                    .toLowerCase()
                    .replace(/[^a-z0-9]+/g, '-')
                    .replace(/(^-|-$)/g, '');
            }
        });
    });
});
