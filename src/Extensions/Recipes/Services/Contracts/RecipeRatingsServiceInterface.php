<?php

namespace Extensions\Recipes\Services\Contracts;

use Extensions\Recipes\DTOs\SaveRecipeRatingDTO;
use Extensions\Recipes\Models\Recipe;
use Extensions\Recipes\Models\RecipeRating;
use Gossamer\Pesedget\Database\Utils\ListResult;

interface RecipeRatingsServiceInterface
{
    public function save(SaveRecipeRatingDTO $recipeRatingDTO) : RecipeRating;

    public function list(Recipe $recipe) : ListResult;
}
