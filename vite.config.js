import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/css/filament/admin/theme.css'],
            refresh: true,
        }),
        tailwindcss(),
        plugin(function({ addUtilities }) {
          addUtilities({
            '.no-scrollbar::-webkit-scrollbar': {
              'display': 'none',
            },
            '.no-scrollbar': {
              '-ms-overflow-style': 'none',  /* IE and Edge */
              'scrollbar-width': 'none',  /* Firefox */
            },
          })
        })
    ],
});
