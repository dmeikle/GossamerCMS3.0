<?php

namespace Components\Blogs\Services\Contracts;

use Components\Blogs\DTOs\SaveBlogCommentDTO;
use Components\Blogs\Models\Blog;
use Components\Blogs\Models\BlogComment;
use Gossamer\Pesedget\Database\Utils\ListResult;

interface BlogCommentsServiceInterface
{

    public function save(SaveBlogCommentDTO $recipeCommentDTO, Blog $blog, string $userId) : BlogComment;

    public function list(int $offset, int $limit, array $searchParams) : ListResult;

    public function delete(BlogComment $recipeComment, string $userId) : BlogComment;

    public function listByBlog(int $offset, int $limit, string $blogsId) : ListResult;


}
