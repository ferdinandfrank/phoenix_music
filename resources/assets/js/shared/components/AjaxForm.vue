<!--
    Creates a form and submits its inputs via ajax.
-->
<template>
    <form :action="submitAction" :method="submitMethod" @submit.prevent="submit">
        <slot></slot>
        <div v-if="buttons" :class="buttonWrapperClass">
            <form-button
                    v-if="submitMethod == 'put'"
                    :action="submitDeleteAction"
                    method="delete"
                    :alert-key="alertKey"
                    :object-name="objectName"
                    :remove="remove">
                <i class="material-icons">delete</i>
                <span>{{ labels.delete }}</span>
            </form-button>

            <remove-button v-if="submitMethod == 'post' && remove" class="right" :remove="remove">
                <i class="fa fa-remove"></i>
                <span>{{ labels.remove }}</span>
            </remove-button>

            <button v-if="showSubmit" type="submit" class="btn btn-success">
                <i class="fa fa-check"></i>
                <span>{{ labels.save }}</span>
            </button>
        </div>
    </form>
</template>

<script>
    import extendedAjaxFormMixin from './ExtendedAjaxFormMixin';

    export default {
        mixins: [extendedAjaxFormMixin],
        props: {
            // Classes of the wrapper, where the buttons will be placed.
            buttonWrapperClass: {
                type: String,
                default: 'btn-group'
            },
        }
    }

</script>
