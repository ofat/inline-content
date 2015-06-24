<?php
    $id = uniqid();
?>
<div class="editable-block" id="{{ $id }}" data-id="{{ $model->id }}" data-language="{{ $translation->language }}" contenteditable="true">
    {{ $translation->content }}
</div>

<script src="//cdn.ckeditor.com/4.4.6/full/ckeditor.js"></script>
{{ Html::script('packages/ofat/inline-content/js/frontend.js') }}
{{ Html::style('packages/ofat/inline-content/css/frontend.css') }}

<script>
!function(){
    (new InlineContent())
            .setElement('{{ $id }}')
            .setUrl('{{ route('content.admin.inline-save') }}')
            .init();
}();
</script>