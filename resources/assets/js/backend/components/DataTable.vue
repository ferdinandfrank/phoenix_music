<template>
    <div class="data-table">
        <form ref="form" method="GET" action="#">
            <div class="row m-b-none">
                <div class="col xs-12 sm-4 md-3 lg-2">
                    <form-select :value="countValue"
                                 name="entries_count">
                        <option>5</option>
                        <option>10</option>
                        <option>15</option>
                        <option>20</option>
                        <option>50</option>
                    </form-select>
                </div>
                <div class="col xs-12 sm-6 md-4 lg-4 sm-offset-2 md-offset-5 lg-offset-6">
                    <form-input :addon-submit="true"
                                type="text"
                                :value="searchValue"
                                name="search"
                                :lang-key="langKey"
                                :show-placeholder="true"
                                :show-label="false"
                                :icon="searchIcon"></form-input>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col xs-12 auto-overflow">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        props: {
            searchValue: {
                type: String,
                default: ""
            },

            searchIcon: {
                type: String,
                default: "fa fa-fw fa-search"
            },

            countValue: {
                type: Number,
                default: 10
            },

            langKey: {
                type: String
            }
        },

        mounted() {
            this.$nextTick(function () {
                window.eventHub.$on('entries_count-input-changed', (value) => {
                    if (value != this.countValue) {
                        this.$refs.form.submit();
                    }
                })
            })
        },
    }
</script>

<style>

</style>
