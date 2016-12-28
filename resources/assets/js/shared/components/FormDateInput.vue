<template>
    <div class="form-group" ref="inputWrapper" :class="{ 'has-error': isInvalid, 'has-success': isValid }">
        <input :id="name + '-input'"
               type="text"
               :name="name"
               class="form-control datetimepicker"
               :placeholder="showPlaceholder ? label : ''"
               :disabled="disabled"
               ref="input"
               @focus="activate"
               @blur="deactivate"
               @input="onInput">
        <label :for="name + '-input'" v-if="showLabel" ref="inputLabel" :data-message="labelMessage">{{ label }}</label>
    </div>
</template>

<script>
    import formInputMixin from './FormInputMixin';
    import datePickerMixin from './DatePickerMixin';
    export default{
        mixins: [formInputMixin, datePickerMixin],
        props: {},

        mounted: function () {
            this.$nextTick(function () {
                $(this.$refs.input).datetimepicker({
                    locale: 'de',
                    format: 'YYYY-MM-DD',
                    defaultDate: this.submitValue
                });
                $(this.$refs.input).on("dp.change", (moment) => {
                    this.submitValue = moment.date.format("YYYY-MM-DD");
                });
            })
        },
    }
</script>
