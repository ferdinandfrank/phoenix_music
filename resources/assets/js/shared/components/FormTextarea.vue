<template>
    <div class="form-group" ref="inputWrapper" :class="{ 'has-error': isInvalid, 'has-success': isValid }">
        <textarea :id="name + '-input'"
                  :name="name"
                  v-model="submitValue"
                  class="form-control"
                  :disabled="disabled"
                  :placeholder="showPlaceholder ? placeholder : ''"
                  ref="input"
                  @focus="activate"
                  @blur="deactivate"
                  @input="onInput"></textarea>
        <label :for="name + '-input'" v-if="showLabel" ref="inputLabel" :data-message="labelMessage">{{ label }}</label>
        <span class="counter" :class="submitValue.length > maxLength ? 'error' : 'success'" v-if="maxLength">
            {{ submitValue.length + '/' + maxLength }}
        </span>
    </div>
</template>

<script>
    import formInputMixin from './FormInputMixin';
    export default{
        mixins: [formInputMixin]
    }

</script>
