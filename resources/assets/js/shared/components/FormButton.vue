<template>
    <button type="button" class="btn" :class="[size ? 'btn-' + size : '', color ? 'btn-' + color : '']" @click="submit">
        <slot></slot>
    </button>
</template>

<script>

    import ajaxFormMixin from './AjaxFormMixin';
    import removeElementMixin from './RemoveElementMixin';

    export default {

        mixins: [ajaxFormMixin, removeElementMixin],

        props: {
            color: {
                type: String,
                default: 'error'
            },
            size: {
                type: String
            },
            // The method to use for the submit.
            // See computed property: 'submitMethod'
            method: {
                type: String,
                default: 'DELETE'
            },
        },

        computed: {

            // The element, where the loader shall be shown..
            // If this property is set to null, no loader will be shown.
            loadingWrapper: function () {

                return $(this.$el);
            }

        },

        methods: {

            /**
             * Sends the data of the form to the server.
             */
            sendData: function () {
                $.ajax({
                    url: this.submitAction,
                    method: this.submitMethod,
                    success: (response) => {
                        this.handleResponse($(this.$el), true, response);
                    },
                    error: (jqXHR) => {
                        this.handleResponse($(this.$el), false, jqXHR.responseJSON);
                    }
                });
            },

            /**
             * Will be called if the form was successfully submitted.
             *
             * @param form The form that has been submitted. Does'nt has to be a real form in a form tag!
             * @param response The response from the server.
             */
            onSuccess: function (form, response) {
                this.removeElement();
            }
        }
    }
</script>
#
