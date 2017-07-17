// window._ = require('lodash');

// Load jQuery and the Bootstrap jQuery plugin.
try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap-sass');
} catch (e) {
}
