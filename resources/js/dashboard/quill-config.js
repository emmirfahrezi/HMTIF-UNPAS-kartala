/**
 * Quill Editor Initialization
 */
document.addEventListener('DOMContentLoaded', function() {
    const editors = document.querySelectorAll('.quill-editor');

    editors.forEach(container => {
        const name = container.dataset.name;
        const placeholder = container.dataset.placeholder || '';
        const hiddenInput = document.getElementById(`${name}_hidden`);
        const initialContentElement = document.getElementById(`${name}_initial`);

        if (!hiddenInput) return;

        // Custom Icons for Undo/Redo
        const icons = Quill.import('ui/icons');
        icons['undo'] = '<svg viewbox="0 0 18 18"><polygon class="ql-fill ql-stroke" points="6 10 4 12 2 10 6 10"></polygon><path class="ql-stroke" d="M6,10a4,4,0,1,1,4,4H8"></path></svg>';
        icons['redo'] = '<svg viewbox="0 0 18 18"><polygon class="ql-fill ql-stroke" points="12 10 14 12 16 10 12 10"></polygon><path class="ql-stroke" d="M12,10a4,4,0,1,0-4,4h2"></path></svg>';

        const quill = new Quill(container, {
            theme: 'snow',
            placeholder: placeholder,
            modules: {
                toolbar: {
                    container: [
                        [{'font': []}, {'size': ['small', false, 'large', 'huge']}],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{'color': []}, {'background': []}],
                        [{'script': 'sub'}, {'script': 'super'}],
                        [{'header': 1}, {'header': 2}, 'blockquote', 'code-block'],
                        [{'list': 'ordered'}, {'list': 'bullet'}, {'indent': '-1'}, {'indent': '+1'}],
                        [{'direction': 'rtl'}, {'align': []}],
                        ['link', 'image', 'video', 'table'],
                        ['clean'],
                        ['undo', 'redo']
                    ],
                    handlers: {
                        'undo': function() { this.quill.history.undo(); },
                        'redo': function() { this.quill.history.redo(); }
                    }
                },
                history: { delay: 1000, maxStack: 100, userOnly: true }
            }
        });

        if (initialContentElement?.textContent) {
            try {
                const initialContent = JSON.parse(initialContentElement.textContent);
                const delta = quill.clipboard.convert({ html: initialContent || '' });
                quill.setContents(delta, 'silent');
            } catch (error) {
                console.error('Failed to parse initial rich text content', error);
            }
        }

        hiddenInput.value = quill.root.innerHTML;

        // Sync with hidden input
        quill.on('text-change', function() {
            hiddenInput.value = quill.root.innerHTML;
        });
    });
});
