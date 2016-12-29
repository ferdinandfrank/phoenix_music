<template>
    <div class="form-group" ref="inputWrapper" :class="{ 'has-error': isInvalid, 'has-success': isValid }">
        <input :id="name + '-input'"
               type="text"
               :name="name"
               v-model="submitValue"
               class="form-control"
               :class="icon ? 'has-addon' : ''"
               :placeholder="showPlaceholder ? placeholder : ''"
               :step="step"
               :disabled="disabled"
               ref="input"
               @focus="activate"
               @blur="deactivate"
               @input="onInput">

        <button type="submit" v-if="icon && addonSubmit" class="form-group-addon" style="cursor: pointer">
            <icon :icon="icon"></icon>
        </button>
        <span v-if="icon && !addonSubmit" class="form-group-addon">
            <icon :icon="icon"></icon>
        </span>

        <label :for="name + '-input'" v-if="showLabel" ref="inputLabel" :data-message="labelMessage">{{ label }}</label>
        <span class="counter" :class="submitValue.length > maxLength ? 'error' : 'success'" v-if="maxLength">
            {{ submitValue.length + '/' + maxLength }}
        </span>
        <slot></slot>
    </div>
</template>

<script>
    import formInputMixin from './FormInputMixin';
    export default{
        mixins: [formInputMixin],
        props: {
            type: {
                type: String,
                default: 'text'
            },
            icon: {
                type: String
            },
            addonSubmit: {
                type: Boolean
            },
            step: ''
        },

        data() {
            return {

                // The html content to put in the loading wrapper, after the form has been submitted and the loader has stopped.
                loadingWrapperContent: ''
            }
        },

        mounted() {
            this.$nextTick(function () {
                this.input.attr('type', this.type);
            })
        },

        methods: {

            /**
             * Checks if the input's value is valid regarding the property 'type'.
             *
             * @returns {boolean}
             */
            checkComponentSpecific: function () {
                if (this.type == 'email' && !isValidEmail(this.submitValue)) {
                    this.addError(this.getLocalizationString('email', null, true));
                    return false;
                }
                return true;
            }
        }
    }
</script>
