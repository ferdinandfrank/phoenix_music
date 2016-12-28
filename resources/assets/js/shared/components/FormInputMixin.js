module.exports = {

    props: {
        // The name of the input. Will also be the name of the value, when the form gets submitted.
        name: {
            type: String,
            required: true
        },

        // The predefined value of the input.
        // See property: 'submitValue'
        value: {
            type: String,
            default: ''
        },

        // The language key of the label.
        // See computed property: 'label'.
        langKey: {
            type: String
        },

        // True, if the input shall be disabled.
        disabled: {
            type: Boolean,
            default: false
        },

        // True, if a label shall be displayed above the input.
        showLabel: {
            type: Boolean,
            default: true
        },

        // Function to check if the input is valid. If it is invalid an error message,
        // based upon the property 'name' and 'langKey' will be shown to the user.
        // The function receives the current value of the input as first parameter
        // and a callback function as the second. This callback must return true,
        // if the input is valid and false otherwise.
        check: {
            type: Function
        },

        // States if a value on the input is required.
        required: {
            type: Boolean,
            default: false
        },

        // The minimum length of the input value.
        minLength: {
            type: Number
        },

        // The maximum length of the input value.
        maxLength: {
            type: Number
        },

        // If true, the input is treated as a confirmation input and needs to have a corresponding input with the same value.
        // Ex.: If the name of this input is 'foo_confirmation', the input with the name 'foo' must have the same value.
        confirmed: {
            type: Boolean
        },

        // States if a placeholder shall be shown on the input.
        showPlaceholder: {
            type: Boolean,
            default: false
        },

        // The path of the page to send the user if he clicks the help icon on the input.
        // No icon will be shown if this property isn't set.
        helpPath: {
            type: String
        }
    },

    data: function () {
        return {
            // The predefined value of the input, that gets submitted.
            submitValue: this.value,

            // The input field of this component.
            input: '',

            // The label of the input field.
            inputLabel: '',

            // The wrapper of the input field.
            inputWrapper: '',

            // States if this input can be submitted in a form.
            allowSubmit: !this.required || this.value ? true : false,

            showHelp: this.helpPath,

            labelMessage: '',

            isInvalid: false,

            isValid: false
        }
    },

    computed: {
        // The label text of the input, based upon the property 'name' or the property 'langKey', if it is set.
        label: function () {
            let langKey = this.name;
            if (this.langKey) {
                langKey = this.langKey + '.' + this.name;
            }
            return this.$t('input.' + langKey);
        },

        // The placeholder text of the input, based upon the property 'name' or the property 'langKey', if it is set.
        placeholder: function () {
            let langKey = this.name;
            if (this.langKey) {
                langKey = this.langKey + '.' + this.name;
            }
            return this.$t('placeholder.' + langKey);
        },

        // The text to show to the user, if the check function exists and returns false.
        errorMessage: function () {
            return this.getLocalizationString(this.name);
        },

        // The text to show to the user, if the input is required and the user did not enter a value.
        requiredMessage: function () {
            return this.getLocalizationString('required');
        },

        // The text to show to the user, if the value of the input is to short.
        minLengthMessage: function () {
            return this.getLocalizationString('min.string', {min: this.minLength});
        },

        // The text to show to the user, if the value of the input is to long.
        maxLengthMessage: function () {
            return this.getLocalizationString('max.string', {max: this.maxLength});
        },

        // The text to show to the user, if the confirmation input does not have the same value as this input.
        confirmedMessage: function () {
            return this.getLocalizationString('confirmed');
        }
    },

    watch: {
        /**
         * Watch the submit permission of the input, to notify the parent form.
         */
        allowSubmit: function () {
            let parent = this.$parent;
            while (parent != null) {
                if (isFunction(parent.updateFormSubmitPermission)) {
                    parent.updateFormSubmitPermission();
                }
                parent = parent.$parent;
            }
        },

        value: function (value) {
            this.submitValue = value;
        }
    },

    mounted() {
        this.$nextTick(function () {
            this.input = $(this.$refs.input);
            this.inputWrapper = $(this.$refs.inputWrapper);
            this.inputLabel = $(this.$refs.inputLabel);
        })
    },

    methods: {
        /**
         * Clears the input's value and the info text (error, success).
         */
        clear: function () {
            this.clearInfo();
            this.clearValue();
        },

        /**
         * Clears the input's info text (error, success).
         */
        clearInfo: function () {
            $(this.$el).removeClass('has-error').removeClass('has-success');
            $(this.$el).find('.error, .success').removeClass('error').removeClass('success');
        },

        /**
         * Clears the input's value.
         */
        clearValue: function () {
            this.submitValue = '';
            this.inputLabel.removeClass('active');
        },

        /**
         * Activates the inputs editing style.
         */
        activate: function () {
            this.inputWrapper.addClass('active');
        },

        /**
         * Deactivates the inputs editing style.
         */
        deactivate: function () {
            this.inputWrapper.removeClass('active');
        },

        /**
         * Gets called if the value of the input changes.
         */
        onInput: function () {
            window.eventHub.$emit(this.name + '-input-changed', this.submitValue);
            this.checkInput();
        },

        /**
         * Checks if the current value of the input is valid and
         * updates the input's label, based on the input's value.
         */
        checkInput: function () {
            if (this.checkRequired()
                && this.checkComponentSpecific()
                && this.checkMinLength()
                && this.checkMaxLength()
                && this.checkConfirmed()) {
                if (isFunction(this.check)) {
                    this.check(this.submitValue, (valid, errorMessage) => {
                        if (valid) {
                            this.addSuccess();
                            this.allowSubmit = true;
                        } else {
                            this.addError(errorMessage);
                            this.allowSubmit = false;
                        }
                    });
                } else {
                    this.addSuccess();
                    this.allowSubmit = true;
                }
            } else {
                this.allowSubmit = false;
            }
        },

        /**
         * Checks if the input's value is valid regarding the property 'required'.
         * If not an error message will be shown on the input.
         *
         * @returns {boolean}
         */
        checkRequired: function () {
            if (!this.submitValue && this.required) {
                this.addError(this.requiredMessage);
                return false;
            }
            return true;
        },

        /**
         * Checks if the input's value is valid regarding the property 'maxLength'.
         * If not an error message will be shown on the input.
         *
         * @returns {boolean}
         */
        checkMaxLength: function () {
            if (this.maxLength && this.submitValue.length > this.maxLength) {
                this.addError(this.maxLengthMessage);
                return false;
            }
            return true;
        },

        /**
         * Checks if the input's value is valid regarding the property 'minLength'.
         * If not an error message will be shown on the input.
         *
         * @returns {boolean}
         */
        checkMinLength: function () {
            if (this.minLength && this.submitValue.length < this.minLength) {
                this.addError(this.minLengthMessage);
                return false;
            }
            return true;
        },

        /**
         * Checks if the input's value is valid regarding the property 'confirmed'.
         * If not an error message will be shown on the input.
         *
         * @returns {boolean}
         */
        checkConfirmed: function () {
            if (this.confirmed) {
                let confirmNameLength = this.name.length - '_confirmation'.length;
                let confirmName = this.name.substring(0, confirmNameLength);
                let confirmInput = this.input.parents('form').first().find(':input[name=' + confirmName + ']').first();
                if (confirmInput.val() != this.submitValue) {
                    this.addError(this.confirmedMessage);
                    return false;
                }
            }
            return true;
        },

        /**
         * Checks if the input's value is valid regarding the specific needs in an input component.
         *
         * @returns {boolean}
         */
        checkComponentSpecific: function () {
            return true;
        },

        /**
         * Adds the specified error message to the input field.
         *
         * @param errorMessage
         */
        addError: function (errorMessage = this.errorMessage) {
            this.isInvalid = true;
            this.isValid = false;
            this.labelMessage = errorMessage;
        },

        /**
         * Shows a success sign on the input field.
         */
        addSuccess: function () {
            this.isInvalid = false;
            this.isValid = true;
            this.labelMessage = null;
        },

        /**
         * Opens the help page for the input.
         */
        openHelp: function () {
            window.open(this.helpPath, '_blank');
        },

        /**
         * Gets the localization string for the error messages.
         *
         * @param type
         * @param props
         * @param plain
         * @returns {string}
         */
        getLocalizationString: function (type = null, props = null, plain = false) {
            let langKey = '';
            if (this.langKey && !plain) {
                langKey = this.langKey + '.';
            }

            let key = 'validation.' + langKey;
            let defaultKey = key;
            if (type) {
                key = 'validation.' + langKey + type;
                defaultKey = 'validation.' + type;
            }

            let text = this.$t(key, props);
            if (text == key) {
                text = this.$t(defaultKey, props);
            }

            return text;
        },
    }
};

