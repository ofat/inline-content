/**
 * Created by ofat on 27.01.15.
 */

!function($){
    var InlineContent = function() {
        var saveUrl, $elem, elemId;

        return {
            setElement: function(elem) {
                $elem = $('#'+elem);
                elemId = elem;
                return this;
            },
            setUrl: function(url) {
                saveUrl = url;
                return this;
            },
            init: function() {
                CKEDITOR.disableAutoInline = true;
                CKEDITOR.inline( elemId, {
                    on: {
                        blur: function (event) {
                            var data = event.editor.getData();

                            $.ajax({
                                url: saveUrl,
                                type: "POST",
                                data: {
                                    content: data,
                                    id: $elem.data('id'),
                                    language: $elem.data('language')
                                }
                            });
                        },
                        instanceReady: function (ev) {
                            var editor = ev.editor;
                            editor.setReadOnly(false);
                        }
                    }
                });
            }
        }
    };
    window.InlineContent = InlineContent;
}(jQuery);