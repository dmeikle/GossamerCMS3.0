<?php

namespace Components\Blogs\Controllers;

use Components\Blogs\DTOs\BlogDTO;
use Components\Blogs\Http\Requests\IndexRequest;
use Components\Blogs\Http\Requests\SaveRecipeRequest;
use Components\Blogs\Models\Blog;
use Components\Blogs\Services\BlogsService;
use Components\Blogs\Services\Contracts\BlogsServiceInterface;
use Gossamer\Core\Http\Responses\SuccessResponse;
use Gossamer\Core\MVC\AbstractController;
use Gossamer\Horus\EventListeners\EventDispatcher;
use Gossamer\Neith\Logging\LoggingInterface;
use Gossamer\Pesedget\Database\Exceptions\RecordNotFoundException;

class BlogsController extends AbstractController
{
    private BlogsService $blogsService;

    public function __construct(EventDispatcher $eventDispatcher, LoggingInterface $logger, BlogsService $blogsService) {
        parent::__construct($eventDispatcher, $logger);
        $this->blogsService = $blogsService;
    }

    /**
     *
     */
    public function index(IndexRequest $request) {
        $parameters = $request->getParameters();
        $list = $this->blogsService->list($request->getOffset(), $request->getLimit(), $parameters);

        return $this->render((new SuccessResponse())
            ->setStatus('success')
            ->setCode(200)
            ->setBody(
                $list)
        );
    }

    public function save(SaveRecipeRequest $request) {
        $userId = '0C30457D-50F0-DE6F-C734-5E36231F022C';
        $blog = $this->blogsService->save($request->post(), $userId);

        return $this->render((new SuccessResponse())
            ->setStatus('success')
            ->setCode(200)
            ->setBody(
                new BlogDTO(
                    $blog->id,
                    $blog->title,
                    $blog->description,
                    $blog->contents,
                    $blog->slug,
                    $blog->keywords,
                    $blog->blogs_categories_id
                ))
        );
    }

    public function get(Blog $blog)
    {
        return $this->render((new SuccessResponse())
            ->setStatus('success')
            ->setCode(200)
            ->setBody(new BlogDTO(
                $blog->id,
                $blog->title,
                $blog->description,
                $blog->contents,
                $blog->slug,
                $blog->keywords,
                $blog->blogs_categories_id)));

    }
}
