<?php

namespace Components\Dashboard\Models;

use Extensions\Recipes\Models\RecipeCategory;
use Gossamer\Core\MVC\AbstractModel;

class Setting extends AbstractModel
{

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'setting_groups_id',
        'name',
        'description',
        'priority',
        'is_active',
        'value',
        'key',
    ];

    protected static array $searchable = [
        'name',
        'description',
        'key',
        'value'
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
