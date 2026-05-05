<script>
    // Pass current locale and translations to JavaScript
    window.currentLocale = '<?php echo app()->getLocale(); ?>';

    // Load translations from JSON file
    (function() {
        const locale = window.currentLocale;
        const fallbackTranslations = <?php echo json_encode(json_decode(file_get_contents(base_path('lang/' . app()->getLocale() . '.json')), true)); ?>;
        window.translations = fallbackTranslations || {};
    })();

    // Translation function for Alpine.js and vanilla JS
    window.t = function(key, replacements = {}) {
        let text = window.translations[key] || key;
        // Simple placeholder replacement: :name → value
        for (const [k, v] of Object.entries(replacements)) {
            text = text.replace(':' + k, v);
        }
        return text;
    };

    // Alpine.js magic: $t()
    if (typeof Alpine !== 'undefined') {
        document.addEventListener('alpine:init', () => {
            Alpine.magic('t', () => (key, replacements = {}) => window.t(key, replacements));
        });
    }
</script>
<?php /**PATH E:\code\laragon\www\du-an-tot-nghiep\resources\views/layout/partials/translator.blade.php ENDPATH**/ ?>