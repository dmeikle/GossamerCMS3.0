<?php

namespace Extensions\Recipes\Models;

use Gossamer\Core\MVC\AbstractModel;

class RecipeComment extends AbstractModel
{

    protected $fillable = [
        'id',
        'blogs_id',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
        'deleted_at',
        'prep_time',
        'cook_time'
    ];

}
