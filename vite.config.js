import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import { viteStaticCopy } from 'vite-plugin-static-copy'
import path from 'path'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // Admin Assets
                'resources/admin/sass/main.scss',
                'resources/admin/js/main.js',
                // 'resources/admin/js/menu-dnd-form.js',

                // Frontend Assets
                'resources/frontend/sass/styles.scss',
                'resources/frontend/js/app.js'
                // 'resources/frontend/js/home.js'
            ],
            refresh: true
        }),
        viteStaticCopy({
            targets: [
                // {
                //     src: 'resources/global/css',
                //     dest: 'assets'
                // },
                // {
                //     src: 'resources/global/js',
                //     dest: 'assets'
                // }
            ]
        })
    ],
    resolve: {
        alias: {
            '~fontawesome': path.resolve(
                __dirname,
                'node_modules/@fortawesome/fontawesome-free'
            )
        }
    }
})
