require('./../shared/app');

/**
 * Vue Models
 * ------------------
 * Load the basic vue models to extend from.
 */
window.VueModel = Vue.extend({
    mounted() {
        let scrollBarElements = $('.scroll');
        if (scrollBarElements.length) {
            scrollBarElements.perfectScrollbar();
        }
    },

    methods: {
        toggleNavbar: function () {
            $('#header').toggleClass('extended');
        },
    }
});