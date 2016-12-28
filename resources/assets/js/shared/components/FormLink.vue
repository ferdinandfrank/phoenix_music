<template>
    <a :href="action" @click="submit">
        <form :id="formId" :action="action" :method="method" style="display: none;">
            <input type="hidden" name="_token" :value="token">
        </form>
        <slot></slot>
    </a>
</template>

<script>
    export default{

        props: {
            action: {
                type: String,
                required: true
            },
            method: {
                type: String,
                default: 'post'
            },
            formId: {
                type: String,
                required: true
            }
        },

        computed: {
            token: function () {
                return Laravel.csrfToken;
            }
        },

        methods: {
            submit: function (event) {
                event.preventDefault();
                document.getElementById(this.formId).submit();
            }
        }
    }

</script>
