<?php

namespace Components\Blogs\Services\Contracts;

use Extensions\Recipes\DTOs\SaveRecipeCommentDTO;
use Extensions\Recipes\Models\RecipeComment;
use Gossamer\Pesedget\Database\Utils\ListResult;

interface BlogCommentsServiceInterface
{

    public function save(SaveRecipeCommentDTO $recipeCommentDTO, string $userId) : RecipeComment;

    public function list(int $offset, int $limit, array $searchParams) : ListResult;

    public function delete(RecipeComment $recipeComment, string $userId) : RecipeComment;


}
