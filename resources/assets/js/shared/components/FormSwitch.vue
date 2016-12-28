<template>
    <div class="form-group" ref="inputWrapper" :class="{ 'has-error': isInvalid, 'has-success': isValid }">
        <div class="switch" :class="[color ? 'switch-' + color : '', size ? 'switch-' + size : '' ]"
             @click="toggleValue">
            <div class="ios-switch" :class="submitValue ? 'on' : 'off'">
                <div class="on-background background-fill"></div>
                <div class="state-background background-fill"></div>
                <div class="handle"></div>
            </div>
            <input :id="name + '-input'"
                   type="checkbox"
                   :name="name"
                   ref="input"
                   style="display: none;"
                   v-model="submitValue"/>
        </div>
        <label :for="name + '-input'" v-if="showLabel" ref="inputLabel" :data-message="labelMessage">{{ label }}</label>
    </div>
</template>

<script>
    import checkboxInputMixin from './CheckboxInputMixin';
    export default{
        mixins: [checkboxInputMixin],
        props: {

            // The size of the switch
            size: {
                type: String,
                default: 'sm'
            },

            // The color of the switch
            color: {
                type: String,
                default: 'primary'
            },
        }
    }


</script>
