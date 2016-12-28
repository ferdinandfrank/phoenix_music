<template>
    <a>
        <transition enter-active-class="animated fadeInRight" leave-active-class="animated fadeOutRight">
            <input v-show="showInput" @input="onInput" v-model="searchQuery" type="text" :name="name"
                   :title="labels.placeholder" :placeholder="labels.placeholder">
        </transition>
        <i class="material-icons" @click="toggleInput">search</i>
    </a>
</template>

<script>
    import dropdownMixin from './DropdownMixin';
    export default {
        mixins: [dropdownMixin],

        props: {
            name: {
                type: String,
                default: 'search_query'
            },
            placeholder: {
                type: String
            },

            // Where to send the search input to get the results.
            // See property 'submitAction'.
            action: {
                type: String,
                required: true
            },

            // True, if the search input shall be always visible. Otherwise the user has to click on the search button to make the input visible.
            // See property 'showInput'.
            enableInput: {
                type: Boolean,
                default: false
            }
        },

        data() {
            return {
                // The url, where to send the search input to get the results.
                submitAction: this.action,

                // True, if the search input is visible.
                showInput: this.enableInput,

                labels: {
                    'placeholder': this.placeholder ? this.placeholder : this.$t('action.search'),
                },

                // The value to search.
                searchQuery: '',
            }
        },

        methods: {
            toggleInput: function () {
                if (this.showInput) {
                    this.showInput = false;
                    this.hideDropdownContent();
                } else {
                    this.showInput = true;
                }
            },
            onInput: function () {
                if (!this.searchQuery) {
                    this.hideDropdownContent();
                    return;
                }

                this.activateDropdown();

                sendRequest(this.action, 'get', serializeForm($(this.$el)), ( data ) => {
                    this.dropdownContent.html(data);
                    loadPerfectScrollbar(this.dropdownContent);
                });
            }
        }
    }


</script>
