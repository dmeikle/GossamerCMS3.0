<?php

namespace Extensions\Recipes\Models;

use Gossamer\Core\MVC\AbstractModel;

class RecipeCategory extends AbstractModel
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
        'deleted_at',
        'category',
        'image',
        'keywords',
        'slug',
        'description',
        'cook_time'
    ];

    protected static array $searchable = [
        'category',
        'description',
        'slug',
        'keywords'
    ];


}
