<?php

namespace tests\functional\Components\Recipes\Services;

use Extensions\Recipes\DTOs\RecipeDTO;
use tests\Database\Seeds\Recipes\RecipesSeedData;
use tests\Database\Seeds\Users\UsersSeedData;
use tests\helpers\TestCase;

class RecipesServiceTest extends TestCase
{
    const SERVICE_NAME = 'Extensions\Recipes\Services\RecipesService';

    public function testGetRecipeBySlug() {
        $service = $this->getService(self::SERVICE_NAME );

        $recipe = $service->getBySlug(RecipesSeedData::BASE_RECIPE_SLUG);

        $this->assertNotNull($recipe);
        $this->assertEquals($recipe->id, RecipesSeedData::BASE_RECIPE_ID);
    }

    public function testGetRecipeById() {
        $service = $this->getService(self::SERVICE_NAME);

        $recipe = $service->get(RecipesSeedData::BASE_RECIPE_ID);

        $this->assertNotNull($recipe);
        $this->assertEquals($recipe->id, RecipesSeedData::BASE_RECIPE_ID);
    }

    public function testListAllRecipes() {
        $service = $this->getService(self::SERVICE_NAME);

        $recipes = $service->list(0, 10, array());

        $this->assertNotNull($recipes);
        $this->assertJsonEqualsIgnoreDates( $recipes->getList());
    }

    public function testSaveRecipe() {
        $service = $this->getService(self::SERVICE_NAME);

        $recipe = $service->save(
            new RecipeDTO(
                null,
                'phpunit recipe',
                'description here',
                '10 min',
                '12 min',
                'this is the instructions',
                'test, phpunit',
                'phpunit-recipe'
            ), UsersSeedData::BASE_USER_ID
        );

        $this->assertNotNull($recipe);
        $this->assertEquals($recipe->title, 'phpunit recipe');
    }

    public function testListRecipesByCategory() {
        $service = $this->getService(self::SERVICE_NAME);
        $list = $service->listByCategory('test-category');

        $this->assertnotNull($list->getList());
        $this->assertEquals(1, count($list->getList()));
    }

    public function testSearchRecipes() {
        $service = $this->getService(self::SERVICE_NAME);
        $list = $service->list(0, 10,
            ['search' => 'recipe2']
        );

        $this->assertnotNull($list->getList());
        $this->assertEquals(1, count($list->getList()));
        $this->assertJsonEqualsIgnoreDates($list->getList());
    }
}
