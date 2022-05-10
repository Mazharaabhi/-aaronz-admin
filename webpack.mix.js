const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .scripts([
        'resources/assets/admin/assets/plugins/global/plugins.bundle.js?v=7.0.5',
        'resources/assets/admin/assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.5',
        'resources/assets/admin/assets/js/scripts.bundle.js?v=7.0.5',
        'resources/assets/admin/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js?v=7.0.5',
        'resources/assets/admin/assets/js/pages/widgets.js?v=7.0.5',
        'resources/assets/common/intelPhone/intlTelInput.js',
        'resources/assets/admin/assets/js/pages/crud/forms/editors/summernote.js?v=7.0.5',
        'resources/assets/admin/assets/js/pages/crud/forms/widgets/select2.js?v=7.0.5',
        'resources/assets/imagelib/js/plugins/piexif.js',
        'resources/assets/imagelib/js/plugins/sortable.js',
        'resources/assets/imagelib/js/fileinput.js',
        'resources/assets/imagelib/js/locales/fr.js',
        'resources/assets/imagelib/js/locales/es.js',
        'resources/assets/imagelib/themes/fas/theme.js',
        'resources/assets/imagelib/themes/explorer-fas/theme.js',
    ], 'public/js/min.js')
    .styles([
        'resources/assets/admin/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css?v=7.0.5',
        'resources/assets/admin/assets/plugins/global/plugins.bundle.css?v=7.0.5',
        'resources/assets/admin/assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.5',
        'resources/assets/admin/assets/css/style.bundle.css?v=7.0.5',
        'resources/assets/admin/assets/css/themes/layout/header/base/light.css?v=7.0.5',
        'resources/assets/admin/assets/css/themes/layout/header/menu/light.css?v=7.0.5',
        'resources/assets/admin/assets/css/themes/layout/brand/dark.css?v=7.0.5',
        'resources/assets/admin/assets/css/themes/layout/aside/dark.css?v=7.0.5',
        'resources/assets/common/intelPhone/css/intlTelInput.css',
        'resources/assets/common/intelPhone/css/demo.css',
        'resources/assets/imagelib/css/fileinput.css',
        'resources/assets/imagelib/themes/explorer-fas/theme.css',
        'resources/assets/admin/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css?v=7.0.5',
    ], 'public/css/style.css')
    .copy([
        'resources/assets/common/images',
        'resources/assets/admin/assets/media/svg/misc',
        'resources/assets/admin/assets/media/users',
    ], 'public/images')
    .version();
