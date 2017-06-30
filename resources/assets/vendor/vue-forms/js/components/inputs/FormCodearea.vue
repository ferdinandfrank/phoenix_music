<template>
    <div class="form-group" ref="inputWrapper"
         :class="{ 'has-error': invalid && !valid, 'has-success': valid && submitValue }">
        <textarea :id="name + '-input'" :name="name" :style="{display: 'none'}" v-model="submitValue"
                  ref="input"></textarea>

        <iframe ref="editor" scrolling="no" :name="name + '-frame'" class="codearea"></iframe>

        <label :for="name + '-input'" v-if="showLabel" ref="inputLabel" :data-message="labelMessage">
            <span>{{ label }}</span>
            <span v-if="showHelp" class="tooltip">
                <i @click="openHelp" class="fa fa-fw fa-question help"></i>
                <span v-if="helpTooltip" class="tooltip-text">{{ helpTooltip }}</span>
            </span>
        </label>

        <div ref="toolbox" class="codearea-toolbox" :style="{display: active ? 'block' : 'none'}">
            <div class="codearea-toolbox-header">
                <div class="codearea-mover"></div>
                <div class="codearea-mover"></div>
                <div class="codearea-mover"></div>
            </div>
            <div class="codearea-tools">
                <div class="codearea-tools-group">
                    <div class="codearea-tools-group-title">
                        {{ $t('labels.font_size') }}
                    </div>
                    <div class="codearea-tools-group-buttons">
                        <div class="codearea-tool-button"
                             :class="{'disabled': isActiveTool(['media', 'list']), 'active': isActiveTool('p')}"
                             @click="wrapTag('p', $event)">
                            <icon icon="fa fa-font"></icon>
                        </div>
                        <div class="codearea-tool-button small"
                             :class="{'disabled': isActiveTool(['media', 'list']), 'active': isActiveTool('h5')}"
                             @click="wrapTag('h5', $event)">
                            <icon icon="fa fa-font"></icon>
                        </div>
                        <div class="codearea-tool-button x-small"
                             :class="{'disabled': isActiveTool(['media', 'list']), 'active': isActiveTool('h6')}"
                             @click="wrapTag('h6', $event)">
                            <icon icon="fa fa-font"></icon>
                        </div>
                    </div>
                </div>

                <div class="codearea-tools-group">
                    <div class="codearea-tools-group-title">
                        {{ $t('labels.headings') }}
                    </div>
                    <div class="codearea-tools-group-buttons">
                        <div class="codearea-tool-button large"
                             :class="{'disabled': isActiveTool(['media', 'list']), 'active': isActiveTool('h1')}"
                             @click="wrapTag('h1', $event)">
                            <icon icon="fa fa-header"></icon>
                        </div>
                        <div class="codearea-tool-button"
                             :class="{'disabled': isActiveTool(['media', 'list']), 'active': isActiveTool('h2')}"
                             @click="wrapTag('h2', $event)">
                            <icon icon="fa fa-header"></icon>
                        </div>
                        <div class="codearea-tool-button small"
                             :class="{'disabled': isActiveTool(['media', 'list']), 'active': isActiveTool('h3')}"
                             @click="wrapTag('h3', $event)">
                            <icon icon="fa fa-header"></icon>
                        </div>
                    </div>
                </div>

                <div class="codearea-tools-group">
                    <div class="codearea-tools-group-title">
                        {{ $t('labels.lists') }}
                    </div>
                    <div class="codearea-tools-group-buttons">
                        <div class="codearea-tool-button"
                             :class="{'disabled': textSelected || isActiveTool('media'),
                             'active': isActiveTool('ul')}"
                             @click="addUnorderedList($event)">
                            <icon icon="fa fa-list-ul"></icon>
                        </div>
                        <div class="codearea-tool-button"
                             :class="{'disabled': textSelected || isActiveTool('media'),
                             'active': isActiveTool('ol')}"
                             @click="addOrderedList($event)">
                            <icon icon="fa fa-list-ol"></icon>
                        </div>
                        <div class="codearea-tool-button"
                             :class="{'disabled': textSelected || isActiveTool('media'),
                             'active': isActiveTool('table')}"
                             @click="addTable($event)">
                            <icon icon="fa fa-table"></icon>
                        </div>
                    </div>
                </div>

                <div class="codearea-tools-group">
                    <div class="codearea-tools-group-title">
                        {{ $t('labels.font_transformation') }}
                    </div>
                    <div class="codearea-tools-group-buttons">
                        <div class="codearea-tool-button"
                             :class="{'disabled': isActiveTool('media'),
                             'active': isActiveTool(['b', 'strong'])}"
                             @click="markAs('bold', $event)">
                            <icon icon="fa fa-bold"></icon>
                        </div>
                        <div class="codearea-tool-button"
                             :class="{'disabled': isActiveTool('media'),
                             'active': isActiveTool(['i','em'])}"
                             @click="markAs('italic', $event)">
                            <icon icon="fa fa-italic"></icon>
                        </div>
                        <div class="codearea-tool-button"
                             :class="{'disabled': isActiveTool('media'),
                             'active': isActiveTool('u')}"
                             @click="markAs('underline', $event)">
                            <icon icon="fa fa-underline"></icon>
                        </div>
                    </div>
                </div>

                <div class="codearea-tools-group">
                    <div class="codearea-tools-group-title">
                        {{ $t('labels.font_color') }}
                    </div>
                    <div class="codearea-tools-group-buttons">
                        <div class="codearea-tool-button" :style="{color: defaultColor}"
                             :class="{'disabled': isActiveTool('media'),
                             'active': isDefaultColorActive}"
                             @click="changeColor(defaultColor, $event)">
                            <icon icon="fa fa-paint-brush"></icon>
                        </div>
                        <div v-for="color in colors" class="codearea-tool-button" :style="{color: color}"
                             :class="{'disabled': isActiveTool('media'),
                             'active': isActiveTool(color)}"
                             @click="changeColor(color, $event)">
                            <icon icon="fa fa-paint-brush"></icon>
                        </div>
                    </div>
                </div>

                <div class="codearea-tools-group">
                    <div class="codearea-tools-group-title">
                        {{ $t('labels.insert_options') }}
                    </div>
                    <div class="codearea-tools-group-buttons">
                        <div class="codearea-tool-button"
                             :class="{'disabled': !textSelected}"
                             @click="addLink($event)">
                            <icon icon="fa fa-link"></icon>
                        </div>
                        <div class="codearea-tool-button"
                             :class="{'disabled': textSelected || isActiveTool('media'),
                             'active': isActiveTool('img') || isActiveTool('video')}"
                             @click="selectMedia($event)">
                            <icon icon="fa fa-camera"></icon>
                        </div>
                        <div class="codearea-tool-button"
                             :class="{'disabled': textSelected || isActiveTool('media'), 'active': isActiveTool('iframe')}"
                             @click="addYouTubeVideo($event)">
                            <icon icon="fa fa-youtube"></icon>
                        </div>
                        <div class="codearea-tool-button"
                             :class="{'disabled': textSelected}"
                             @click="markAs('insertHTML', $event, '<p><hr></p><p></p>')">
                            <icon icon="fa fa-minus-square-o"></icon>
                        </div>
                        <div class="codearea-tool-button"
                             :class="{'disabled': textSelected}"
                             @click="addCode($event)">
                            <icon icon="fa fa-code"></icon>
                        </div>
                    </div>
                </div>


                <div class="codearea-tools-group">
                    <div class="codearea-tools-group-title">
                        {{ $t('labels.alignment') }}
                    </div>
                    <div class="codearea-tools-group-buttons">
                        <div class="codearea-tool-button"
                             :class="{'active': !isActiveTool(['center','right'])}"
                             @click="markAs('justifyLeft', $event)">
                            <icon icon="fa fa-align-left"></icon>
                        </div>
                        <div class="codearea-tool-button"
                             :class="{'active': isActiveTool('center')}"
                             @click="markAs('justifyCenter', $event)">
                            <icon icon="fa fa-align-center"></icon>
                        </div>
                        <div class="codearea-tool-button"
                             :class="{'active': isActiveTool('right')}"
                             @click="markAs('justifyRight', $event)">
                            <icon icon="fa fa-align-right"></icon>
                        </div>
                    </div>
                </div>

                <div class="codearea-tools-group">
                    <div class="codearea-tools-group-title">
                        {{ $t('labels.actions') }}
                    </div>
                    <div class="codearea-tools-group-buttons">
                        <div class="codearea-tool-button"
                             :class="{'disabled': isActiveTool('media', 'list')}"
                             @click="markAs('indent', $event)">
                            <icon icon="fa fa-indent"></icon>
                        </div>
                        <div class="codearea-tool-button"
                             :class="{'disabled': isActiveTool('media', 'list')}"
                             @click="markAs('outdent', $event)">
                            <icon icon="fa fa-outdent"></icon>
                        </div>
                        <div class="codearea-tool-button"
                             @click="markAs('undo', $event)">
                            <icon icon="fa fa-undo"></icon>
                        </div>
                        <div class="codearea-tool-button"
                             @click="markAs('redo', $event)">
                            <icon icon="fa fa-repeat"></icon>
                        </div>
                        <div class="codearea-tool-button"
                             @click="markAs('delete', $event)">
                            <icon icon="fa fa-trash"></icon>
                        </div>
                    </div>
                </div>

            </div>
            <div class="codearea-toolbox-footer">
                <p>{{ wordLabel }}: {{ wordCount }}</p>
                <p>{{ charLabel }}: {{ charCount }}</p>
            </div>
        </div>
        <media-modal v-if="showMediaManager" v-on:close="showMediaManager = false">
            <media-manager :is-modal="true" :selected-event-name="name + '-media'"
                           v-on:close="showMediaManager = false"></media-manager>
        </media-modal>
    </div>
