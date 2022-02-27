<?php

namespace tests\integration\Components\Recipes\Endpoints;

use Extensions\Recipes\Controllers\RecipesController;
use tests\helpers\ClientRequestHelper;
use tests\helpers\TestCase;

class SaveRecipeEndpoint extends TestCase
{

    use ClientRequestHelper;


    /**
     * @return void
     */
    public function testAdminSaveRecipe()
    {
        $response = $this->http->request('POST',
            RecipesController::URL_RECIPES_ADMIN_SAVE,
            [
                'form_params' => [
                    'title' => 'phpunit recipe test',
                    'description' => 'Test user',
                    'prep_time' => '5 min',
                    'cook_time' => '12 min',
                    'instructions' => 'Test php unit',
                    'keywords' => 'phpunit kw',
                    'slug' => 'phpunit test'
                ]
            ]
        );

        $this->assertJsonEqualsIgnoreDates($response->getBody());
    }
}
