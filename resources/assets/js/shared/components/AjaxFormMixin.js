module.exports = {

    props: {
        // The default submit action of the form.
        // See computed property: 'submitAction'
        action: {
            type: String,
            required: true
        },

        // The method to use for the submit.
        // See computed property: 'submitMethod'
        method: {
            type: String,
            required: true
        },

        // Check if a confirm message shall be shown, before the form is going to be submitted.
        // Note: There will always be a confirm message, if the method is set to 'delete'.
        // See computed property: 'showConfirm'
        confirm: {
            type: Boolean,
            default: false
        },

        // Check if a alert message shall be shown, after the request from the server has been received.
        // Note: There will always be an alert if an error occurred, no matter how this property is set.
        // To prevent an error alert set the 'alertError' property to false.
        // Note2: There will be no alert on 'get' requests by default. Except the property 'alertKey' is set.
        // See computed property: 'showAlert'
        alert: {
            type: Boolean,
            default: true
        },

        // Set to false, to not show an error message, if an error occurred.
        alertError: {
            type: Boolean,
            default: true
        },

        // The key to use to identify the messages to show to the user on an alert or on a confirm alert.
        alertKey: {
            type: String,
            default: 'default'
        },

        // The name of the object to make this request. Used for delete and update confirms.
        objectName: {
            type: String
        },

        // The type of the confirm alert to ask the user, if he really wants to submit the form.
        // Will only be of use if the 'confirm' property is set to true.
        confirmType: {
            type: String,
            default: 'warning'
        },

        // The duration of the alert, that will be shown after the form has been submitted.
        alertDuration: {
            type: Number,
            default: 3000
        },

        // The selector of the element, where to show a loader, when the submit request is pending.
        // Do not define this property, if no loader shall be shown.
        loadingWrapperSelector: {
            type: String
        },

        // Set to false, if the loader shall not be reset after a response from the server has been received.
        // Useful if the user shall be redirected after the submit.
        stopLoading: {
            type: Boolean,
            default: true
        },

        // The name of the event to call, after the form has been submitted.
        callbackName: {
            type: String,
            default: 'ajaxFormResponse'
        },

        // The selector of the wrapper, where to append the response to.
        appendResponse: {
            type: String
        },

        // The selector of the wrapper, where to prepend the response to.
        prependResponse: {
            type: String
        },

        // The selector of the element, to replace with the response.
        replaceResponse: {
            type: String
        },

        // The link to redirect the user after the form was successfully submitted.
        // If this property is not set, no redirect will occur.
        redirect: {
            type: String
        }
    },

    computed: {

        // The title of the alert to show after the request from the server has been received.
        // Will be determined by the 'alertKey' property and the method of the next submit.
        // Will only be of use if the 'alert' property is set to true.
        alertTitle: function () {
            return this.getLocalizationString('alert', 'title');
        },

        // The message of the alert to show after the request from the server has been received.
        // Will be determined by the 'alertKey' property and the method of the next submit.
        // Will only be of use if the 'alert' property is set to true.
        alertMessage: function () {
            if ((this.submitMethod == 'delete' || this.submitMethod == 'put')
                && this.objectName) {
                return this.getLocalizationString('alert', 'content', {name: this.objectName});
            }

            return this.getLocalizationString('alert', 'content');
        },

        // The title of the confirm alert to ask the user, if he really wants to submit the form.
        // Will be determined by the 'alertKey' property and the method of the next submit.
        // Will only be of use if the 'confirm' property is set to true.
        confirmTitle: function () {
            return this.getLocalizationString('confirm', 'title');
        },

        // The message of the confirm alert to ask the user, if he really wants to submit the form.
        // Will be determined by the 'alertKey' property and the method of the next submit.
        // Will only be of use if the 'confirm' property is set to true.
        confirmMessage: function () {
            if ((this.submitMethod == 'delete' || this.submitMethod == 'put')
                && this.objectName) {
                return this.getLocalizationString('confirm', 'content', {name: this.objectName});
            }

            return this.getLocalizationString('confirm', 'content');
        },

        // The text of the confirm alert's ACCEPT button to ask the user, if he really wants to submit the form.
        // Will be determined by the 'alertKey' property and the method of the next submit.
        // Will only be of use if the 'confirm' property is set to true.
        confirmAccept: function () {
            return this.getLocalizationString('confirm', 'accept');
        },

        // The text of the confirm alert's CANCEL button to ask the user, if he really wants to submit the form.
        // Will be determined by the 'alertKey' property and the method of the next submit.
        // Will only be of use if the 'confirm' property is set to true.
        confirmCancel: function () {
            return this.getLocalizationString('confirm', 'cancel');
        },

        // Holds the state, if a confirm message shall be shown before the submit.
        // Note: A confirm message will always be shown, if the method is set to 'delete'.
        showConfirm: function () {
            if (!this.confirm && this.submitMethod == 'delete') {
                return true;
            }
            return this.confirm;
        },

        // Holds the state, if an alert message shall be shown after the submit.
        // Note: An alert message won't be shown, if the method is set to 'get'.
        showAlert: function () {
            if (this.submitMethod == 'get' && this.alertKey == 'default') {
                return false;
            }
            return this.alert;
        },

    },

    data() {
        return {
            // The url, where to send the form request.
            submitAction: this.action,

            // The method to use for the submit.
            submitMethod: this.method.toLowerCase(),

            // States, if the form can be submitted.
            allowSubmit: true,

            // The html content to put in the loading wrapper, after the form has been submitted and the loader has stopped.
            loadingWrapperContent: '',

            // The element, where the loader shall be shown, based upon the property 'loadingWrapperSelector'.
            // If this property is set to null, no loader will be shown.
            loadingWrapper: this.loadingWrapperSelector ? $(this.loadingWrapperSelector) : null
        }
    },

    methods: {
        /**
         * Starts the form submitting process.
         */
        submit: function () {
            if (!this.allowSubmit) {
                this.$parent.$emit('prevent_' + this.callbackName, this);
                return;
            }

            // Let the parent chain know, that the submit will be processed.
            this.$parent.$emit('pre_' + this.callbackName, this);

            // Let the user confirm his submit action, if the confirm was defined in the properties.
            if (this.showConfirm) {
                showConfirm(
                    this.confirmType,
                    this.confirmTitle,
                    this.confirmMessage,
                    () => {
                        this.startLoader();
                        this.sendData();
                    },
                    null,
                    this.confirmAccept,
                    this.confirmCancel
                );
            } else {
                this.startLoader();
                this.sendData();
            }
        },

        /**
         * Show the loader, if a loader shall be shown.
         */
        startLoader: function () {
            if (this.loadingWrapper) {
                this.loadingWrapperContent = this.loadingWrapper.replaceWith(`<loader id="button-loader"></loader>`);
                new Vue({
                    el: '#button-loader'
                });
            }
        },

        /**
         * Sends the data of the form to the server.
         */
        sendData: function () {

            // Check if the form is a real form and call corresponding submit method.
            const form = $(this.$el);
            if (form.prop("tagName") == 'FORM') {
                sendFormData(form, (success, response) => {
                    this.handleResponse(form, success, response);
                });
            } else {
                sendInputs(form, this.submitAction, this.submitMethod, (success, response) => {
                    this.handleResponse(form, success, response);
                });
            }
        },

        /**
         * Handles the response from the server, after the form has been submitted.
         *
         * @param form The form that has been submitted. Does'nt has to be a real form in a form tag!
         * @param success {@code true} if the submit was successful, {@code false} otherwise.
         * @param response The response from the server.
         */
        handleResponse: function (form, success, response) {

            if (this.submitMethod == 'get') {
                updateHrefParamsWithFormInputs(form);
            }

            // Check the success type, show the corresponding alerts and call the corresponding callback methods.
            if (!success) {
                this.showErrorMessage(response);
                this.onError(form, response);
            } else {
                this.handleResponseReplacements(response);
                if (this.showAlert) {
                    showAlert('success', this.alertTitle, this.alertMessage, this.alertDuration, () => {
                        this.redirectUser();
                        this.onSuccess(form, response);
                    });
                } else {
                    this.redirectUser();
                    this.onSuccess(form, response);
                }
            }

            // Stop the loader only if an error occurred, or if it's not explicitly forbidden (if an loader was set).
            if (this.loadingWrapper && (this.stopLoading || !success)) {
                let loader = $('#button-loader');
                if (loader.length) {
                    loader.replaceWith(this.loadingWrapperContent);
                }
            }

            // Call the callback to handle the after submit action directly on the page.
            // The callback has 4 parameters (+ the callback name):
            // - callbackName: The name of the event to listen to for the callback.
            // - success: {@code true} if the request was successful handled on the server, {@code false} otherwise.
            // - response: The response message retrieved from the server.
            // - method: The method that was used to proceed the request.
            // - component: The current instance of this component (useful to extract the form with 'component.$el'
            setTimeout(() => {
                // noinspection JSUnresolvedFunction
                this.$parent.$emit(this.callbackName, success, response, this.submitMethod, this);
            }, (this.alertError && !success) || this.showAlert ? this.alertDuration : 0);
        },

        /**
         * Redirects the user to the redirect path, if the 'redirect' property is set.
         */
        redirectUser: function () {
            if (this.redirect) {
                window.location.href = this.redirect;
            }
        },

        /**
         * Append, prepend or replace the response
         */
        handleResponseReplacements: function (response) {
            if (this.appendResponse) {
                appendData(this.appendResponse, response);
            }
            if (this.prependResponse) {
                prependData(this.prependResponse, response);
            }
            if (this.replaceResponse) {
                replaceData(this.replaceResponse, response);
            }
        },

        /**
         * Shows an error message to the user, after the form has been submitted and an error occurred on the server.
         *
         * @param response The error response of the server.
         */
        showErrorMessage: function (response) {
            // Check if an error message shall be shown to the user.
            if (this.showAlert && this.alertError) {
                var msg = null;

                // Extract the error message from the response
                if(response && response.hasOwnProperty('msg')) {
                    msg = response['msg'];
                } else if (response) {
                    for (var key in response) {
                        if(response.hasOwnProperty(key)) {
                            msg = response[key];
                            break;
                        }
                    }
                }

                if (!msg) {
                    msg = this.$t('alert.error.' + this.submitMethod + '.content', {name: this.objectName})
                }

                showAlert('error', this.$t('alert.error.' + this.submitMethod + '.title', {name: this.objectName}), msg, this.alertDuration);
            }
        },

        /**
         * Gets the localization string for an alert type and a type and falls back to the default if necessary.
         *
         * @param alertType 'alert' or 'confirm'
         * @param type 'title', 'content', 'cancel' or 'accept'
         * @param params localization params
         * @returns {string}
         */
        getLocalizationString: function (alertType, type, params = null) {
            let key = alertType + '.' + this.alertKey + '.' + this.submitMethod + '.' + type;
            let defaultKey = alertType + '.default.' + this.submitMethod + '.' + type;
            let text = this.$t(key, params);
            if (key == text) {
                text = this.$t(defaultKey, params);
            }

            return text;
        },

        /**
         * Will be called if the form was successfully submitted.
         *
         * @param form The form that has been submitted. Does'nt has to be a real form in a form tag!
         * @param response The response from the server.
         */
        onSuccess: function (form, response) {},

        /**
         * Will be called if an error occurred on the form submit.
         *
         * @param form The form that has been submitted. Does'nt has to be a real form in a form tag!
         * @param response The response from the server.
         */
        onError: function (form, response) {},
    }
};

