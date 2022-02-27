<?php

namespace Extensions\Recipes\Models;

use Gossamer\Core\MVC\AbstractModel;

class Recipe extends AbstractModel
{
    protected $primaryKey = 'id';

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

    protected static array $searchable = [
        'title',
        'description',
        'slug',
        'keywords'
    ];

    public function categories() {
//        return $this->hasManyThrough(
//            Deployment::class,
//            Environment::class,
//            'project_id', // Foreign key on the environments table...
//            'environment_id', // Foreign key on the deployments table...
//            'id', // Local key on the projects table...
//            'id' // Local key on the environments table...
//        );
        return $this->belongsToMany(RecipeCategory::class, 'recipes_recipe_categories', 'recipes_id', 'recipe_categories_id');
    }
}
