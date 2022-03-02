<?php

namespace Extensions\Recipes\Controllers;

use Components\Blogs\DTOs\SaveBlogCommentDTO;
use Components\Blogs\Models\BlogComment;
use Components\Blogs\Services\BlogCommentsService;
use Components\Users\Exceptions\UserNotFoundException;
use Components\Users\Services\UsersService;
use Extensions\Recipes\DTOs\DeleteRecipeCommentDTO;
use Extensions\Recipes\DTOs\GetRecipeCommentDTO;
use Extensions\Recipes\Http\Requests\IndexRequest;
use Extensions\Recipes\Http\Requests\SaveRecipeCommentRequest;
use Gossamer\Core\Http\Responses\SuccessResponse;
use Gossamer\Core\MVC\AbstractController;
use Gossamer\Horus\EventListeners\EventDispatcher;
use Gossamer\Neith\Logging\LoggingInterface;

class RecipeCommentsController extends AbstractController
{
    private BlogCommentsService $recipeCommentsService;

    private UsersService $usersService;

    public function __construct(
        EventDispatcher $eventDispatcher,
        LoggingInterface $logger,
        BlogCommentsService $recipeCommentsService,
        UsersService $usersService
    ) {
        parent::__construct($eventDispatcher, $logger);
        $this->recipeCommentsService = $recipeCommentsService;
        $this->usersService = $usersService;
    }

    public function index(IndexRequest $request)
    {
        $parameters = $request->getParameters();
        $list = $this->recipeCommentsService->list($request->getOffset(),
            $request->getLimit(), $parameters);

        return $this->render((new SuccessResponse())
            ->setStatus('success')
            ->setCode(200)
            ->setBody(
                $list)
        );
    }

    public function save(SaveRecipeCommentRequest $request)
    {
        $userId = '0C30457D-50F0-DE6F-C734-5E36231F022C';
        $recipe = $this->recipeCommentsService->save($request->post(), $userId);

        return $this->render((new SuccessResponse())
            ->setStatus('success')
            ->setCode(200)
            ->setBody(
                new SaveBlogCommentDTO(
                    $recipe->id,
                    $recipe->title,
                    $userId
                )
            ));
    }

    public function get(BlogComment $recipeComment)
    {
        $user = $this->usersService->get($recipeComment->created_by);
        if(is_null($user)) {
            throw new UserNotFoundException();
        }

        return $this->render((new SuccessResponse())
            ->setStatus('success')
            ->setCode(200)
            ->setBody(
                new GetRecipeCommentDTO(
                    $recipeComment->id,
                    $recipeComment->comment,
                    $user->firstname . ' ' . $user->lastname
                )
            ));
    }

    public function delete(BlogComment $recipeComment)
    {
        $userId = '0C30457D-50F0-DE6F-C734-5E36231F022C';
        $deletedRecipeComment = $this->recipeCommentsService->delete(
            $recipeComment,
            $userId
        );

        return $this->render((new SuccessResponse())
            ->setStatus('success')
            ->setCode(200)
            ->setBody(
                new DeleteRecipeCommentDTO(
                    $deletedRecipeComment->id,
                    $recipeComment->deleted_date
                )
            ));
    }
}
