import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/sobres.css',
                'resources/css/welcome.css',
                'resources/css/album.css',
                'resources/css/pokedex.css',
                'resources/css/minijuegos.css',
                'resources/css/apertura.css',
                'resources/css/auth.css',
                'resources/css/recarga.css',
                'resources/css/admin.css',
                'resources/css/perfil.css'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
