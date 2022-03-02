<?php

namespace tests\Database\Seeds\Recipes;

use Auth0\SDK\API\Management\Users;
use Extensions\Recipes\Models\RecipeRating;
use tests\Database\Seeds\AbstractSeedData;
use tests\Database\Seeds\SeedDataInterface;
use tests\Database\Seeds\Users\UsersSeedData;

class RecipeRatingsSeedData extends AbstractSeedData implements
    SeedDataInterface
{
    const BASE_RECIPE_RATINGS_ID = "204d4db5-5af7-46f2-a024-746a37af742e";

    const ALTERNATE_RECIPE_RATINGS_ID = "24dd07a1-49ec-4d3b-ad52-88c4376c6d88";

    public static function getData(): array
    {
        return
            [
                [
                    "id" => self::BASE_RECIPE_RATINGS_ID,
                    "recipes_id" => RecipesSeedData::BASE_RECIPE_ID,
                    "rating" => 3,
                    "created_at" => self::getDatetime(),
                    "created_by" => UsersSeedData::BASE_USER_ID
                ],
                [
                    "id" => self::ALTERNATE_RECIPE_RATINGS_ID,
                    "recipes_id" => RecipesSeedData::BASE_RECIPE_ID,
                    "rating" => 5,
                    "created_at" => "2022-02-27 20:46:21",
                    "created_by" => UsersSeedData::ALTERNATE_USER_ID
                ]
            ];
    }

    public function getClass()
    {
        return new RecipeRating();
    }
}
