<?php

namespace Components\Blogs\Models;

use Gossamer\Core\MVC\AbstractModel;

class BlogCategory extends AbstractModel
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'category',
        'description'
    ];

}
