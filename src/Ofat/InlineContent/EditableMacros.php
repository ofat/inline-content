<?php
/**
 * @author Vitaliy Ofat <i@vitaliy-ofat.com>
 */

namespace Ofat\InlineContent;

use App;
use Cache;
use Config;
use View;

class EditableMacros
{
    public static function getRememberKeys($slug, $lang)
    {
        return [
            $slug . '-' . $lang,
            $slug . '-' . $lang . '-translation'
        ];
    }

    public static function render($slug)
    {
        list($model_remember_slug, $translation_remember_slug) = static::getRememberKeys($slug, App::getLocale());

        $model = ContentEntity
            ::remember(Config::get('inline-content::cacheTime', 5), $model_remember_slug)
            ->forSlug($slug)
            ->published()
            ->first();

        if(!$model)
            return $slug;

        $translation = Cache::remember($translation_remember_slug, Config::get('inline-content::cacheTime', 5), function() use ($model){
            return $model->getTranslation(App::getLocale(), true);
        });

        $adminCheck = Config::get('inline-content::admin_check');
        if(is_callable($adminCheck) && $adminCheck())
            return View::make('inline-content::partial.edit', ['model' => $model, 'translation' => $translation]);

        
        return $translation->content;
    }
}