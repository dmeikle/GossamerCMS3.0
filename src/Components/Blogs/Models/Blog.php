<?php

namespace Components\Blogs\Models;

use Gossamer\Core\MVC\AbstractModel;

class Blog extends AbstractModel
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
        'deleted_at',
        'title',
        'description',
        'contents',
        'keywords',
        'slug',
        'blog_categories_id'
    ];

    protected static array $searchable = [
        'title',
        'description',
        'contents',
        'slug',
        'keywords'
    ];

}
