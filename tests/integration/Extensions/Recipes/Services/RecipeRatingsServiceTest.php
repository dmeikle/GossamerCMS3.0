<?php

namespace tests\integration\Extensions\Recipes\Services;

use Extensions\Recipes\DTOs\SaveRecipeRatingDTO;
use tests\Database\Seeds\Recipes\RecipesSeedData;
use tests\Database\Seeds\Users\UsersSeedData;
use tests\helpers\TestCase;

class RecipeRatingsServiceTest extends TestCase
{
    const SERVICE_NAME = 'Extensions\Recipes\Services\RecipeRatingsService';

//    public function testGetRecipeById() {
//        $service = $this->getService(self::SERVICE_NAME );
//
//        $recipe = $service->getBySlug(RecipesSeedData::BASE_RECIPE_SLUG);
//
//
//        $this->assertNotNull($recipe);
//        $this->assertJsonEqualsIgnoreDates($recipe);
//    }

    public function testSaveRecipe() {
        $service = $this->getService(self::SERVICE_NAME);

        $rating = $service->save(
            new SaveRecipeRatingDTO(
                null,
               RecipesSeedData::ALTERNATE_RECIPE_ID,
                5,
                UsersSeedData::ALTERNATE_USER_ID
            ), UsersSeedData::ALTERNATE_USER_ID
        );
//
        $this->assertNotNull($rating);
        $this->assertJsonEqualsIgnoreDates($rating);
    }


}
