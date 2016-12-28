<template>
    <div class="checkbox-wrapper" ref="inputWrapper" :class="color ? 'checkbox-' + color : ''">
        <input :id="name + '-input'"
               type="checkbox"
               ref="input"
               :name="name"
               v-model="submitValue"/>
        <label :for="name + '-input'">{{ label }}</label>
    </div>
</template>

<script>
    import checkboxInputMixin from './CheckboxInputMixin';
    export default{
        mixins: [checkboxInputMixin],
    }

</script>
