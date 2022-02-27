<?php

namespace Extensions\Recipes\Controllers;

use Extensions\Recipes\DTOs\RecipeDTO;
use Extensions\Recipes\DTOs\SaveRecipeCommentDTO;
use Extensions\Recipes\Http\Requests\IndexRequest;
use Extensions\Recipes\Http\Requests\SaveRecipeRequest;
use Extensions\Recipes\Models\Recipe;
use Extensions\Recipes\Services\RecipesService;
use Gossamer\Core\Http\Responses\SuccessResponse;
use Gossamer\Core\MVC\AbstractController;
use Gossamer\Horus\EventListeners\EventDispatcher;
use Gossamer\Neith\Logging\LoggingInterface;

class RecipesController extends AbstractController
{
    private RecipesService $recipesService;

    const URL_RECIPES_LIST_ALL = '/recipes/{offset}/{limit}';
    const URL_RECIPES_GET_BY_SLUG = '/recipes/{slug}';
    const URL_RECIPES_ADMIN_LIST_ALL = '/admin/recipes/{offset}/{limit}';
    const URL_RECIPES_ADMIN_SAVE = '/admin/recipes';
    const URL_RECIPES_ADMIN_GET = '/admin/recipes/{id}';

    public function __construct(
        EventDispatcher $eventDispatcher,
        LoggingInterface $logger,
        RecipesService $recipesService
    ) {
        parent::__construct($eventDispatcher, $logger);
        $this->recipesService = $recipesService;
    }

    public function index(IndexRequest $request)
    {
        $parameters = $request->getParameters();
        $list = $this->recipesService->list($request->getOffset(),
            $request->getLimit(), $parameters);

        return $this->render((new SuccessResponse())
            ->setStatus('success')
            ->setCode(200)
            ->setBody(
                $list)
        );
    }

    public function save(SaveRecipeRequest $request)
    {
        $userId = '0C30457D-50F0-DE6F-C734-5E36231F022C';
        $recipe = $this->recipesService->save($request->post(), $userId);

        return $this->render((new SuccessResponse())
            ->setStatus('success')
            ->setCode(200)
            ->setBody(
                new RecipeDTO(
                    $recipe->id,
                    $recipe->title,
                    $recipe->description,
                    $recipe->cook_time,
                    $recipe->prep_time,
                    $recipe->instructions,
                    $recipe->keywords,
                    $recipe->slug
                )
            ));
    }

    public function get(Recipe $recipe)
    {

        return $this->render((new SuccessResponse())
            ->setStatus('success')
            ->setCode(200)
            ->setBody(
                new RecipeDTO(
                    $recipe->id,
                    $recipe->title,
                    $recipe->description,
                    $recipe->cook_time,
                    $recipe->prep_time,
                    $recipe->instructions,
                    $recipe->keywords,
                    $recipe->slug,
                    array()
                )
            ));
    }

    public function getBySlug(Recipe $recipe)
    {
        $comments = $this->httpRequest->getAttribute('comments');

        $commentDTOs = [];
        foreach($comments as $comment) {
            $commentDTOs[] = new SaveRecipeCommentDTO(
                $recipe->id,
                $comment->comment
            );
        }

        return $this->render((new SuccessResponse())
            ->setStatus('success')
            ->setCode(200)
            ->setBody(
                new RecipeDTO(
                    $recipe->id,
                    $recipe->title,
                    $recipe->description,
                    $recipe->cook_time,
                    $recipe->prep_time,
                    $recipe->instructions,
                    $recipe->keywords,
                    $recipe->slug,
                    $commentDTOs
                )
            ));
    }
}
