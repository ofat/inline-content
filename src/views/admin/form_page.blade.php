@extends($layout)
<?php
    use Ofat\InlineContent\ContentEntity;
?>

@section('title')
    @if($model->exists)
    Edit {{ $type }} # {{ $model->id }}
    @else
    Adding {{ $type }}
    @endif
@stop

@section($contentSection)
{{ Form::open(['method' => 'post']) }}
{{ Form::hidden('type', $model->type) }}
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="form-group">
            <label class="control-label">
                {{ Form::checkbox('is_published', ContentEntity::PUBLISHED, $model->is_published) }}
                Is Published
            </label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <ul class="nav nav-tabs">
            <?php $i = 0; ?>
            @foreach(\I18n::getSupportedLanguages() as $lang_key => $lang_caption)
            <li {{ !$i ? 'class="active"' : '' }}><a href="#entity-lang-{{$lang_key }}" data-toggle="tab">{{ $lang_caption }}</a></li>
            <?php ++$i ?>
            @endforeach
        </ul>
        <div class="tab-content">
            <?php $i = 0; ?>
            @foreach(\I18n::getSupportedLanguages() as $lang_key => $lang_caption)
            <div class="tab-pane entity-lang-block{{ !$i ? ' active' : ''}}" id="entity-lang-{{ $lang_key }}">
                <div class="form-group">
                    {{ Form::label("translations[{$lang_key}][title]", t('Title').':') }}
                    {{ Form::text("translations[{$lang_key}][title]", @$model->getTranslation($lang_key)->title, ['class' => 'form-control title-input']) }}
                </div>
                <div class="form-group">
                    {{ Form::label("translations[{$lang_key}][html_title]", t('HTML Title').':') }}
                    {{ Form::text("translations[{$lang_key}][html_title]", @$model->getTranslation($lang_key)->html_title, ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {{ Form::label("translations[{$lang_key}][url]", t('URL').':') }}
                    {{ Form::text("translations[{$lang_key}][url]", @$model->getTranslation($lang_key)->url, ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {{ Form::label("translations[{$lang_key}][content]", t('Content').':') }}
                    {{ Form::textarea("translations[{$lang_key}][content]", @$model->getTranslation($lang_key)->url, ['class' => 'form-control richtext']) }}
                </div>
            </div>
            <?php ++$i ?>
            @endforeach
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <button type="submit" class="btn btn-block btn-primary">{{ t('Save') }}</button>
    </div>
</div>

{{ \HTML::script('packages/Ofat/content/js/admin.form.js') }}
{{ Form::close() }}
@stop