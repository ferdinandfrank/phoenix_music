/***********************************************************
 Detect Mobile Browser
 --------------------------
 Check if the visit is on a mobile device.
 ************************************************************/
if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
    $('html').addClass('ismobile');
}

/***********************************************************
 Load Lodash
 --------------------------

 ************************************************************/
window._ = require('lodash');

/***********************************************************
 Load JQuery
 --------------------------

 ************************************************************/
window.$ = window.jQuery = require('jquery');
$.ajaxSetup({
    headers: {'X-CSRF-TOKEN': Laravel.csrfToken}
});

/***********************************************************
 Load JQueryUI
 --------------------------

 ************************************************************/
require('./../vendor/jquery-ui.min');

/***********************************************************
 Load ContentTools
 --------------------------

 ************************************************************/
require('ContentTools');
import imageUploader from "./components/CodeareaImageUploader";
ContentTools.IMAGE_UPLOADER = imageUploader;

/***********************************************************
 Load Sweet Alert
 --------------------------

 ************************************************************/
require('sweetalert');

/***********************************************************
 Load Perfect Scrollbar
 --------------------------

 ************************************************************/
window.perfectScrollbar = require('perfect-scrollbar');
require('perfect-scrollbar/jquery')($);

/***********************************************************
 Load Moment
 --------------------------
 Moment is a javascript library that we can use to format dates
 It's similar to Carbon in PHP so we mostly use it to format
 dates that are returned from our Laravel Eloquent models
 ************************************************************/
window.moment = require('moment');

/***********************************************************
 Load VueJS
 --------------------------
 Vue is a modern JavaScript library for building interactive web interfaces
 using reactive data binding and reusable components. Vue's API is clean
 and simple, leaving you to focus on building your next great project.
 ************************************************************/
window.Vue = require('vue');
require('vue-resource');
Vue.http.interceptors.push((request, next) => {
    request.headers.set('X-CSRF-TOKEN', Laravel.csrfToken);

    next();
});

// Vue production settings
Vue.config.devtools = false;
Vue.config.debug = false;
Vue.config.silent = true;

require('./vueInit');

require('./helper');

