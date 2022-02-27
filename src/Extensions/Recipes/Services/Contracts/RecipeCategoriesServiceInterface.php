<?php

namespace Extensions\Recipes\Services\Contracts;

use Extensions\Recipes\DTOs\RecipeCategoryDTO;
use Extensions\Recipes\Models\RecipeCategory;
use Gossamer\Pesedget\Database\Utils\ListResult;

interface RecipeCategoriesServiceInterface
{
    public function list(int $offset, int $limit, array $searchParams) : ListResult;

    public function save(RecipeCategoryDTO $recipeDTO, string $userId): RecipeCategory;

    public function get(string $id) : RecipeCategory;

    public function getBySlug(string $slug) : RecipeCategory;
}
