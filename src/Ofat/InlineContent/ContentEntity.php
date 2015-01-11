<?php
/**
 * @author: Vitaliy Ofat <i@vitaliy-ofat.com>
 */

namespace Ofat\InlineContent;

use Illuminate\Database\Eloquent\Builder;

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
 *
 * @package content
 */
class ContentEntity extends \Eloquent
{

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

}