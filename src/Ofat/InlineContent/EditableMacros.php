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
        $model = ContentEntity::forSlug($slug)->firstOrFail();

        $adminCheck = Config::get('inline-content::admin_check');
        if(is_callable($adminCheck) && $adminCheck())
            return View::make('inline-content::partial.edit', ['model' => $model]);

        return $model->content;
    }
}