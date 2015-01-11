<?php
/**
 * @author: Vitaliy Ofat <i@vitaliy-ofat.com>
 */

namespace Ofat\InlineContent;


class ContentEntityTranslation extends \Eloquent
{

    protected $table = 'content_entity_translation';

    protected $fillable = [
        'entity_id',
        'language',
        'title',
        'html_title',
        'content',
        'url'
    ];

    protected static $relationName = 'entity';


}