<template>
    <section class="panel"
             :class="[{ 'collapsed': isCollapsed }, border ? 'panel-' + border : '', color ? 'panel-' + color : '']">
        <header v-if="showHeader" class="heading" :class="headerBg ? 'bg-' + headerBg : ''">
            <div v-if="actions" class="actions">
                <i class="action-toggle" @click="toggleCollapsible"></i>
                <i class="action-dismiss" @click="removeElement"></i>
            </div>
            <div v-if="cover" class="cover" :style="{'background-image': 'url(' + cover + ')'}"></div>
            <div v-if="avatar" class="avatar center" :style="{'background-image': 'url(' + avatar + ')'}"></div>
            <h2 v-if="title" class="title">{{ title }}</h2>
            <p v-if="subtitle" class="subtitle">{{ subtitle }}</p>
        </header>
        <div class="content">
            <slot></slot>
        </div>
        <footer v-if="showFooter" class="buttons">
            <slot name="footer"></slot>
        </footer>
    </section>
</template>

<script>
    import removeElementMixin from './../../../vendor/vue-forms/js/mixins/RemoveElementMixin';
    import collapseElementMixin from './CollapsibleElementMixin';

    export default{

        mixins: [removeElementMixin, collapseElementMixin],
        props: {

            // The title to show on the panel's header.
            // If no title, cover or no avatar is set, no header will be shown.
            title: {
                type: String
            },

            // The subtitle to show on the panel's header.
            subtitle: {
                type: String
            },

            // The link of the avatar to show on the panel's header.
            // If no title, cover or no avatar is set, no header will be shown.
            avatar: {
                type: String
            },

            // The link of the cover to show on the panel's header.
            // If no title, cover or no avatar is set, no header will be shown.
            cover: {
                type: String
            },

            // States, if action buttons (remove, collapse) shall be shown on the header.
            actions: {
                type: Boolean,
                default: false,
            },

            // The color of the header's background.
            headerBg: {
                type: String
            },

            // The color scheme of the panel.
            color: {
                type: String
            },

            // The direction to show a border on the panel.
            border: {
                type: String
            },
        },

        data() {
            return {
                showHeader: this.title || this.avatar || this.cover
            }
        },

        mounted() {
            this.$nextTick(function () {
                this.removeSelector = this.$el;
            })
        },

        computed: {
            showFooter: function () {
                return this.$slots.footer;
            },

            // The element to collapse
            collapseElement: function () {
                return $(this.$el).find('.content, .buttons');
            }
        },
    }

</script>
