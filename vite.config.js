//vite.config.js

import { defineConfig}  from 'vite';
import symfonyPlugin from 'vite-plugin-symfony';

export default defineConfig ({
    plugins: [symfonyPlugin()],
    root: 'assets',
    base: '/build/',
    build: {
        outDir:'../public/build',
        emptyOutDir: true,
        manifest: true,
    },
    server: {
        port: 5173,
        strictPort: true,
        hmr: {
            host: 'localhost',
        },
    },
});

