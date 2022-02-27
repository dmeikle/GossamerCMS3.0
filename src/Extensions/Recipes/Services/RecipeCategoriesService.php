<?php

namespace Extensions\Recipes\Services;

use Extensions\Recipes\DTOs\RecipeCategoryDTO;
use Extensions\Recipes\Models\RecipeCategory;
use Extensions\Recipes\Services\Contracts\RecipeCategoriesServiceInterface;
use Gossamer\Core\MVC\AbstractService;
use Gossamer\Pesedget\Database\Utils\ListResult;

class RecipeCategoriesService extends AbstractService implements RecipeCategoriesServiceInterface
{

    public function list(
        int $offset,
        int $limit,
        array $searchParams
    ): ListResult {

        $query = RecipeCategory::query();
        if(array_key_exists('search', $searchParams)) {
            RecipeCategory::getSearchParams($query, $searchParams['search']);
        }

        return $this->getBasicList($offset, $limit, $searchParams, $query);
    }

    public function save(
        RecipeCategoryDTO $recipeCategoryDTO,
        string $userId
    ): RecipeCategory {
        return RecipeCategory::updateOrCreate(
            [
                'id' => $this->getKey($recipeCategoryDTO),
                'created_at' => time(),
                'updated_at' => time(),
                'created_by' => $userId,
                'updated_by' => $userId,
                'title' => $recipeCategoryDTO->getTitle(),
                'description' => $recipeCategoryDTO->getDescription(),
                'keywords' => $recipeCategoryDTO->getKeywords(),
                'slug' => $recipeCategoryDTO->getSlug(),
            ]
        );
    }

    public function get(string $id): RecipeCategory
    {
        return RecipeCategory::where('id', $id)->first();
    }

    public function getBySlug(string $slug): RecipeCategory
    {
        return RecipeCategory::where('slug', $slug)->first();
    }
}
