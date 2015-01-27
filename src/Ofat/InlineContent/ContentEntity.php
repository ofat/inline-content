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
 * @method static|Builder published()
 *
 * @package content
 */
class ContentEntity extends \Eloquent
{

    use Translated;

    const PUBLISHED = 1;
    const NON_PUBLISHED = 0;

    protected $table = 'content_entity';

    protected $fillable = [
        'slug',
        'is_published',
        'author',
        'created_at',
        'updated_at'
    ];

    public static $rules = [
        'slug' => 'required',
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
            $join->on('content_entity_translation.language', '=', \DB::raw('"'.\App::getLocale().'"'));
        });
        $query->where($this->getTable().'.slug', '=', $slug);

        return $query;
    }

    public function scopePublished(Builder $query)
    {
        return $query->where($this->getTable().'.is_published', '=', static::PUBLISHED);
    }

}