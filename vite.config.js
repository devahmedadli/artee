import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

/**
 * Get Files from a directory
 * @param {string} query
 * @returns array
 */
import fs from 'fs';
import path from 'path';

function GetFilesArray(query) {
    const directory = path.dirname(query);
    const filePattern = new RegExp(path.basename(query).replace(/\*\*/g, '.*').replace(/\*/g, '[^/]*'));

    return fs.readdirSync(directory).filter(file => filePattern.test(file)).map(file => path.join(directory, file));
}

// Page JS Files
const productJsFiles = [
    'resources/js/pages/products/create.js',
    'resources/js/pages/products/product-form.js',
];

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css',
                'resources/js/app.js',
                'resources/js/bootstrap.js',
                'resources/js/echo.js',
                ...productJsFiles,
            ],
            refresh: true,
        }),
    ],
});
