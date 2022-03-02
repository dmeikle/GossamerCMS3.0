<?php

namespace Components\Blogs\Services;

use Components\Blogs\DTOs\SaveBlogCommentDTO;
use Components\Blogs\Exceptions\CommentsDisallowedException;
use Components\Blogs\Models\Blog;
use Components\Blogs\Models\BlogComment;
use Components\Blogs\Services\Contracts\BlogCommentsServiceInterface;
use Gossamer\Core\MVC\AbstractService;
use Gossamer\Pesedget\Database\Utils\ListResult;

class BlogCommentsService extends AbstractService implements BlogCommentsServiceInterface
{

    /**
     * @param  SaveBlogCommentDTO  $blogCommentDTO
     * @param  Blog                $blog
     * @param  string              $userId
     *
     * @return BlogComment
     * @throws CommentsDisallowedException
     */
    public function save(
        SaveBlogCommentDTO $blogCommentDTO,
        Blog $blog,
        string $userId
    ): BlogComment {

        if(!$blog->allow_comments) {
            throw new CommentsDisallowedException();
        }

        $id = $this->getKey($blogCommentDTO);

        return BlogComment::create(
            [
                'id' => $id,
                'blogs_id' => $blogCommentDTO->getBlogsId(),
                'comment' => $blogCommentDTO->getComment(),
                'created_by' => $userId,
                'updated_by' => $userId
            ]
        );
    }

    public function list(
        int $offset,
        int $limit,
        array $searchParams
    ): ListResult {
        $query = BlogComment::query();
        BlogComment::getSearchParams($query, $searchParams['search']);

        return $this->getBasicList($offset, $limit, $searchParams, $query);
    }

    public function delete(
        BlogComment $blogComment, string $userId
    ): BlogComment {
        $blogComment->updated_by = $userId;
        $blogComment->trashed();

        return $blogComment;
    }

    public function listByBlog(int $offset, int $limit, string $blogsId): ListResult
    {
        $searchParams = ['blogs_id' => $blogsId];
        $query = BlogComment::query();
        BlogComment::getFilterParams($query, $searchParams);

        return $this->getBasicList($offset, $limit, $searchParams, $query);
    }
}
