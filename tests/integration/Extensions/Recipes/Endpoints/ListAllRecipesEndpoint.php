<?php

namespace tests\integration\Components\Recipes\Endpoints;

use Extensions\Recipes\Controllers\RecipesController;
use tests\Database\Seeds\Recipes\RecipesSeedData;
use tests\helpers\ClientRequestHelper;
use tests\helpers\TestCase;

class ListAllRecipesEndpoint extends TestCase
{

    use ClientRequestHelper;

    /**
     * @return void
     */
    public function testAdminListRecipes() {
        $url = $this->buildUri([0,10], RecipesController::URL_RECIPES_ADMIN_LIST_ALL);

        $response = $this->http->request('GET', $url);//change to numeric values
        $json = json_decode($response->getBody(), true);

        $this->assertEquals(count(RecipesSeedData::getData()), $json['maxrows']);
        $this->assertJsonEqualsIgnoreDates($response->getBody());
    }

    /**
     * @return void
     */
    public function testAdminListRecipesBeyondListLength_shouldReturnZero() {
        $url = $this->buildUri([20,10], RecipesController::URL_RECIPES_ADMIN_LIST_ALL);
        $response = $this->http->request('GET', $url);
        $json = json_decode($response->getBody(), true);

        $this->assertEquals(count(RecipesSeedData::getData()), $json['maxrows']);
        $this->assertJsonEqualsIgnoreDates($response->getBody());
    }

    /**
     * @return void
     */
    public function testAdminListRecipes1Row_shouldReturn1() {
        $url = $this->buildUri([0,1], RecipesController::URL_RECIPES_ADMIN_LIST_ALL);
        $response = $this->http->request('GET', $url);
        $json = json_decode($response->getBody(), true);

        $this->assertEquals(count(RecipesSeedData::getData()), $json['maxrows']);
        $this->assertEquals(1, count($json['list']));
        $this->assertJsonEqualsIgnoreDates($response->getBody());
    }

    /**
     * @return void
     */
    public function testAdminGetRecipes1Row_shouldReturn1() {
        $url = $this->buildUri([0,1], RecipesController::URL_RECIPES_ADMIN_LIST_ALL);
        $response = $this->http->request('GET', $url);
        $json = json_decode($response->getBody(), true);

        $this->assertEquals(count(RecipesSeedData::getData()), $json['maxrows']);
        $this->assertEquals(1, count($json['list']));
        $this->assertJsonEqualsIgnoreDates($response->getBody());
    }


}
