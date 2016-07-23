
/*
 |--------------------------------------------------------------------------
 | Laravel Spark Bootstrap
 |--------------------------------------------------------------------------
 |
 | First, we will load all of the "core" dependencies for Spark which are
 | libraries such as Vue and jQuery. This also loads the Spark helpers
 | for things such as HTTP calls, forms, and form validation errors.
 |
 | Next, we'll create the root Vue application for Spark. This will start
 | the entire application and attach it to the DOM. Of course, you may
 | customize this script as you desire and load your own components.
 |
 */

/**
 * Load the pace library and immediately start it
 */
window.pace = require('pace');
pace.start();

require('spark-bootstrap');

require('metismenu');
require('jquery-slimscroll');

/**
 * Require sortable
 */
window.Sortable = require('sortablejs');

/**
 * Require toastr and set options
 */
window.toastr = require('toastr');

toastr.options = {
    "closeButton": true,
    "debug": false,
    "progressBar": true,
    "preventDuplicates": false,
    "positionClass": "toast-top-right",
    "onclick": null,
    "showDuration": 400,
    "hideDuration": 1000,
    "timeOut": 7000,
    "extendedTimeOut": 1000,
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

window.Dropzone = require('dropzone');
Dropzone.autoDiscover = false;

/**
 * Require inspinia scripts
 */
require('./inspinia');

require('./components/bootstrap');

var app = new Vue({
    mixins: [require('spark')]
});