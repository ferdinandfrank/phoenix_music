/**
 *  Ajax Form Mixin for ajax forms, which have inputs and a submit button as part of their content.
 */

import ajaxFormMixin from "./AjaxFormMixin";
import removeElementMixin from "./RemoveElementMixin";

module.exports = {

    mixins: [ajaxFormMixin, removeElementMixin],

    props: {
        // Set to true, if the form's inputs shall be cleared after the submit.
        clear: {
            type: Boolean,
            default: false
        },

        // If the form is used to create a new entity, this property is used to extract the route key of the created entity
        // and append it on the updateAction property, so a full update url for the entity will be created and the future
        // submit can successfully be treated as an update for the entity.
        updateKey: {
            type: String,
            default: 'id'
        },

        // If the form is used to create a new entity, this property is used to update the default submit action of the form
        // after the form was successfully submitted for the first time and the entity has successfully been created.
        // So the future submits will be handled as an update for the entity.
        // Important: Because the key of the entity isn't known before its creation, set the updateKey property to the route key
        // of the entities model, so the key can be extracted from the response and the full update url for the entity can be created.
        // See computed property: 'submitUpdateAction'
        updateAction: {
            type: String
        },

        // If the form is used to create a new entity, this property is used to show a delete button for the entity and to give
        // the user the option to delete the created entity, if the 'submitMethod' is set to 'put' or to remove the creation form,
        // if the 'submitMethod' is set to 'post'.
        // Important: Because the key of the entity isn't known before its creation, set the updateKey property to the route key
        // of the entities model, so the key can be extracted from the response and the full update url for the entity can be created.
        // See computed property: 'submitDeleteAction'
        deleteAction: {
            type: String
        },

        // The label to show on the delete button, if the property 'deleteAction' is set.
        deleteLabel: {
            type: String
        },

        // The label to show on the remove button, if the property 'deleteAction' is set.
        removeLabel: {
            type: String
        },

        // Classes of the wrapper, where the buttons will be placed.
        buttonWrapperClass: {
            type: String,
            default: ''
        },

        // True, if a submit button shall be shown in the button wrapper.
        showSubmit: {
            type: Boolean,
            default: false
        },

        // The label to show on the submit button, if the property 'showSubmit' is set.
        submitLabel: {
            type: String
        },

        // The link to the details page of the created or edited entity to redirect the user after the form was successfully submitted.
        // If this property is not set, no redirect will occur.
        // Important: Because the key of the entity isn't known before its creation, set the updateKey property to the route key
        // of the entities model, so the key can be extracted from the response and the full update url for the entity can be created.
        detailRedirect: {
            type: String
        }
    },

    computed: {
        // The submit button for the form. Used to show the loader as soon as the submit request is pending.
        button: function() {
            return $(this.$el).find('button[type=submit]');
        },

        // The element, where the loader shall be shown, based upon the property 'loadingWrapperSelector'.
        // If this property is set to null, no loader will be shown.
        loadingWrapper: function () {
            if (this.loadingWrapperSelector) {
                return $(this.loadingWrapperSelector);
            }

            return this.button;
        }
    },

    data() {
        return {
            // The url, where to send the form request to update an object.
            submitUpdateAction: this.updateAction,

            // The url, where to send the form request to delete the object.
            submitDeleteAction: this.deleteAction,

            // States, if the form can be submitted.
            allowSubmit: true,

            // States, if buttons shall be inserted in the button wrapper on the end of the form.
            buttons: this.showSubmit || this.deleteAction,

            // The labels for the buttons to show
            labels: {
                'delete': this.deleteLabel ? this.deleteLabel : this.$t('action.delete'),
                'remove': this.deleteLabel ? this.deleteLabel : this.$t('action.remove'),
                'save': this.deleteLabel ? this.deleteLabel : this.$t('action.save'),
            }
        }
    },

    mounted: function () {
        this.$nextTick(function () {
            if (this.submitUpdateAction && this.submitMethod == 'put') {
                this.submitAction = this.submitUpdateAction;
                this.submitUpdateAction = null;
            }

            // Disable the submit permission, to let the user make at least one input
            this.updateFormSubmitPermission();
        })
    },

    watch: {
        /**
         * Watch the submit permission of the form, to enable or disable the submit button.
         *
         * @param allowSubmit {@code true} if a submit is allowed, {@code false} otherwise.
         */
        allowSubmit: function (allowSubmit) {
            this.$parent.$emit('allowSubmit_' + this.callbackName, allowSubmit);
            this.button.prop('disabled', !allowSubmit);
        }
    },

    methods: {
        /**
         * Will be called if the form was successfully submitted.
         *
         * @param form The form that has been submitted. Does'nt has to be a real form in a form tag!
         * @param response The response from the server.
         */
        onSuccess: function (form, response) {

            // Get the created key for the entity
            let objectKey = null;
            if (this.updateKey) {
                objectKey = response[this.updateKey];
            }

            let redirectURL = this.detailRedirect;
            if (redirectURL && objectKey) {
                if (!redirectURL.endsWith(objectKey)) {
                    if (!redirectURL.endsWith('/')) {
                        redirectURL += '/';
                    }
                    redirectURL += objectKey;
                }
                window.location.href = redirectURL;
            }

            // Set the "update-action" property as the the next action and update the method
            if (this.submitUpdateAction && objectKey) {

                // Update the update and delete action with the created objects key
                if (!this.submitUpdateAction.endsWith(objectKey)) {
                    if (!this.submitUpdateAction.endsWith('/')) {
                        this.submitUpdateAction += '/';
                    }
                    this.submitUpdateAction += objectKey;
                }
                if (this.submitDeleteAction && !this.submitDeleteAction.endsWith(objectKey)) {
                    if (!this.submitDeleteAction.endsWith('/')) {
                        this.submitDeleteAction += '/';
                    }
                    this.submitDeleteAction += objectKey;
                }

                this.submitAction = this.submitUpdateAction;
                this.submitUpdateAction = null;

                if (this.submitMethod == 'post') {
                    this.submitMethod = 'put';
                }
            }


            // Clear the form inputs
            if (this.clear) {
                this.clearInputs();
            } else {
                this.clearInputsInfo();
            }

            // Extra on success actions
            this.updateFormSubmitPermission();

            // Check needed, otherwise form gets removed on submit
            if (!this.deleteAction && this.remove) {
                this.removeElement();
            }
        },

        /**
         * Will be called if an error occurred on the form submit.
         *
         * @param form The form that has been submitted. Does'nt has to be a real form in a form tag!
         * @param response The response from the server.
         */
        onError: function (form, response) {
            $.each(response, (key, value) => {
                let inputComponent = this.getChildInputComponentByName(key);
                if (inputComponent) {
                    this.addErrorToInputComponent(inputComponent, value[0]);
                }
            });
        },

        /**
         * Adds the specified error message to the input field of the specified input component.
         *
         * @param inputComponent
         * @param errorMsg
         */
        addErrorToInputComponent: function (inputComponent, errorMsg) {
            if (isFunction(inputComponent.addError)) {
                inputComponent.addError(errorMsg);
            }
        },

        /**
         * Updates the state of the submit button and checks if the form can be submitted,
         * depending if the child inputs allow a submit.
         */
        updateFormSubmitPermission: function () {
            var allInputsValid = true;
            let children = this.getListOfChildren(this);
            children.forEach((child) => {
                if (child.hasOwnProperty("allowSubmit") && !child.allowSubmit) {
                    allInputsValid = false;
                }
            });
            this.allowSubmit = allInputsValid;
        },

        getListOfChildren: function (component) {
            var children = [];
            component.$children.forEach((child) => {
                children.push(child);
                children = children.concat(this.getListOfChildren(child));
            });
            return children;
        },

        /**
         * Gets the child input component of the form, that has an input with the specified name, if it exists.
         *
         * @param inputName
         * @returns {*}
         */
        getChildInputComponentByName: function (inputName) {
            let childInputComponent = null;
            this.$children.forEach((child) => {
                let input = $(child.$el).find(':input[name=' + inputName + ']');
                if (input.length) {
                    childInputComponent = child;
                }
            });

            return childInputComponent;
        },

        /**
         * Clears the children input value and the info text (error, success).
         */
        clearInputs: function () {
            this.$children.forEach((child) => {
                if (isFunction(child.clear)) {
                    child.clear();
                }
            });
        },

        /**
         * Clears the children input info text (error, success).
         */
        clearInputsInfo: function () {
            this.$children.forEach(function (child) {
                if (isFunction(child.clearInfo)) {
                    child.clearInfo();
                }
            });
        },

        /**
         * Clears the inputs values and submits the empty form.
         */
        clearSubmit: function () {
            this.clearInputs();

            // Wait for the inputs to be cleared.
            this.$nextTick(function () {
                this.submit();
            })
        }
    }
};

