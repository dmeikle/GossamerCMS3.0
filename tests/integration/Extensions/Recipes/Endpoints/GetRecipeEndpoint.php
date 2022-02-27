<?php

namespace tests\integration\Components\Recipes\Endpoints;

use Extensions\Recipes\Controllers\RecipesController;
use tests\Database\Seeds\Recipes\RecipesSeedData;
use tests\helpers\ClientRequestHelper;
use tests\helpers\TestCase;

class GetRecipeEndpoint extends TestCase
{
    use ClientRequestHelper;

    /**
     * @return void
     */
    public function testAdminGetSingleRecipe_shouldReturnSingle() {
        $url = $this->buildUri([RecipesSeedData::BASE_RECIPE_ID], RecipesController::URL_RECIPES_ADMIN_GET);

        $response = $this->http->request('GET', $url);
        $this->assertJsonEqualsIgnoreDates($response->getBody());
    }

    /**
     * @return void
     */
    public function testGetRecipe_shouldReturnSingle() {
        $response = $this->http->request('GET', RecipesController::URL_RECIPES_GET_BY_SLUG);
        // $request = new SaveRecipeRequest(new HttpRequest())
        $this->assertJsonEqualsIgnoreDates($response->getBody());
    }
}
