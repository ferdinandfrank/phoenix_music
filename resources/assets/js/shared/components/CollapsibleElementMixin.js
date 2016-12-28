module.exports = {

    props: {
        // States if the element shall be shown collapsed.
        collapsed: {
            type: Boolean,
            default: false,
        },

        // The selector of the element to collapse
        collapse: {
            type: String
        },

        collapseShowDirection: {
            type: String,
            default: "up"
        },

        collapseHideDirection: {
            type: String,
            default: "up"
        },
    },

    data() {
        return {
            isCollapsed: this.collapsed,
        }
    },

    computed: {
        // The element to collapse
        collapseElement: function () {
            let collapseElement = $(this.collapse);
            if (!collapseElement.length) {
                collapseElement = $(this.$el);
            }
            return collapseElement;
        }
    },

    methods: {
        toggleCollapsible: function () {
            if (this.isCollapsed) {
                this.collapseElement.show("slide", {direction: this.collapseShowDirection}, 'slow', () => {
                    this.isCollapsed = false;
                });
            } else {
                this.collapseElement.hide("slide", {direction: this.collapseHideDirection}, 'slow', () => {
                    this.isCollapsed = true;
                });
            }

        }
    }
};

