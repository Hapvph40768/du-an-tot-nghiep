<script>
    @php
        $viJson = json_decode(file_get_contents(base_path('lang/vi.json')), true) ?? [];
        $enJson = json_decode(file_get_contents(base_path('lang/en.json')), true) ?? [];
    @endphp
    document.addEventListener('alpine:init', () => {
        const currentLocale = '{{ App::getLocale() }}';
        const translations = {
            'vi': {!! json_encode($viJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) !!},
            'en': {!! json_encode($enJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) !!}};

        Alpine.store('lang', {
            current: localStorage.getItem('locale') || currentLocale,
            dictionary: translations,

            init() {
                if (this.current !== currentLocale) {
                    this.setLocale(this.current, false);
                }},

            setLocale(locale, reload = false) {
                this.current = locale;
                localStorage.setItem('locale', locale);

                fetch(`/set-locale/${locale}`)
                    .then(() => {
                        if (reload) window.location.reload();
                    });
            },

            t(key) {
                return this.dictionary[this.current] ? (this.dictionary[this.current][key] || key) : key;
            }});

        Alpine.magic('t', (el, { Alpine }) => (key) => {
            return Alpine.store('lang').t(key);
        });
    });
</script>
