const mix = require('laravel-mix');

const VuetifyLoaderPlugin = require('vuetify-loader/lib/plugin');
const CaseSensitivePathsPlugin = require('case-sensitive-paths-webpack-plugin');
const MomentLocalesPlugin = require('moment-locales-webpack-plugin');

var webpackconfig = {
   plugins: [
         new VuetifyLoaderPlugin(),
         new CaseSensitivePathsPlugin(),
         new MomentLocalesPlugin({
            localesToKeep: ['ru'],
        })
   ]
}

mix.webpackConfig( webpackconfig );

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');

mix.styles([
   'resources/sass/page.scss',
], 'public/css/page.css');