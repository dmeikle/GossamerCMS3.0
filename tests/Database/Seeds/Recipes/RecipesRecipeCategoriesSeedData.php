<?php

namespace tests\Database\Seeds\Recipes;

use Extensions\Recipes\Models\RecipesRecipeCategory;
use tests\Database\Seeds\SeedDataInterface;

class RecipesRecipeCategoriesSeedData implements SeedDataInterface
{

    public static function getData(): array
    {
        return
            [
                [
                    "id" => "b9833020-c30b-4a1a-979e-32b2a4848bb6",
                    "recipes_id" => "b41c0bfb-328c-4a15-981c-3b678464449a",
                    "recipe_categories_id" => "c9b384cf-0150-422b-87c1-17b36c83ef79"
                ]
            ];
    }

    public function getClass()
    {
        return new RecipesRecipeCategory();
    }
}
