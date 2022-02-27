<?php

namespace Extensions\Recipes\Services\Contracts;

use Extensions\Recipes\DTOs\SaveRecipeCommentDTO;
use Extensions\Recipes\Models\RecipeComment;
use Gossamer\Pesedget\Database\Utils\ListResult;

interface RecipeCommentsServiceInterface
{

    public function save(SaveRecipeCommentDTO $recipeCommentDTO, int $userId) : RecipeComment;

    public function list(int $offset, int $limit, array $searchParams) : ListResult;

    public function delete(RecipeComment $recipeComment, int $userId) : RecipeComment;


}
