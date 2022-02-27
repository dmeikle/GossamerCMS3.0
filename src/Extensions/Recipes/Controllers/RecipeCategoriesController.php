<?php

namespace Extensions\Recipes\Controllers;

use Extensions\Recipes\DTOs\RecipeCategoryDTO;
use Extensions\Recipes\Http\Requests\IndexRequest;
use Extensions\Recipes\Http\Requests\SaveRecipeCategoryRequest;
use Extensions\Recipes\Models\RecipeCategory;
use Extensions\Recipes\Services\RecipeCategoriesService;
use Gossamer\Core\Http\Responses\SuccessResponse;
use Gossamer\Core\MVC\AbstractController;
use Gossamer\Horus\EventListeners\EventDispatcher;
use Gossamer\Neith\Logging\LoggingInterface;

class RecipeCategoriesController extends AbstractController
{
    private RecipeCategoriesService $recipeCategoriesService;

    public function __construct(
        EventDispatcher $eventDispatcher,
        LoggingInterface $logger,
        RecipeCategoriesService $recipeCategoriesService
    ) {
        parent::__construct($eventDispatcher, $logger);
        $this->recipeCategoriesService = $recipeCategoriesService;
    }

    public function index(IndexRequest $request)
    {
        $parameters = $request->getParameters();
        $list = $this->recipeCategoriesService->list($request->getOffset(),
            $request->getLimit(), $parameters);

        return $this->render((new SuccessResponse())
            ->setStatus('success')
            ->setCode(200)
            ->setBody(
                $list)
        );
    }

    public function save(SaveRecipeCategoryRequest $request)
    {
        $userId = '0C30457D-50F0-DE6F-C734-5E36231F022C';
        $recipe = $this->recipeCategoriesService->save($request->post(), $userId);

        return $this->render((new SuccessResponse())
            ->setStatus('success')
            ->setCode(200)
            ->setBody(
                new RecipeCategoryDTO(
                    $recipe->id,
                    $recipe->title,
                    $recipe->description,
                    $recipe->cook_time,
                    $recipe->prep_time,
                    $recipe->instructions
                )
            ));
    }

    public function get(RecipeCategory $recipeCategory)
    {
        return $this->render((new SuccessResponse())
            ->setStatus('success')
            ->setCode(200)
            ->setBody(
                new RecipeCategoryDTO(
                    $recipeCategory->id,
                    $recipeCategory->title,
                    $recipeCategory->description,
                    $recipeCategory->keywords,
                    $recipeCategory->slug,
                    $recipeCategory->image
                )
            ));
    }
}
