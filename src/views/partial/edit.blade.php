<?php
    $id = uniqid();
?>
<div class="editable-block" id="{{ $id }}" data-id="{{ $model->entity_id }}" data-language="{{ $model->language }}" contenteditable="true">
    {{ $model->content }}
</div>

<script src="//cdn.ckeditor.com/4.4.6/full/ckeditor.js"></script>
{{ Html::script('packages/ofat/inline-content/js/frontend.js') }}
{{ Html::style('packages/ofat/inline-content/css/frontend.css') }}

<script>
!function($){
    var $elem = $('#{{ $id }}');
    CKEDITOR.disableAutoInline = true;
    CKEDITOR.inline( '{{ $id }}',{
        on: {
            blur: function( event ) {
                var data = event.editor.getData();

                jQuery.ajax({
                    url: '{{ route('content.admin.inline-save') }}',
                    type: "POST",
                    data: {
                        content: data,
                        id: $elem.data('id'),
                        language: $elem.data('language')
                    }
                });

            }
        }
    });
}(jQuery);
</script>