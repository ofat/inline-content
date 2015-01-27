<?php
/**
 * @author: Vitaliy Ofat <i@vitaliy-ofat.com>
 */

namespace Ofat\InlineContent;

use Illuminate\Database\Eloquent\Builder;
use Nayjest\I18n\Eloquent\Translated;

/**
 * Class ContentEntity
 *
 * @property int $id
 * @property int $type
 * @property int $is_published
 * @property int $author
 * @property string $created_at
 * @property string $updated_at
 *
 * @method static|Builder whereType($type)
 * @method static|Builder forSlug($slug)
 *
 * @package content
 */
class ContentEntity extends \Eloquent
{

    use Translated;

    const TYPE_PAGE = 1;
    const TYPE_BLOCK = 2;

    const PUBLISHED = 1;
    const NON_PUBLISHED = 0;

    protected $table = 'content_entity';

    protected $fillable = [
        'type',
        'is_published',
        'author',
        'created_at',
        'updated_at'
    ];

    public static $rules = [
        'type' => 'required',
        'author' => 'required'
    ];

    /**
     * @param Builder $query
     * @param string $slug
     * @return Builder
     */
    public function scopeForSlug(Builder $query, $slug)
    {
        $query->leftJoin('content_entity_translation', function($join) {
            $join->on('content_entity_translation.entity_id', '=', $this->getTable().'.id');
        });
        $query->where('content_entity_translation.slug', '=', $slug);
        $query->where('content_entity_translation.language', '=', \App::getLocale());

        return $query;
    }

}