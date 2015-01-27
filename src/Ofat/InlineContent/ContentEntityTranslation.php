<?php
/**
 * @author: Vitaliy Ofat <i@vitaliy-ofat.com>
 */

namespace Ofat\InlineContent;


use Nayjest\I18n\Eloquent\Translation;

class ContentEntityTranslation extends \Eloquent
{

    use Translation;

    protected $table = 'content_entity_translation';

    public $timestamps = false;

    protected $fillable = [
        'entity_id',
        'language',
        'title',
        'html_title',
        'content',
        'slug'
    ];

    protected static $relationName = 'entity';


}