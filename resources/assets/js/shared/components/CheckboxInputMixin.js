import formInputMixin from "./FormInputMixin";

module.exports = {

    mixins: [formInputMixin],

    props: {
        // The predefined value of the checkbox.
        value: {
            type: Boolean,
            default: false
        },

        // The color of the checkbox.
        color: {
            type: String,
        },
    },

    watch: {

        submitValue: function (value) {
            // Needed to change the values ('on' or 'off') to real boolean integers (1 or 0).
            this.input.val(value ? 1 : 0);
        }
    },

    methods: {
        /**
         * Toggles the submit value.
         */
        toggleValue: function () {
            this.submitValue = !this.submitValue;
            this.onInput();
        },
    }

};

