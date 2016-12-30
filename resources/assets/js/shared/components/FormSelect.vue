<template>
    <div class="form-group" ref="inputWrapper" :class="{ 'has-error': isInvalid, 'has-success': isValid }">
        <select :id="name + '-input'"
                :name="submitName"
                @focus="activate"
                @blur="deactivate"
                @input="onInput"
                :placeholder="showPlaceholder ? placeholder : ''"
                ref="input"
                :disabled="disabled"
                :multiple="multiple"
                class="form-control">
            <slot></slot>
        </select>
        <label :for="name + '-input'" v-if="showLabel" ref="inputLabel" :data-message="labelMessage">
            <span>{{ label }}</span>
            <i v-if="showHelp" @click="openHelp" class="fa fa-fw fa-question help"></i>
        </label>
    </div>
</template>

<script>
    import formInputMixin from './FormInputMixin';
    export default{
        mixins: [formInputMixin],
        props: {
            // True, if multiple values can be selected.
            multiple: {
                type: Boolean,
                default: false
            }
        },

        computed: {
            // The name of the input. Will also be the name of the value, when the form gets submitted.
            // Info: This value is based upon the 'name' property.
            submitName: function () {
                if (this.multiple) {
                    return this.name + '[]';
                }
                return this.name;
            }
        },

        mounted() {
            this.$nextTick(function () {
                $(this.$refs.input).select2();

                let selected = $(this.$refs.input).find('option:selected').first();
                if (selected.length) {
                    this.submitValue = selected.val();
                    this.allowSubmit = true;
                }

                $(this.$refs.input).on("change", (event) => {
                    this.submitValue = event.added.id;
                    this.onInput();

                    console.log($(this.$refs.input).val());
                });
            });
        },

        methods: {}
    }
</script>
