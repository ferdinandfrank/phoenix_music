module.exports = {

    props: {
        // The selector of the element to remove.
        remove: {
            type: String
        }
    },

    data() {
        return {
            removeSelector: this.remove,
        }
    },

    methods: {
        removeElement: function () {
            if (this.removeSelector) {
                let removeElement = $(this.removeSelector);
                if (!removeElement.length) {
                    removeElement = $(this.$el);
                }

                let parent = removeElement.parent();
                if (parent.hasClass('col')) {
                    removeElement = parent;
                }
                removeElement.hide('slow', function () {
                    removeElement.remove();
                });
            }
        }
    }
};

