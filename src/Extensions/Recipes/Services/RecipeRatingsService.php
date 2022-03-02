<?php

namespace Extensions\Recipes\Services;

use Extensions\Recipes\DTOs\SaveRecipeRatingDTO;
use Extensions\Recipes\Models\Recipe;
use Extensions\Recipes\Models\RecipeRating;
use Extensions\Recipes\Services\Contracts\RecipeRatingsServiceInterface;
use Gossamer\Core\MVC\AbstractService;
use Gossamer\Core\Util\Traits\DateTimeAware;
use Gossamer\Pesedget\Database\Utils\ListResult;

class RecipeRatingsService extends AbstractService implements RecipeRatingsServiceInterface
{

    use DateTimeAware;

    public function save(SaveRecipeRatingDTO $recipeRatingDTO) : RecipeRating
    {
        return RecipeRating::create(
            [
                'id' => $this->getKey($recipeRatingDTO),
                'recipes_id' => $recipeRatingDTO->getRecipesId(),
                'rating' => $recipeRatingDTO->getRating(),
                'created_at' => self::getDatetime(),
                'created_by' => $recipeRatingDTO->getUsersId()
            ]
        );
    }

    public function list(Recipe $recipe): ListResult
    {
        return RecipeRating::where('recipes_id', $recipe->id)->get();
    }
}
