<?php
/**
 * @author Vitaliy Ofat <i@vitaliy-ofat.com>
 */

namespace Ofat\InlineContent;

use Config;
use View;

class EditableMacros
{
    public static function render($slug)
    {
        $model = ContentEntity
            ::remember(Config::get('inline-content::cacheTime', 5), $slug.'-'.\App::getLocale())
            ->forSlug($slug)
            ->published()
            ->first();

        if(!$model)
            return $slug;

        $translation = $model->getTranslation(\App::getLocale(), true);

        $adminCheck = Config::get('inline-content::admin_check');
        if(is_callable($adminCheck) && $adminCheck())
            return View::make('inline-content::partial.edit', ['model' => $model, 'translation' => $translation]);

        return $translation->content;
    }
}