require('./../shared/app');

/**
 * Load Select2
 */
require('./../vendor/select2/select2');

/**
 * Load DateTimePicker
 */
require('./../vendor/datetimepicker');

/**
 * Vue Models
 * ------------------
 * Load the basic vue models to extend from.
 */
window.VueModel = Vue.extend({

    data() {
        return {
            // States if the notifications have already been marked as read
            notificationsMarked: false
        }
    },

    mounted() {
        let scrollBarElements = $('.scroll');
        if (scrollBarElements.length) {
            scrollBarElements.perfectScrollbar();
        }

        // Hide sidebar if mobile
        if ($('html').hasClass('ismobile')) {
            this.toggleSidebar();
        }
    },

    methods: {
        toggleSidebar: function () {
            $('html').toggleClass('sidebar-collapsed')
        },

        markNotifications: function () {
            if (!this.notificationsMarked) {
                sendRequest('/admin/users/notifications', 'DELETE', null, () => {
                    this.notificationsMarked = true;
                });
            }
        }
    }
});









