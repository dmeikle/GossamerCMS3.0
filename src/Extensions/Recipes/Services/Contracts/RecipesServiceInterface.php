<?php

namespace Extensions\Recipes\Services\Contracts;

use Extensions\Recipes\DTOs\RecipeDTO;
use Extensions\Recipes\Models\Recipe;
use Gossamer\Pesedget\Database\Utils\ListResult;

interface RecipesServiceInterface
{
    public function list(int $offset, int $limit, array $searchParams) : ListResult;

    public function save(RecipeDTO $recipeDTO, string $userId): Recipe;

    public function get(string $id) : Recipe;

    public function getBySlug(string $slug) : Recipe;

    public function listByCategory(string $categorySlug) : ListResult;
}
