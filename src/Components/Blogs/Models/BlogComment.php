<?php

namespace Components\Blogs\Models;

use Gossamer\Core\MVC\AbstractModel;

class BlogComment extends AbstractModel
{

    protected $fillable = [
        'id',
        'blogs_id',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
        'deleted_at',
        'comment'
    ];

}
