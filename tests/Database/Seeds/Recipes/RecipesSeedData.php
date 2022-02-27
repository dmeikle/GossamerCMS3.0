<?php

namespace tests\Database\Seeds\Recipes;

use Extensions\Recipes\Models\Recipe;
use tests\Database\Seeds\AbstractSeedData;
use tests\Database\Seeds\Blogs\BlogsSeedData;
use tests\Database\Seeds\SeedDataInterface;

class RecipesSeedData extends AbstractSeedData implements SeedDataInterface
{

    const BASE_RECIPE_ID = "b41c0bfb-328c-4a15-981c-3b678464449a";

    const BASE_RECIPE_SLUG = 'recipe';

    const ALTERNATE_RECIPE_ID = '6752b156-79a5-4289-9783-3285d0328a6d';

    public static function getData(): array
    {
        return
            [
                [
                    "id" => self::BASE_RECIPE_ID,
                    "blogs_id" => BlogsSeedData::BLOG_RECIPE_ID,
                    "prep_time" => "12 min",
                    "cook_time" => "30 min",
                    "created_at" => self::getDatetime(),
                    "created_by" => "1",
                    "updated_at" => self::getDatetime(),
                    "updated_by" => "1",
                    "deleted_at" => null
                ]
            ];
    }

    public function getClass()
    {
        return new Recipe();
    }
}