</template>

<script>
    import formInputMixin from '../../mixins/FormInputMixin';
    import Alert from "../../helpers/Alert";
    export default{
        mixins: [formInputMixin],

        props: {

            // The link to the css file to include within the editable iFrame.
            stylesheets: {
                type: Array,
            },

        },

        data: function () {
            return {

                // The iFrame instance
                editor: null,

                // The editable iFrame body instance
                body: null,

                // The editable iFrame head instance
                head: null,

                // The toolbox instance
                toolbox: null,

                // States if a text is currently selected
                textSelected: false,

                currentTools: [],

                wordLabel: '',

                charLabel: '',

                wordCount: 0,

                charCount: 0,

                defaultColor: '#555',

                // The supported text colors next to the default color
                colors: ['#008200', '#f0820a', '#d2322d', '#808697', '#4267b2'],

                // States if the media manager to select an image or video is currently shown
                showMediaManager: false,
            }
        },

        computed: {
            isDefaultColorActive: function () {
                return !this.colors.some(c => this.currentTools.includes(c)) && !this.currentTools.includes('media');
            },
        },

        mounted() {
            this.$nextTick(function () {
                this.editor = this.$refs.editor;
                this.toolbox = this.$refs.toolbox;
                let editorContent = this.editor.contentDocument || this.editor.contentWindow.document;
                this.body = $(editorContent).find('body');
                this.head = $(editorContent).find("head");

                this.wordLabel = this.$t('labels.words');
                this.charLabel = this.$t('labels.chars');

                this.editor.contentDocument.designMode = 'On';

                // Add the specified stylesheets to the iframe
                if (this.stylesheets) {
                    this.stylesheets.forEach((stylesheet) => {
                        this.head.append($("<link/>", {rel: "stylesheet", href: stylesheet, type: "text/css"}));
                    });
                }

                // Add js scripts to the iframe
                this.head.append($("<link/>", {rel: "stylesheet", href: "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css", type: "text/css"}));
                this.head.append($("<script/>", {src: "//code.jquery.com/ui/1.12.1/jquery-ui.js"}));

                // Init the iFrame body
                this.body.addClass('codearea-body');
                this.body.bind('DOMSubtreeModified', () => {
                    this.submitValue = this.body.html();
                    this.updateMetaInfo();
                    this.adjustEditorHeight();
                });

                // Initialize the toolbox
                $(this.toolbox).draggable({
                    start: function () {
                        $(this).addClass('dragged');
                    },
                    stop: function () {
                        $(this).removeClass('dragged');
                    }
                });

                // Init edit content listeners
                this.body.on('click', () => {
                    this.editContent();
                });

                $(window).click((event) => {
                    if (!$(event.target).closest(this.$el).length) {
                        this.stopEditContent();
                    }
                });

                this.body.bind("keydown click focus", () => {
                    this.updateToolSelection();
                });

                // Prevent false styling on text paste
                this.body.on("paste", (event) => {
                    event.preventDefault();

                    // Get text representation of clipboard
                    let text = (event.originalEvent || event).clipboardData.getData('text/plain');

                    // Insert text manually
                    this.markAs("insertHTML", event, text);
                });

                this.initMediaManager();
                this.body.html(this.value);
            });
        },

        methods: {

            // Allows to edit the content
            editContent: function () {
                this.active = true;
            },

            stopEditContent: function () {
                this.active = false;
                this.body.children().removeClass('active');
            },

            markAs: function (property, event, value = null) {
                if (this.buttonEnabled(event)) {
                    this.editor.contentDocument.execCommand(property, false, value);
                    this.body.focus();
                    this.updateToolSelection();
                }
            },

            addUnorderedList: function (event) {
                this.markAs('insertHTML', event, '<ul class="default"><li></li></ul>');
            },

            addOrderedList: function (event) {
                this.markAs('insertOrderedList', event, 'newOl');
            },

            addTable: function (event) {
                if (this.buttonEnabled(event)) {
                    new Alert(null, this.$t('prompt.add_table.title'), this.$t('prompt.add_table.content')).ask((columns) => {
                        columns = isNaN(columns) || columns === '' ? 2 : parseInt(columns);
                        let headCols = '';
                        let bodyCols = '';
                        for (let col = 0; col < columns; col++) {
                            headCols += '<th></th>';
                            bodyCols += '<td></td>';
                        }

                        let tableHtml = '<table><thead><tr>' + headCols + '</tr></thead><tbody><tr>' + bodyCols + '</tr></tbody></table><p></p>';

                        this.markAs('insertHTML', event, tableHtml);
                    }, this.$t('prompt.add_table.confirm'), this.$t('prompt.add_table.cancel'), this.$t('prompt.add_table.placeholder'));
                }
            },

            wrapTag: function (tag, event) {
                this.markAs('formatBlock', event, tag.toUpperCase());
            },

            changeColor: function (color, event) {

                // Change to default color, if current colors is already active
                this.markAs('foreColor', event, this.currentTools.includes(color) ? this.defaultColor : color);
            },

            addLink: function (event) {
                if (this.buttonEnabled(event)) {
                    new Alert(null, this.$t('prompt.add_link.title'), this.$t('prompt.add_link.content')).ask((link) => {
                        this.markAs('createLink', event, link);
                    }, this.$t('prompt.add_link.confirm'), this.$t('prompt.add_link.cancel'), this.$t('prompt.add_link.placeholder'));
                }
            },

            addCode: function (event) {
                if (this.buttonEnabled(event)) {
                    new Alert(null, this.$t('prompt.add_code.title'), this.$t('prompt.add_code.content')).ask((link) => {
                        this.markAs('insertHTML', event, '<p>' + link + '</p>');
                    }, this.$t('prompt.add_code.confirm'), this.$t('prompt.add_code.cancel'), this.$t('prompt.add_code.placeholder'));
                }
            },

            addYouTubeVideo: function (event) {
                if (this.buttonEnabled(event)) {
                    new Alert(null, this.$t('prompt.add_youtube.title'), this.$t('prompt.add_youtube.content')).ask((link) => {
                        link = link.replace("watch?v=", "embed/"); // Necessary for authentication
                        this.addMedia('<iframe class="img-full-responsive" src="' + link + '" frameborder="0" allowfullscreen></iframe>', event, "560px", "315px");
                    }, this.$t('prompt.add_youtube.confirm'), this.$t('prompt.add_youtube.cancel'), this.$t('prompt.add_youtube.placeholder'));
                }
            },

            selectMedia: function (event) {
                if (this.buttonEnabled(event)) {
                    this.showMediaManager = true;
                }
            },

            addMedia: function (mediaNode, event, width="50%", height="50%") {
                if (this.buttonEnabled(event)) {
                    this.markAs('insertHTML', event, '<div class="codearea-media-wrapper"><div class="codearea-media" style="width: ' + width + '; height: ' + height + '">' + mediaNode + '</div></div><p></p>');
                    this.body.find('.codearea-media').resizable({
                        resize: () => {
                            this.adjustEditorHeight();
                        }
                    });
                    this.adjustEditorHeight();
                }
            },

            initMediaManager: function () {
                window.eventHub.$on('media-manager-selected-' + this.name + '-media', (file) => {
                    let source = file.webPath;
                    let fileType = source.split('.').pop();

                    if (fileType === 'png' || fileType === 'jpg' || fileType === 'jpeg' || fileType === 'gif') {
                        this.addMedia('<img class="img-full-responsive" src="' + source + '" />');
                    } else {
                        this.addMedia('<video controls="controls" class="img-full-responsive"><source src="' + source + '" type="video/' + fileType + '">Dein Browser kann keine Videos anzeigen.</video>');
                    }

                    this.showMediaManager = false;
                });

                window.eventHub.$on('media-manager-notification', function (message, type, time) {
                    showAlert(type, null, message, time);
                });
            },

            updateToolSelection: function () {
                if (!this.submitValue) {
                    this.wrapTag('p');
                }

                let node = this.editor.contentDocument.getSelection().anchorNode;
                let childNode = node;
                node = node.tagName === undefined ? node.parentNode : node;

                // Remove line break tag, which gets automatically inserted on new nodes
                if ($(node).html() === '<br>') {
                    $(node).html('');
                }

                this.currentTools = [];
                while (node) {
                    let tagName = node.tagName;
                    if (!['HTML', undefined, 'BODY'].includes(tagName)) {

                        tagName = tagName.toLowerCase();

                        if (tagName === 'font') {
                            tagName = node.color;
                        }

                        if (tagName === 'ul' || tagName === 'ol' || tagName === 'table') {
                            this.currentTools.push('list');
                        }

                        if ($(node).hasClass('codearea-media')) {
                            let mediaNode = $(node).children().eq(0);
                            if (mediaNode.length) {
                                this.currentTools.push(mediaNode[0].tagName.toLowerCase());
                            }
                            this.currentTools.push('media');
                        }

                        this.currentTools.push(tagName);

                        let nodeTextAlign = $(node).css('text-align');
                        if (nodeTextAlign) {
                            this.currentTools.push(nodeTextAlign);
                        }

                        childNode = node;
                        node = node.parentNode;
                    } else {
                        this.body.children().removeClass('active');
                        $(childNode).addClass('active');

                        // If tag name of last node is div, change to normal paragraph
                        if (childNode.tagName === 'DIV' && !$(childNode).hasClass('codearea-media-wrapper')) {
                            let tagContent = $(childNode).html();
                            $(childNode).replaceWith( "<p>" + tagContent + "</p>" );
                        }

                        node = null;
                    }
                }

                this.textSelected = !this.editor.contentDocument.getSelection().isCollapsed;
            },

            adjustEditorHeight: function () {
                let editorHeight = 100;
                this.body.children().each((index, child) => {
                    editorHeight += child.offsetHeight;
                });
                this.editor.style.height = editorHeight + 'px';
            },

            updateMetaInfo: function () {
                this.charCount = this.body.text().length;
                this.wordCount = this.body.text().split(' ').length;
            },

            buttonEnabled: function (event) {
                return event ? !$(event.target).hasClass('disabled') : true;
            },

            isActiveTool: function (tagNames) {
                if (tagNames instanceof Array) {
                    let active = false;
                    tagNames.forEach((tagName) => {
                        if (this.isActiveTool(tagName)) {
                            active = true;
                        }
                    });
                    return active;
                }
                return this.currentTools.includes(tagNames);
            }
        }
    }

</script>
