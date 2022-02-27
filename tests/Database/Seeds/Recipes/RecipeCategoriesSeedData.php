<?php

namespace tests\Database\Seeds\Recipes;

use Extensions\Recipes\Models\RecipeCategory;
use tests\Database\Seeds\AbstractSeedData;
use tests\Database\Seeds\SeedDataInterface;
use tests\Database\Seeds\Users\UsersSeedData;

class RecipeCategoriesSeedData extends AbstractSeedData implements SeedDataInterface
{

    const BASE_CATEGORY_ID = 'c9b384cf-0150-422b-87c1-17b36c83ef79';

    const ALTERNATE_CATEGORY_ID = '043021ec-833d-477e-a158-b969cecd2905';

    public static function getData(): array
    {
        return
            [
                [
                    "id" => SELF::BASE_CATEGORY_ID,
                    "category" => "test category",
                    "description" => "test description",
                    "keywords" => "test",
                    "priority" => 1,
                    "slug" => "test-category",
                    "created_at" => self::getDatetime(),
                    "updated_at" => self::getDatetime(),
                    "created_by" => UsersSeedData::BASE_USER_ID,
                    "deleted_at" => null,
                    "image" => "1"
                ],
                [
                    "id" => SELF::ALTERNATE_CATEGORY_ID,
                    "category" => "test category2",
                    "description" => "test description2",
                    "keywords" => "test",
                    "priority" => 2,
                    "slug" => "test-category2",
                    "created_at" => self::getDatetime(),
                    "updated_at" => self::getDatetime(),
                    "created_by" => UsersSeedData::BASE_USER_ID,
                    "deleted_at" => null,
                    "image" => "1"
                ]
            ];
    }

    public function getClass()
    {
        return new RecipeCategory();
    }
}
