<?php

namespace Extensions\Recipes\Services;

use Components\Blogs\DTOs\BlogDTO;
use Components\Blogs\Services\BlogsService;
use Extensions\Recipes\DTOs\RecipeDTO;
use Extensions\Recipes\Models\Recipe;
use Extensions\Recipes\Services\Contracts\RecipesServiceInterface;
use Gossamer\Core\Http\Requests\HttpRequest;
use Gossamer\Core\MVC\AbstractService;
use Gossamer\Core\System\EntityManager;
use Gossamer\Horus\Http\HttpResponse;
use Gossamer\Neith\Logging\LoggingInterface;
use Gossamer\Pesedget\Database\Utils\ListResult;
use Gossamer\Set\Utils\Container;

class RecipesService extends AbstractService implements RecipesServiceInterface
{

    private BlogsService $blogsService;

    public function __construct(
        Container $container,
        EntityManager $entityManager,
        HttpRequest $httpRequest,
        HttpResponse $httpResponse,
        LoggingInterface $logger, BlogsService $blogsService
    ) {
        parent::__construct($container, $entityManager, $httpRequest,
            $httpResponse, $logger);

        $this->blogsService = $blogsService;
    }

    public function list(
        int $offset,
        int $limit,
        array $searchParams
    ): ListResult {

        $query = Recipe::query();

        if(array_key_exists('search', $searchParams)){
            Recipe::getSearchParams($query, $searchParams['search']);
        }
        $query->join('blogs', 'recipes.blogs_id', 'blogs.id');

        return $this->getBasicList($offset, $limit, $searchParams, $query);
    }

    public function save(RecipeDTO $recipeDTO, string $userId): Recipe
    {
        $blog = $this->blogsService->save(
            $recipeDTO->getBlogDTO(),
            $userId
        );
        if(is_null($blog)) {
            throw new \Exception();
        }

        return Recipe::updateOrCreate(
            [
                'id' => $this->getKey($recipeDTO),
                'blogs_id' => $blog->id,
                'created_at' => time(),
                'updated_at' => time(),
                'created_by' => $userId,
                'updated_by' => $userId,
                'blogs_id' => $blog->id,
                'prep_time' => $recipeDTO->getPrepTime(),
                'cook_time' => $recipeDTO->getCookTime(),
            ]
        );
    }

    public function get(string $id): Recipe
    {
        return Recipe::where('id', $id)->first();
    }

    public function getBySlug(string $slug): Recipe
    {
        $query = Recipe::query();
        $query->join('blogs', 'recipes.blogs_id', 'blogs.id');

        return $query->where('slug', $slug)->first();
    }

    public function listByCategory(string $categorySlug): ListResult
    {
        $max = (new Recipe())->categories()->count();
        $builder = Recipe::query();
        $list = $builder->selectRaw('recipes.*')
            ->join('recipes_recipe_categories', 'recipes.id', '=', 'recipes_recipe_categories.recipes_id')
            ->join('recipe_categories', 'recipe_categories.id', '=', 'recipes_recipe_categories.recipe_categories_id')
            ->where('recipe_categories.slug', '=', $categorySlug)
            ->get();
        return new ListResult($max, $list);
    }
}
