<?php

namespace Extensions\Recipes\Models;

use Gossamer\Core\MVC\AbstractModel;

class RecipeRating extends AbstractModel
{
    public $timestamps = false;

    protected $fillable = [
        'id',
        'recipes_id',
        'created_at',
        'created_by',
        'rating'
    ];
}
