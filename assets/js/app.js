/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.scss in this case)
require('../css/app.scss');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');

// Bootstrap package installed via Yarn
require('bootstrap');


// required for popper.js (which Bootstrap uses)
$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});