<?php

namespace Extensions\Recipes\Services;

use Extensions\Recipes\DTOs\SaveRecipeCommentDTO;
use Extensions\Recipes\Models\RecipeComment;
use Extensions\Recipes\Services\Contracts\RecipeCommentsServiceInterface;
use Gossamer\Core\MVC\AbstractService;
use Gossamer\Pesedget\Database\Utils\ListResult;

class RecipeCommentsService extends AbstractService implements RecipeCommentsServiceInterface
{

    public function save(
        SaveRecipeCommentDTO $recipeCommentDTO,
        int $userId
    ): RecipeComment {
        $recipeComment = RecipeComment::create(
            [
                'recipe_id' => $recipeCommentDTO->getRecipesId(),
                'comment' => $recipeCommentDTO->getComment()
            ]
        );

        return $recipeComment;
    }

    public function list(
        int $offset,
        int $limit,
        array $searchParams
    ): ListResult {
        $query = RecipeComment::query();
        RecipeComment::getSearchParams($query, $searchParams['search']);

        return $this->getBasicList($offset, $limit, $searchParams, $query);
    }

    public function delete(
        RecipeComment $recipeComment, int $userId
    ): RecipeComment {
        $recipeComment->updated_by = $userId;
        $recipeComment->trashed();

        return $recipeComment;
    }
}
